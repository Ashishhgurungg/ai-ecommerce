@include('headerfooter.boiler')
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">
    @include('headerfooter.header')

    <!-- Alpine.js (Make sure it's loaded) -->
    <script src="https://unpkg.com/alpinejs" defer></script>

    <main class="flex-grow p-6 items-center flex flex-col">
        <h1 class="text-3xl font-bold underline">Articles Page</h1>
        <p class="mt-4 text-center">Welcome to the Articles page.</p>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 w-full max-w-6xl">

            @forelse ($articles ?? [] as $article)
                <article class="bg-[#1a1f2b] p-4 rounded shadow hover:shadow-lg transition">
                    
                    @if ($article->image_path && file_exists(storage_path('app/public/articles/' . $article->image_path)))
                        <img 
                            src="{{ asset('storage/articles/' . $article->image_path) }}"
                            alt="{{ $article->title }}"
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

                    <h2 class="text-xl font-semibold mb-2">{{ $article->title }}</h2>

                    <!-- 🔥 Alpine.js Description Toggle -->
                    <div x-data="{ expanded: false }">

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

                        <!-- Read More / Read Less Button -->
                        <!-- <button
                            class="text-blue-400 mt-2 hover:underline"
                            @click="expanded = !expanded"
                            x-text="expanded ? 'Read Less' : 'Read More'">
                        </button> -->

                        <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">
                            <a href="{{ url('/article/' . $article->id) }}">View Article</a>
                        </button>

                    </div>

                </article>
            @empty
                <div class="col-span-3 text-center bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-6">
                    {{ $message ?? 'No articles available.' }}
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $articles->links('pagination::tailwind') }}
        </div>

    </main>

    @include('headerfooter.footer')
</body>
</html>
