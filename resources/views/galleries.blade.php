@php $pageTitle = 'Media Repositories & Gallery — AI Studio'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

<main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300">

    {{-- Section Architecture Header Block --}}
    <header class="text-center max-w-xl mx-auto mb-12">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Systems Media
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            Media Repositories
        </h1>
        <p class="mt-2 text-[14px] text-slate-500 dark:text-slate-400 leading-relaxed">
            Browse through image collections, historical system logs, and capture data frames from our past event nodes.
        </p>
    </header>

    {{-- Gallery Matrix Grid Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

        @forelse ($galleries ?? [] as $gallery)
            @php
                $firstImage = collect($gallery->images)->first();
            @endphp

            <article class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                
                <div>
                    {{-- Graphic Context Array Wrapper --}}
                    <div class="w-full h-48 rounded-xl overflow-hidden mb-4 relative bg-slate-100 dark:bg-slate-800/50">
                        @if($firstImage)
                            <img src="{{ asset('storage/galleries/' . $firstImage) }}"
                                 alt="{{ $gallery->title }} Content Stream"
                                 class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300">
                        @else
                            <img src="{{ asset('images/default.jpg') }}"
                                 alt="No operational visual allocated"
                                 class="w-full h-full object-cover opacity-80 mix-blend-normal dark:opacity-40">
                        @endif
                    </div>

                    {{-- Title Anchor Module --}}
                    <h2 class="text-[17px] font-700 text-slate-900 dark:text-slate-100 tracking-tight group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                        {{ $gallery->title }}
                    </h2>
                </div>

                {{-- Action Pipeline Operational Module --}}
                <div class="border-t border-slate-100 dark:border-slate-800/80 pt-4 mt-5 flex items-center justify-between gap-2">
                    <span class="text-[11px] font-600 text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        {{ count($gallery->images ?? []) }} Asset Frameworks
                    </span>
                    
                    <a href="{{ url('/galleries/' . $gallery->id) }}"
                       class="inline-flex items-center justify-center px-4 py-2 bg-slate-100 hover:bg-slate-200/80 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 text-[12.5px] font-600 rounded-xl transition-all shadow-sm">
                        View Details
                    </a>
                </div>

            </article>
        @empty
            <div class="col-span-full text-center bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400 p-6 rounded-xl font-500 text-[14px]">
                <i class="fa-solid fa-images block text-2xl mb-2 opacity-80"></i>
                {{ $message ?? 'No active media galleries found inside this directory structure.' }}
            </div>
        @endforelse

    </div>

    {{-- System Core Target Pagination Interface --}}
    @if(method_exists($galleries, 'links'))
        <div class="mt-12 flex justify-center">
            {{ $galleries->links() }}
        </div>
    @endif

</main>

@include('headerfooter.footer')