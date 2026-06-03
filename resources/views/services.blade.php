@php $pageTitle = 'Services Matrix — AI Studio'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

{{-- Alpine.js Infrastructure Drop-in --}}
<script src="https://unpkg.com/alpinejs" defer></script>

<main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300">

    {{-- System Status Flash Toast Overlays --}}
    <div class="w-full max-w-md mx-auto mb-6">
        @if(session('success'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 4000)"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm text-[13.5px] font-500">
                <i class="fa-solid fa-circle-check text-base"></i>
                <span class="flex-1">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 4000)"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="flex items-center gap-3 bg-rose-500/10 border border-rose-500/30 text-rose-600 dark:text-rose-400 p-4 rounded-xl shadow-sm text-[13.5px] font-500">
                <i class="fa-solid fa-circle-exclamation text-base"></i>
                <span class="flex-1">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    {{-- Section Architecture Header Block --}}
    <header class="text-center max-w-xl mx-auto mb-12">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[15px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Services Catalog
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            Our AI Services & Solutions
        </h1>
        <p class="mt-2 text-[16px] text-slate-600 dark:text-slate-300 leading-relaxed">
            Explore our automated functional arrays. For complex technical specifications, please 
            <a href="{{ url('/contact') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-600">contact our engineering desk</a>.
        </p>
    </header>

    {{-- Operational Services Matrix Grid Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

        @forelse ($services ?? [] as $service)
            @php
                $avg = $service->average_rating;
                $count = $service->rating_count;
                $rated = $alreadyRatedForService[$service->id] ?? false;
            @endphp

            <article class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                <div>
                    {{-- Media Content Preview Frame --}}
                    <div class="w-full h-48 rounded-xl overflow-hidden mb-4 relative bg-slate-100 dark:bg-slate-800/50">
                        @if($service->image_path && file_exists(storage_path('app/public/services/' . $service->image_path)))
                            <img src="{{ asset('storage/services/' . $service->image_path) }}" 
                                 alt="{{ $service->name }} Interface Module" 
                                 class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" 
                                 alt="Default Service Placeholder Asset" 
                                 class="w-full h-full object-cover opacity-80 mix-blend-normal dark:opacity-40">
                        @endif
                    </div>

                    {{-- Title Anchor Module --}}
                    <h2 class="text-[20px] font-700 text-slate-900 dark:text-slate-100 tracking-tight group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ $service->name }}
                    </h2>

                    {{-- Structural Evaluation Analytics Metrics (Ratings) --}}
                    <div class="flex items-center gap-1.5 mt-1.5 mb-3.5" title="System Mean Evaluation Score: {{ number_format($avg, 1) }} / 5">
                        <div class="flex items-center gap-0.5">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $avg ? 'text-amber-400 fill-amber-400' : 'text-slate-200 dark:text-slate-700 fill-slate-200 dark:fill-slate-700' }}"
                                     viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.072 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.073 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.073-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-[12px] font-500 text-slate-400 dark:text-slate-500">
                            {{ number_format($avg, 1) }} ({{ $count }})
                        </span>
                    </div>

                    {{-- Dynamic Summary Text Controller --}}
                    <div x-data="{ expanded: false }" class="mb-4">
                        <p class="text-[16px] text-slate-600 dark:text-slate-300 leading-relaxed">
                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 110, '...') }}
                            </span>
                            <span x-show="expanded" x-cloak class="block prose prose-sm dark:prose-invert max-w-none text-[16px]">
                                {!! $service->description !!}
                            </span>
                        </p>
                        <button class="text-[12px] font-600 text-blue-600 dark:text-blue-400 mt-1 hover:underline focus:outline-none"
                                @click="expanded = !expanded"
                                x-text="expanded ? 'Collapse Summary' : 'Read Full Specs'">
                        </button>
                    </div>
                </div>

                {{-- Functional Value Assignment Grid Block --}}
                <div class="border-t border-slate-100 dark:border-slate-800/80 pt-4 mt-2">
                    <div class="flex items-baseline justify-between gap-2">
                        <span class="text-[11.5px] font-700 uppercase tracking-wider text-slate-600 dark:text-slate-300">Rate Package</span>
                        <div class="text-[16px] font-700 text-slate-900 dark:text-slate-100">
                            ${{ number_format($service->price, 2) }}
                        </div>
                    </div>

                    {{-- Automated Rating Processing Pipeline Component --}}
                    <div class="mt-3 bg-slate-50 dark:bg-slate-800/40 border border-slate-200/50 dark:border-slate-800/50 rounded-xl p-3"
                         x-data="{ rating: 0, hoverRating: 0, rated: {{ $rated ? 'true' : 'false' }} }">
                        
                        <form action="{{ route('services.rate', $service->id) }}" method="POST" class="flex items-center justify-between gap-2">
                            @csrf
                            <div class="flex items-center gap-0.5">
                                <template x-for="star in 5">
                                    <svg 
                                        @click="if(!rated) rating = star"
                                        @mouseenter="if(!rated) hoverRating = star"
                                        @mouseleave="if(!rated) hoverRating = 0"
                                        :class="[
                                            'w-6 h-6 transition-all duration-150',
                                            rated ? 'opacity-35 cursor-not-allowed' : 'cursor-pointer hover:scale-110 active:scale-95',
                                            (hoverRating >= star || (!hoverRating && rating >= star)) ? 'text-amber-400 fill-amber-400' : 'text-slate-300 dark:text-slate-700 fill-slate-300 dark:fill-slate-700'
                                        ]"
                                        viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.072 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.073 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.073-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </template>
                            </div>

                            <input type="hidden" name="rating" x-model="rating">

                            <button type="submit"
                                    :disabled="rated || rating === 0"
                                    :class="[
                                        'px-3 py-1.5 text-[11.5px] font-600 rounded-lg transition-all duration-150 focus:outline-none',
                                        rated || rating === 0 
                                            ? 'bg-slate-200 dark:bg-slate-800 text-slate-400 dark:text-slate-600 cursor-not-allowed' 
                                            : 'bg-blue-600 hover:bg-blue-700 text-white shadow-sm'
                                    ]">
                                <span x-show="!rated">Submit</span>
                                <span x-show="rated" x-cloak>Locked</span>
                            </button>
                        </form>
                    </div>
                </div>
            </article>

        @empty
            <div class="col-span-full text-center bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400 p-6 rounded-xl font-500 text-[14px]">
                <i class="fa-solid fa-folder-open block text-2xl mb-2 opacity-80"></i>
                {{ $message ?? 'No operational service configurations found within current repository matrix contexts.' }}
            </div>
        @endforelse

    </div>

    {{-- System Core Target Pagination Interface --}}
    @if(method_exists($services, 'links'))
        <div class="mt-12 flex justify-center">
            {{ $services->links() }}
        </div>
    @endif

</main>

@include('components.chatbot')
@include('headerfooter.footer')