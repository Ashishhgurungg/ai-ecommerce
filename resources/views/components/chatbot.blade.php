<div id="chatbotContainer" class="fixed bottom-6 right-6 z-50">
    
    <button id="openChatbot" 
        class="bg-blue-600 hover:bg-blue-700 text-[24px] text-white px-6 py-4 rounded-full shadow-lg flex items-center gap-2 transition transform hover:scale-105">
        💬 Chat
    </button>

    <div id="chatWindow" class="hidden w-80 md:w-96 h-[480px] bg-[#1b2233] border border-[#2a3145] 
            rounded-2xl shadow-2xl overflow-hidden flex flex-col transition-all duration-300">

        <div class="bg-blue-600 text-white p-4 flex justify-between items-center shadow-md">
            <h3 class="font-semibold text-lg flex items-center gap-2">🤖 AI Chatbot</h3>
            <button id="closeChatbot" class="text-white hover:text-gray-200 text-xl font-bold">&times;</button>
        </div>

        <div id="messages" class="flex-1 overflow-y-auto p-4 space-y-4 text-sm scroll-smooth">
            <div class="bg-[#2a3145] p-3 rounded-lg w-fit max-w-[85%] text-gray-200 shadow-sm border border-[#363d52]">
                Hello! 👋 How can I help you today?
            </div>
        </div>

        <div class="p-3 border-t border-[#2a3145] bg-[#161b28] flex gap-2">
            <input 
                id="userInput" 
                type="text"
                placeholder="Type a message..."
                class="flex-1 px-3 py-2 rounded-lg text-white bg-[#1b2233] border border-[#2a3145] focus:outline-none focus:border-blue-500 transition-colors"
            >
            <button id="sendMessage"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition-colors font-medium">
                Send
            </button>
        </div>

    </div>
</div>

<script>
    const chatbotBtn = document.getElementById("openChatbot");
    const chatWindow = document.getElementById("chatWindow");
    const closeBtn = document.getElementById("closeChatbot");
    const sendBtn = document.getElementById("sendMessage");
    const userInput = document.getElementById("userInput");
    const messagesBox = document.getElementById("messages");

    // Toggle Chat Window
    chatbotBtn.onclick = () => chatWindow.classList.remove("hidden");
    closeBtn.onclick = () => chatWindow.classList.add("hidden");

    // Helper to add messages to UI
    function addMessage(text, type) {
        const div = document.createElement("div");
        const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        
        div.className = type === "user"
                ? "bg-blue-600 text-white p-3 rounded-lg w-fit max-w-[85%] ml-auto shadow-md mb-2"
                : "bg-[#2a3145] text-gray-200 p-3 rounded-lg w-fit max-w-[85%] shadow-md border border-[#363d52] mb-2";

        div.innerHTML = `<div>${text}</div><div class="text-[10px] opacity-50 text-right mt-1">${timestamp}</div>`;
        
        messagesBox.appendChild(div);
        messagesBox.scrollTop = messagesBox.scrollHeight;
    }

    // Main Send Logic
    async function sendMessage() {
        let text = userInput.value.trim();
        if (!text) return;

        // 1. Add User Message
        addMessage(text, "user");
        userInput.value = "";
        userInput.disabled = true; // Disable input while waiting

        // 2. Call FastAPI backend
        try {
            // NOTE: Using 127.0.0.1 is often safer than localhost to avoid IP version conflicts
            let response = await fetch("http://127.0.0.1:8000/chat", {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ message: text })
            });

            if (!response.ok) {
                throw new Error(`Server Error: ${response.status}`);
            }

            let data = await response.json();
            addMessage(data.response || "I didn't get a response.", "bot");

        } catch (error) {
            console.error("Chatbot connection error:", error);
            addMessage("⚠️ Error: Could not connect to the AI server. Is it running?", "bot");
        } finally {
            userInput.disabled = false;
            userInput.focus();
        }
    }

    sendBtn.onclick = sendMessage;

    userInput.addEventListener("keypress", (e) => {
        if (e.key === "Enter") sendMessage();
    });
</script>