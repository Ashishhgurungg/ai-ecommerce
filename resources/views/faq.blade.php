@php $pageTitle = 'Frequently Asked Questions — AI Studio'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

{{-- Alpine.js Interface Runtime Engine --}}
<script src="https://unpkg.com/alpinejs" defer></script>

<main class="flex-grow max-w-4xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300">

    {{-- Section Architecture Header Block --}}
    <header class="text-center max-w-xl mx-auto mb-12">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[15px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            System Documentation
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            Frequently Asked Questions
        </h1>
        <p class="mt-2 text-[16px] text-slate-600 dark:text-slate-300 leading-relaxed">
            Find answers to common questions about our AI services, development processes, integration capabilities, and support policies. If you have any additional inquiries, feel free to contact our technical support team for personalized assistance.
        </p>
    </header>

    {{-- Interactive Accordion Stack Engine --}}
    <div x-data="{ activeAccordion: null }" class="space-y-4">

        {{-- FAQ Node 01 --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded-2xl overflow-hidden transition-all duration-200">
            <button @click="activeAccordion = (activeAccordion === 1 ? null : 1)" 
                    class="w-full flex justify-between items-center px-5 py-4 text-left text-slate-900 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors focus:outline-none">
                <span class="text-[24px] font-600 tracking-tight">What AI services do you provide?</span>
                <span class="text-blue-600 dark:text-blue-400 font-display transition-transform duration-200 text-lg leading-none" 
                      :class="activeAccordion === 1 ? 'rotate-45' : 'rotate-0'">+</span>
            </button>
            <div x-show="activeAccordion === 1" x-cloak x-collapse
                 class="border-t border-slate-100 dark:border-slate-800/60 px-5 py-4 bg-slate-50/50 dark:bg-slate-900/50">
                <p class="text-[18px] text-slate-500 dark:text-slate-400 leading-relaxed">
                    We engineer conversational interfaces, autonomous workflow orchestration layers, custom agent runtimes, and deep pipeline integrations using robust backend architectures like Laravel and FastAPI.
                </p>
            </div>
        </div>

        {{-- FAQ Node 02 --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded-2xl overflow-hidden transition-all duration-200">
            <button @click="activeAccordion = (activeAccordion === 2 ? null : 2)" 
                    class="w-full flex justify-between items-center px-5 py-4 text-left text-slate-900 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors focus:outline-none">
                <span class="text-[24px] font-600 tracking-tight">How long does it take to develop an AI chatbot?</span>
                <span class="text-blue-600 dark:text-blue-400 font-display transition-transform duration-200 text-lg leading-none" 
                      :class="activeAccordion === 2 ? 'rotate-45' : 'rotate-0'">+</span>
            </button>
            <div x-show="activeAccordion === 2" x-cloak x-collapse
                 class="border-t border-slate-100 dark:border-slate-800/60 px-5 py-4 bg-slate-50/50 dark:bg-slate-900/50">
                <p class="text-[18px] text-slate-500 dark:text-slate-400 leading-relaxed">
                    A basic full-stack configuration lifecycle spans roughly 3–7 operational updates. Complex instances utilizing contextual vector store layers (such as FAISS matrices) adapt based on training documentation profiles.
                </p>
            </div>
        </div>

        {{-- FAQ Node 03 --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded-2xl overflow-hidden transition-all duration-200">
            <button @click="activeAccordion = (activeAccordion === 3 ? null : 3)" 
                    class="w-full flex justify-between items-center px-5 py-4 text-left text-slate-900 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors focus:outline-none">
                <span class="text-[24px] font-600 tracking-tight">Can your AI chatbot integrate with my website?</span>
                <span class="text-blue-600 dark:text-blue-400 font-display transition-transform duration-200 text-lg leading-none" 
                      :class="activeAccordion === 3 ? 'rotate-45' : 'rotate-0'">+</span>
            </button>
            <div x-show="activeAccordion === 3" x-cloak x-collapse
                 class="border-t border-slate-100 dark:border-slate-800/60 px-5 py-4 bg-slate-50/50 dark:bg-slate-900/50">
                <p class="text-[18px] text-slate-500 dark:text-slate-400 leading-relaxed">
                    Affirmative. Runtimes securely hook into existing architectures via standardized REST API endpoints, matching cleanly with Laravel views, dynamic state scripts, and secure application containers.
                </p>
            </div>
        </div>

        {{-- FAQ Node 04 --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded-2xl overflow-hidden transition-all duration-200">
            <button @click="activeAccordion = (activeAccordion === 4 ? null : 4)" 
                    class="w-full flex justify-between items-center px-5 py-4 text-left text-slate-900 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors focus:outline-none">
                <span class="text-[24px] font-600 tracking-tight">Do you offer support after delivery?</span>
                <span class="text-blue-600 dark:text-blue-400 font-display transition-transform duration-200 text-lg leading-none" 
                      :class="activeAccordion === 4 ? 'rotate-45' : 'rotate-0'">+</span>
            </button>
            <div x-show="activeAccordion === 4" x-cloak x-collapse
                 class="border-t border-slate-100 dark:border-slate-800/60 px-5 py-4 bg-slate-50/50 dark:bg-slate-900/50">
                <p class="text-[18px] text-slate-500 dark:text-slate-400 leading-relaxed">
                    Yes, we provide ongoing maintenance iterations, index database optimization, and architectural review sweeps to keep context processing latency drops safely within performance parameters.
                </p>
            </div>
        </div>

        {{-- FAQ Node 05 --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded-2xl overflow-hidden transition-all duration-200">
            <button @click="activeAccordion = (activeAccordion === 5 ? null : 5)" 
                    class="w-full flex justify-between items-center px-5 py-4 text-left text-slate-900 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors focus:outline-none">
                <span class="text-[24px] font-600 tracking-tight">Is your AI secure and private?</span>
                <span class="text-blue-600 dark:text-blue-400 font-display transition-transform duration-200 text-lg leading-none" 
                      :class="activeAccordion === 5 ? 'rotate-45' : 'rotate-0'">+</span>
            </button>
            <div x-show="activeAccordion === 5" x-cloak x-collapse
                 class="border-t border-slate-100 dark:border-slate-800/60 px-5 py-4 bg-slate-50/50 dark:bg-slate-900/50">
                <p class="text-[18px] text-slate-500 dark:text-slate-400 leading-relaxed">
                    Data integrity is handled under zero-leak network architectures. Your repository queries are completely encrypted at rest and in transit, isolating contextual validation weights away from public training pipelines.
                </p>
            </div>
        </div>

    </div>

    {{-- System Core Direct Support Line Hook --}}
    <div class="text-center mt-12 bg-slate-50 dark:bg-slate-900/40 border border-slate-200/60 dark:border-slate-800/60 rounded-2xl p-6">
        <p class="text-[16px] text-slate-600 dark:text-slate-300">
            Still have questions or need more information? Our technical support team is here to help you with any inquiries or concerns you may have.
        </p>
        <div class="mt-3">
            <a href="{{ url('/contact') }}" class="inline-flex items-center gap-1 text-[14px] font-600 text-blue-600 dark:text-blue-400 hover:underline">
                Query the Technical Desk <span class="tracking-normal">&rarr;</span>
            </a>
        </div>
    </div>

</main>

@include('components.chatbot')
@include('headerfooter.footer')