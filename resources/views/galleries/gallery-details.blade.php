@php $pageTitle = $gallery->title . ' — AI Studio Gallery'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

<main class="flex-grow max-w-6xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300">

    {{-- Section Architecture Header Block --}}
    <header class="text-center max-w-xl mx-auto mb-12">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Media Asset Registry
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            Gallery Details
        </h1>
        <p class="mt-2 text-[14px] text-slate-500 dark:text-slate-400 leading-relaxed">
            Reviewing rendering output, visual asset nodes, and operational layout specifications.
        </p>
    </header>

    {{-- Main Dataset Card Container --}}
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-6 sm:p-8 rounded-2xl shadow-sm space-y-8">
        
        {{-- Image Node Rendering Pipeline --}}
        @if(isset($gallery->images) && count($gallery->images))
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($gallery->images as $imagePath)
                    <div class="group relative aspect-[4/3] rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-100 dark:border-slate-800">
                        <img src="{{ asset('storage/galleries/' . $imagePath) }}"
                             alt="{{ $gallery->title }}"
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                             loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Standardized Null Payload Fallback View --}}
            <div class="flex flex-col items-center justify-center p-12 bg-slate-50 dark:bg-slate-800/20 border border-dashed border-slate-200 dark:border-slate-800 rounded-xl text-center">
                <svg class="w-10 h-10 text-slate-300 dark:text-slate-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 002-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-[14px] font-600 text-slate-900 dark:text-slate-100">Empty Media Payload</h3>
                <p class="text-[12px] text-slate-400 dark:text-slate-500 max-w-xs mt-1">No images are currently mapped to this specific gallery data object.</p>
            </div>
        @endif

        {{-- Meta Content Separator --}}
        <div class="border-t border-slate-100 dark:border-slate-800/60 pt-6">
            <span class="block text-[11px] font-700 uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-2">
                Gallery Title Parameter
            </span>
            <h2 class="font-display text-2xl font-800 text-slate-900 dark:text-white tracking-tight">
                {{ $gallery->title }}
            </h2>
            
            <span class="block text-[11px] font-700 uppercase tracking-widest text-slate-400 dark:text-slate-500 mt-6 mb-2">
                Context Description
            </span>
            <div class="prose prose-slate dark:prose-invert max-w-none">
                <p class="text-[14px] text-slate-600 dark:text-slate-400 leading-relaxed font-normal">
                    {{ $gallery->description }}
                </p>
            </div>
        </div>

    </div>
</main>

@include('headerfooter.footer')