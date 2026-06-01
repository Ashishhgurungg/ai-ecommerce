@include('layouts.header')

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>

  <main class="flex-grow p-6">

    <h1 class="text-3xl font-bold underline">Events</h1>
    <p class="mt-4">Welcome to the Events page.</p>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('delete'))
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-6">
            {{ session('delete') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">

        @forelse ($events ?? [] as $event)

        <article class="bg-[#1a1f2b] p-4 rounded shadow hover:shadow-lg transition">

            {{-- Image --}}
            @if($event->image_path && file_exists(storage_path('app/public/events/' . $event->image_path)))
              <img src="{{ asset('storage/events/' . $event->image_path) }}" 
                  alt="{{ $event->name }}" 
                  class="w-full h-40 object-cover rounded mb-4">
            @else
              <img src="{{ asset('images/default.jpg') }}" 
                  alt="No image available" 
                  class="w-full h-40 object-cover rounded mb-4">
            @endif

            {{-- Title --}}
            <h2 class="text-blue-500 text-xl font-semibold mb-2">{{ $event->name }}</h2>

            {{-- Date --}}
            <p class="text-gray-400 mb-2 dark:text-gray-500">Date: {{ $event->date }}</p>

            {{-- Description with Alpine.js --}}
            <div x-data="{ expanded: false }" class="mb-2">

                <p class="text-[#b0b8c1]">

                    <!-- Short truncated text -->
                    <span x-show="!expanded">
                        {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 150, '...') }}
                    </span>

                    <!-- Full description -->
                    <span x-show="expanded">
                        {!! $event->description !!}
                    </span>

                </p>

                <!-- Read More / Read Less button -->
                <button 
                    class="text-blue-400 hover:underline text-sm"
                    @click="expanded = !expanded"
                    x-text="expanded ? 'Read Less' : 'Read More'">
                </button>

            </div>

            {{-- Price --}}
            <p class="text-blue-400">Price: ${{ $event->price }}</p>

            {{-- Actions --}}
            <a href="{{ url('update-events/' . $event->id) }}" class="text-blue-500 hover:underline">Edit</a>
            <a href="{{ url('/delete-event/'.$event->id) }}" class="text-red-500 hover:underline ml-4">Delete</a>
            <a href="{{ url('/events/' . $event->id . '/attendees') }}" class="text-yellow-500 hover:underline ml-4">View Attendees</a>

        </article>

        @empty
            <div class="text-center bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-6">
                {{ $message ?? 'No events available.' }}
            </div>
        @endforelse

    </div>

    <div class="mt-6">
        {{ $events->links('pagination::tailwind') }}
    </div>

</main>

    @include('layouts.footer')
