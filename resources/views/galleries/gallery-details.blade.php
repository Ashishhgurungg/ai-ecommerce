@include('headerfooter.boiler')
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">

@include('headerfooter.header')

<main class="flex-grow p-6 flex flex-col items-center">

    {{-- Page Title --}}
    <h1 class="text-4xl font-bold underline mb-2 tracking-wide">Gallery Details</h1>
    <p class="mt-2 text-[#aab4c4] text-lg">Explore the details of this gallery.</p>

    <div class="bg-[#1d2233] border border-[#2a3145] p-5 rounded-xl shadow-md mt-10 w-full max-w-3xl">

        {{-- Images --}}
        @if(isset($gallery->images) && count($gallery->images))

            <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mb-4">

                @foreach($gallery->images as $imagePath)

                    <img src="{{ asset('storage/galleries/' . $imagePath) }}"
                         alt="{{ $gallery->title }}"
                         class="w-full h-48 object-cover rounded-lg">

                @endforeach

            </div>

        @else

            <img src="{{ asset('images/default.jpg') }}"
                 alt="No image"
                 class="w-full h-64 object-cover rounded-lg mb-4">

        @endif

        {{-- Title --}}
        <h2 class="text-2xl font-semibold mb-2 text-white tracking-wide">
            {{ $gallery->title }}
        </h2>

        {{-- Description --}}
        <p class="text-[#b7bfcc] text-sm leading-relaxed mt-4">
            {{ $gallery->description }}
        </p>

    </div>

</main>

</body>
</html>