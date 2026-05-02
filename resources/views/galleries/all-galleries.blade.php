<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1b2233] dark:text-gray-200 leading-tight">
            {{ __('Your galleries list') }}
        </h2>
    </x-slot>

<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">

  <main class="flex-grow p-6">

    <h1 class="text-3xl font-bold underline">galleries</h1>
    <p class="mt-4">Welcome to the galleries page.</p>

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
        @forelse ($galleries ?? [] as $gallery)
        <gallery class="bg-[#1a1f2b] p-4 rounded shadow hover:shadow-lg transition">

            @if($gallery->image_path && file_exists(storage_path('app/public/galleries/' . $gallery->image_path)))
                <img src="{{ asset('storage/galleries/' . $gallery->image_path) }}" 
                     alt="{{ $gallery->name }}" 
                     class="w-full h-40 object-cover rounded mb-4" 
                     width="200" 
                     height="200">
            @else
                <img src="{{ asset('images/default.jpg') }}" 
                     alt="No image available" 
                     class="w-full h-40 object-cover rounded mb-4" 
                     width="400" 
                     height="300">
            @endif

            <h2 class="text-blue-500 text-xl font-semibold mb-2">{{ $gallery->title }}</h2>

            {{-- Description with Alpine.js toggle --}}
            <div x-data="{ expanded: false }" class="text-[#b0b8c1] mb-2">
                <p>
                    <span x-show="!expanded">
                        {{ \Illuminate\Support\Str::limit($gallery->description, 120) }}
                    </span>
                    <span x-show="expanded">
                        {{ $gallery->description }}
                    </span>
                </p>
                @if(strlen($gallery->description) > 120)
                    <button 
                        @click="expanded = !expanded" 
                        class="text-blue-400 hover:underline mt-1">
                        <span x-show="!expanded">Read more</span>
                        <span x-show="expanded">Read less</span>
                    </button>
                @endif
            </div>

            <a href="{{ url('update-galleries/' . $gallery->id) }}" class="text-blue-500 hover:underline">Update</a>
            <a href="{{ url('/delete-gallery/' . $gallery->id) }}" class="text-red-500 hover:underline ml-4">Delete</a>

        </gallery>
        @empty
        <div class="text-center bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-6">
            {{ $message ?? 'No galleries available.' }}
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $galleries->links('pagination::tailwind') }}
    </div>

  </main>

</body>
</x-app-layout>
