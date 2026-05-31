@include('headerfooter.boiler')
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">
    @include('headerfooter.header')

    <main class="flex-1 flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-lg bg-[#16202b] rounded-xl shadow-lg p-8">
            <h1 class="text-3xl font-semibold mb-6 text-white">Register for Event</h1>
            @if (session('success'))
                <div class="mb-4 p-3 rounded-md bg-green-100 text-green-800 border border-green-300">
                    {{ session('success') }}
                </div>
            @endif
            <h2 class="text-xl font-medium mb-4 text-gray-300 bg-gray-600 p-3 rounded-md">{{ $event->name }}</h2>
            <form method="POST" action="{{ url('/events/' . $event->id . '/register') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-2" for="name">Name</label>
                    <input id="name" name="name" type="text" required class="w-full rounded-md border border-[#2d3a4f] bg-[#0e121c] px-4 py-3 text-[#d6dfed] outline-none focus:border-[#6c9ef4]" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2" for="email">Email</label>
                    <input id="email" name="email" type="email" required class="w-full rounded-md border border-[#2d3a4f] bg-[#0e121c] px-4 py-3 text-[#d6dfed] outline-none focus:border-[#6c9ef4]" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2" for="phone">Phone</label>
                    <input id="phone" name="phone" type="tel" required class="w-full rounded-md border border-[#2d3a4f] bg-[#0e121c] px-4 py-3 text-[#d6dfed] outline-none focus:border-[#6c9ef4]" />
                </div>
                <button type="submit" class="w-full rounded-md bg-[#3b82f6] px-4 py-3 text-white font-semibold hover:bg-[#2563eb]">Submit</button>
            </form>
        </div>
    </main>

    <!-- Alpine.js (Make sure it's loaded) -->
    <script src="https://unpkg.com/alpinejs" defer></script>

@include('headerfooter.footer')
</body>