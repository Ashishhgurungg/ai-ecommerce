@php $pageTitle = $event->name . ' — AI Studio Journal'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

<main class="flex-grow max-w-4xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300">

    {{-- Section Architecture Header Block --}}
    <header class="text-center max-w-xl mx-auto mb-12">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[14px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Event Details
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            Read the Full Event Briefing and Insights
        </h1>
    </header>

    {{-- Main Editorial Container Block --}}
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded-2xl shadow-sm overflow-hidden">
        
        {{-- Hero Header Image Processing Layer --}}
        @if(isset($event->image_path) && $event->image_path)
            <div class="w-full aspect-[21/9] bg-slate-100 dark:bg-slate-800 border-b border-slate-100 dark:border-slate-800/60 overflow-hidden">
                <img src="{{ asset('storage/events/' . $event->image_path) }}"
                     alt="{{ $event->name }}"
                     class="w-full h-full object-cover">
            </div>
        @else
            {{-- Unified Structural Fallback Graphic Node --}}
            <div class="w-full aspect-[21/9] bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800/60 flex flex-col items-center justify-center text-center p-6">
                <svg class="w-10 h-10 text-slate-300 dark:text-slate-700 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-[12px] font-500 text-slate-400 dark:text-slate-500">Asset Stream Null</span>
            </div>
        @endif

        {{-- Meta Body Article Core Data --}}
        <div class="p-6 sm:p-8">
            
            <span class="block text-[14px] font-700 uppercase tracking-widest text-slate-600 dark:text-slate-400 mb-2">
                {{ $event->created_at->format('F j, Y') }}
            </span>
            
            <h2 class="font-display text-2xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight mb-6">
                {{ $event->name }}
            </h2>

            <div class="border-t border-slate-100 dark:border-slate-800/60 pt-6">
                <div class="prose prose-slate dark:prose-invert max-w-none">
                    <p class="text-[14px] sm:text-[18px] text-slate-600 dark:text-slate-400 leading-relaxed font-normal whitespace-pre-line">
                        {{ $event->description }}
                    </p>
                </div>
            </div>

        </div>
    </div>
    <div class="border-t border-slate-100 dark:border-slate-800/80 pt-4 mt-2">
        <a href="{{ url('/events/' . $event->id) }}" 
            class="w-full flex items-center justify-center px-4 py-4 bg-slate-900 hover:bg-slate-800 dark:bg-slate-100 dark:hover:bg-white text-white dark:text-slate-900 text-[16px] font-600 rounded-xl transition-all shadow-sm">
            Register for Session
        </a>
    </div>

    {{-- System Core Direct Support Line Hook --}}
    <div class="mt-8 text-left">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1.5 text-[16px] font-600 text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
            <span class="tracking-normal">&larr;</span> Return to Events Directory
        </a>
    </div>

</main>

@include('headerfooter.footer')