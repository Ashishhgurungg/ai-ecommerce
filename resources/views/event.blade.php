@include('headerfooter.boiler')
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">
    @include('headerfooter.header')
<!-- Alpine.js (Make sure it's loaded) -->
    <script src="https://unpkg.com/alpinejs" defer></script>

    <main class="flex-grow p-6 items-center flex flex-col">
        <h1 class="text-3xl font-bold underline">Events Page</h1>
        <p class="mt-4 text-center">Welcome to the Events page.</p>

        <!-- Event Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 w-full max-w-6xl">

            @forelse ($events ?? [] as $event)
                <article class="bg-[#1a1f2b] p-4 rounded shadow hover:shadow-lg transition">
                    
                    @if ($event->image_path && file_exists(storage_path('app/public/events/' . $event->image_path)))
                        <img 
                            src="{{ asset('storage/events/' . $event->image_path) }}"
                            alt="{{ $event->title }}"
                            class="w-full h-40 object-cover rounded mb-4"
                            width="200"
                            height="200"
                        >
                    @else
                        <img 
                            src="{{ asset('images/default.jpg') }}"
                            alt="No image available"
                            class="w-full h-40 object-cover rounded mb-4"
                            width="400"
                            height="300"
                        >
                    @endif

                    <h2 class="text-xl font-semibold mb-2">{{ $event->name }}</h2>

                    <!-- 🔥 Alpine.js Description Toggle -->
                    <div x-data="{ expanded: false }">

                        <p class="text-[#b0b8c1]">
                            <!-- Short preview -->
                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 150, '...') }}
                            </span>

                            <!-- Full description -->
                            <span x-show="expanded">
                                {!! $event->description !!}
                            </span>
                        </p>

                        <!-- Read More / Read Less Button -->
                        <button
                            class="text-blue-400 mt-2 hover:underline"
                            @click="expanded = !expanded"
                            x-text="expanded ? 'Read Less' : 'Read More'">
                        </button>
                        <div >
                            <a href="{{ url('/events/' . $event->id) }}" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 transition">
                                Register
                            </a>
                        </div>
                    </div>

                </article>
            @empty
                <div class="col-span-3 text-center bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-6">
                    {{ $message ?? 'No events available.' }}
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $events->links('pagination::tailwind') }}
        </div>

    </main>

@include('headerfooter.footer')
</body>