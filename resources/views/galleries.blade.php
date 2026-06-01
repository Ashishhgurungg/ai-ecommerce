@include('headerfooter.boiler')
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">

    @include('headerfooter.header')

    <main class="flex-grow p-6 flex flex-col items-center">
        
        {{-- Page Title --}}
        <h1 class="text-4xl font-bold underline mb-2 tracking-wide">Gallery</h1>
        <p class="mt-2 text-[#aab4c4] text-lg">Browse our latest collections.</p>

        {{-- Gallery Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10 w-full max-w-7xl">

            @forelse ($galleries ?? [] as $gallery)
                <article class="bg-[#1d2233] border border-[#2a3145] p-5 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-300">

                    {{-- Image --}}
                    @php
    $firstImage = collect($gallery->images)->first();
@endphp

@if($firstImage)
    <img src="{{ asset('storage/galleries/' . $firstImage) }}"
         alt="{{ $gallery->title }}"
         class="w-full h-48 object-cover rounded-lg mb-4">
@else
    <img src="{{ asset('images/default.jpg') }}"
         alt="No image"
         class="w-full h-48 object-cover rounded-lg mb-4">
@endif

                    {{-- Title --}}
                    <h2 class="text-xl font-semibold mb-2 text-white tracking-wide">
                        {{ $gallery->title }}
                    </h2>

                    {{-- Description with Read More / Read Less --}}
                    <p class="text-[#b7bfcc] text-sm leading-relaxed overflow-hidden max-h-20 transition-all duration-300 read-more-text">
                        {{ $gallery->description }}
                    </p>

                    <button class="read-more-btn text-blue-400 mt-2 hover:underline text-sm">
                        Read More
                    </button>
                    <div class="mt-4 flex justify-end">
                        <a href="{{ url('/galleries/' . $gallery->id) }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">
                            View Details
                        </a>
                </div>

                </article>

            @empty
                <div class="col-span-full text-center bg-yellow-200 text-yellow-900 px-4 py-3 rounded-lg font-semibold">
                    {{ $message ?? 'No galleries available.' }}
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $galleries->links('pagination::tailwind') }}
        </div>

    </main>

    @include('headerfooter.footer')

    {{-- Read More Script --}}
    <script>
        document.querySelectorAll(".read-more-btn").forEach((btn, index) => {
            btn.addEventListener("click", () => {
                const text = btn.previousElementSibling;

                if (text.classList.contains("max-h-20")) {
                    text.classList.remove("max-h-20");
                    text.classList.add("max-h-full");
                    btn.textContent = "Read Less";
                } else {
                    text.classList.add("max-h-20");
                    text.classList.remove("max-h-full");
                    btn.textContent = "Read More";
                }
            });
        });
    </script>

</body>
</html>

