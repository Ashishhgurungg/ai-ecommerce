@include('layouts.header')

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>

  <main class="flex-grow p-6">

    <h1 class="text-3xl font-bold underline dark:text-white">Services</h1>
    <p class="mt-4 dark:text-gray-300">Welcome to the Services page.</p>

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

        @forelse ($services ?? [] as $service)

        <article class="bg-[#1a1f2b] p-4 rounded shadow hover:shadow-lg transition">

            {{-- Image --}}
            @if($service->image_path && file_exists(storage_path('app/public/services/' . $service->image_path)))
              <img src="{{ asset('storage/services/' . $service->image_path) }}" 
                  alt="{{ $service->name }}" 
                  class="w-full h-40 object-contain rounded mb-4">
            @else
              <img src="{{ asset('images/default.jpg') }}" 
                  alt="No image available" 
                  class="w-full h-40 object-cover rounded mb-4">
            @endif

            {{-- Title --}}
            <h2 class="text-blue-500 text-xl font-semibold mb-2">{{ $service->name }}</h2>

            {{-- Description with Alpine.js --}}
            <div x-data="{ expanded: false }" class="mb-2">

                <p class="text-[#b0b8c1]">

                    <!-- Short truncated text -->
                    <span x-show="!expanded">
                        {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 150, '...') }}
                    </span>

                    <!-- Full description -->
                    <span x-show="expanded">
                        {!! $service->description !!}
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
            <p class="text-blue-400">Price: ${{ $service->price }}</p>

            {{-- Actions --}}
            <a href="{{ url('update-services/' . $service->id) }}" class="text-blue-500 hover:underline">Edit</a>
            <a href="{{ url('/delete-service/'.$service->id) }}" class="text-red-500 hover:underline ml-4">Delete</a>

        </article>

        @empty
            <div class="text-center bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-6">
                {{ $message ?? 'No services available.' }}
            </div>
        @endforelse

    </div>

    <div class="mt-6">
        {{ $services->links('pagination::tailwind') }}
    </div>

</main>

    @include('layouts.footer')
