@include('headerfooter.boiler') 
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">

    @include('headerfooter.header')

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>

    <main class="flex-grow p-6 flex flex-col items-center">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div x-data="{ show:true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 3000)"
                 class="bg-green-600 text-white px-4 py-2 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show:true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 3000)"
                 class="bg-red-600 text-white px-4 py-2 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif

        {{-- Page Header --}}
        <h1 class="text-4xl font-bold underline tracking-wide mb-2">Services</h1>
        <p class="mt-2 text-[#aab4c4] text-lg">Explore the services we offer.</p>
        <p class="mt-2 text-[#aab4c4] text-lg">For more information, <a href="{{ url('/contact') }}" class="text-blue-400 hover:text-blue-300 underline">Contact us</a></p>

        {{-- Services Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10 w-full max-w-7xl">

            @forelse ($services ?? [] as $service)

                @php
                    $avg = $service->average_rating;
                    $count = $service->rating_count;
                    $rated = $alreadyRatedForService[$service->id] ?? false;
                @endphp

                <article class="bg-[#1d2233] border border-[#2a3145] p-5 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-300">

                    {{-- Image --}}
                    @if($service->image_path && file_exists(storage_path('app/public/services/' . $service->image_path)))
                        <img src="{{ asset('storage/services/' . $service->image_path) }}" 
                             alt="{{ $service->name }}" 
                             class="w-full h-48 object-cover rounded-lg mb-4">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" 
                             alt="No image available" 
                             class="w-full h-48 object-cover rounded-lg mb-4">
                    @endif

                    {{-- Title --}}
                    <h2 class="text-xl font-semibold mb-2 text-white tracking-wide">
                        {{ $service->name }}
                    </h2>

                    {{-- Average Rating --}}
                    <div class="flex items-center mt-1 mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $avg ? 'text-yellow-400' : 'text-gray-600' }}"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.072 
                                         3.292a1 1 0 00.95.69h3.462c.969 
                                         0 1.371 1.24.588 1.81l-2.8 
                                         2.034a1 1 0 00-.364 1.118l1.073 
                                         3.292c.3.921-.755 1.688-1.54 
                                         1.118l-2.8-2.034a1 
                                         1 0 00-1.175 0l-2.8 
                                         2.034c-.784.57-1.838-.197-1.539-1.118l1.073-3.292a1 
                                         1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 
                                         1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor

                        <span class="text-sm text-[#c4ccd9] ml-2">
                            {{ number_format($avg, 1) }} / 5 ({{ $count }} ratings)
                        </span>
                    </div>

                    {{-- Description --}}
                    <div x-data="{ expanded: false }" class="mb-4">
                        <p class="text-[#b7bfcc] text-sm leading-relaxed">
                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 120, '...') }}
                            </span>

                            <span x-show="expanded">
                                {!! $service->description !!}
                            </span>
                        </p>

                        <button class="text-blue-400 mt-2 hover:underline text-sm"
                                @click="expanded = !expanded"
                                x-text="expanded ? 'Read Less' : 'Read More'">
                        </button>
                    </div>

                    {{-- Price --}}
                    <p class="text-blue-400 font-semibold text-lg">
                        Price: ${{ number_format($service->price, 2) }}
                    </p>

                    {{-- Rating Form with Animation --}}
<div class="mt-4"
     x-data="{ rating: 0, rated: {{ $rated ? 'true' : 'false' }} }">

    <label class="text-sm text-[#aab4c4]">Rate this service:</label>

    <form action="{{ route('services.rate', $service->id) }}" method="POST" class="mt-2 flex flex-col items-start">
        @csrf
        <div class="flex items-center space-x-1 mt-1">
            <template x-for="star in 5">
                <svg 
                    @click="if(!rated) rating = star"
                    :class="[
                        'w-7 h-7 cursor-pointer transition-all duration-200 transform',
                        rated ? 'opacity-40 cursor-not-allowed' : '',
                        rating >= star ? 'text-yellow-400 scale-110' : 'text-gray-600'
                    ]"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 
                             1.902 0l1.072 3.292a1 
                             1 0 00.95.69h3.462c.969 
                             0 1.371 1.24.588 
                             1.81l-2.8 2.034a1 
                             1 0 00-.364 1.118l1.073 
                             3.292c.3.921-.755 
                             1.688-1.54 
                             1.118l-2.8-2.034a1 
                             1 0 00-1.175 0l-2.8 
                             2.034c-.784.57-1.838-.197-1.539-1.118l1.073-3.292a1 
                             1 0 00-.364-1.118L2.98 
                             8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 
                             1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </template>
        </div>

        <input type="hidden" name="rating" x-model="rating">

        <button type="submit"
            :disabled="rated || rating === 0"
            :class="[
                'mt-2 px-4 py-1 text-sm rounded-lg transition-all duration-200',
                rated || rating === 0 
                    ? 'bg-gray-600 cursor-not-allowed opacity-60' 
                    : 'bg-blue-600 hover:bg-blue-700 text-white'
            ]">
            <span x-show="!rated">Submit Rating</span>
            <span x-show="rated">Already Rated</span>
        </button>
    </form>
</div>


                </article>

            @empty
                <div class="col-span-full text-center bg-yellow-200 text-yellow-900 px-4 py-3 rounded-lg font-semibold">
                    {{ $message ?? 'No services available.' }}
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $services->links('pagination::tailwind') }}
        </div>

    </main>

    @include('headerfooter.footer')

</body>
</html>
