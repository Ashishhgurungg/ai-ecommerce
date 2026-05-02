<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1b2233] dark:text-gray-200 leading-tight">
            {{ __('Your Articles list') }}
        </h2>
    </x-slot>

<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>

    <main class="flex-grow p-6">

        <h1 class="text-3xl font-bold underline">Articles</h1>
        <p class="mt-4">Welcome to the Articles page.</p>

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

            @forelse ($articles ?? [] as $article)
                <article class="bg-[#1a1f2b] p-4 rounded shadow hover:shadow-lg transition">

                    {{-- Article Image --}}
                    @if($article->image_path && file_exists(storage_path('app/public/articles/' . $article->image_path)))
                        <img src="{{ asset('storage/articles/' . $article->image_path) }}" 
                             alt="{{ $article->name }}" 
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

                    {{-- Title --}}
                    <h2 class="text-blue-500 text-xl font-semibold mb-2">{{ $article->title }}</h2>

                    {{-- Description with Alpine.js --}}
                    <div x-data="{ expanded: false }" class="mb-2">

                        <p class="text-[#b0b8c1]">

                            <!-- Short preview -->
                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->description), 150, '...') }}
                            </span>

                            <!-- Full description -->
                            <span x-show="expanded">
                                {!! $article->description !!}
                            </span>

                        </p>

                        <!-- Toggle button -->
                        <button 
                            class="text-blue-400 hover:underline text-sm"
                            @click="expanded = !expanded"
                            x-text="expanded ? 'Read Less' : 'Read More'">
                        </button>

                    </div>

                    {{-- Action Buttons --}}
                    <a href="{{ url('update-articles/' . $article->id) }}" class="text-blue-500 hover:underline">
                        Update
                    </a>

                    <a href="{{ url('/delete-article/' . $article->id) }}" class="text-red-500 hover:underline ml-4">
                        Delete
                    </a>

                </article>

            @empty
                <div class="text-center bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-6">
                    {{ $message ?? 'No services available.' }}
                </div>
            @endforelse

        </div>

        <div class="mt-6">
            {{ $articles->links('pagination::tailwind') }}
        </div>

    </main>

</body>
</x-app-layout>
