@include('headerfooter.boiler')
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">

@include('headerfooter.header')

<main class="flex-grow p-6 flex flex-col items-center">

    {{-- Page Title --}}
    <h1 class="text-4xl font-bold underline mb-2 tracking-wide">Blog Article</h1>
    <div class="bg-[#1d2233] border border-[#2a3145] p-5 rounded-xl shadow-md mt-10 w-full max-w-3xl">

        {{-- Images --}}
        @if(isset($article->image_path) && $article->image_path)
            <img src="{{ asset('storage/articles/' . $article->image_path) }}"
                 alt="{{ $article->title }}"
                 class="w-full h-64 object-cover rounded-lg mb-4">
        @else
            <img src="{{ asset('images/default.jpg') }}"
                 alt="No image available"
                 class="w-full h-64 object-cover rounded-lg mb-4">
        @endif

        {{-- Title --}}
        <h2 class="text-2xl font-semibold mb-2 text-white tracking-wide">
            {{ $article->title }}
        </h2>

        {{-- Description --}}
        <p class="text-[#b7bfcc] text-sm leading-relaxed mt-4">
            {{ $article->description }}
        </p>

    </div>

</main>

</body>
</html>