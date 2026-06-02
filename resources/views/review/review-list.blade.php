@php $pageTitle = 'Reviews — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[1320px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row --}}
    <div class="flex items-end justify-between flex-wrap gap-4 mb-8">
        <div>
            <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Reviews</h1>
            <p class="text-[13.5px] text-slate-500 dark:text-slate-400 mt-1.5">Monitor, moderate, and manage user testimonials and client ratings.</p>
        </div>
    </div>

    {{-- Notification System Alerts --}}
    @if (session('success'))
        <div class="flex items-center gap-2.5 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200/60 dark:border-emerald-900/40 text-emerald-800 dark:text-emerald-400 px-4 py-3.5 rounded-xl text-[14px] font-500 mb-6 shadow-sm">
            <svg class="w-4 h-4 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('delete'))
        <div class="flex items-center gap-2.5 bg-red-50 dark:bg-red-950/30 border border-red-200/60 dark:border-red-900/40 text-red-800 dark:text-red-400 px-4 py-3.5 rounded-xl text-[14px] font-500 mb-6 shadow-sm">
            <svg class="w-4 h-4 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('delete') }}
        </div>
    @endif

    {{-- Grid Layout Engine --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse ($reviews ?? [] as $review)
            <div x-data="{ expandedReview: false }" 
                 class="group bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-5 flex flex-col justify-between transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 shadow-sm">
                
                <div>
                    {{-- Row Info Header --}}
                    <div class="flex items-start justify-between gap-3 mb-3.5">
                        <div class="flex items-center gap-3">
                            {{-- Avatar Placeholder Node --}}
                            <div class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200/50 dark:border-slate-700/50 text-slate-600 dark:text-slate-300 font-600 text-[13px] flex items-center justify-center uppercase select-none shrink-0">
                                {{ mb_substr($review->name, 0, 2) }}
                            </div>
                            <div>
                                <h2 class="text-[15.5px] font-600 text-slate-900 dark:text-slate-100 tracking-tight leading-snug">
                                    {{ $review->name }}
                                </h2>
                                <span class="text-[11.5px] text-slate-400 dark:text-slate-500 font-500">Verified User</span>
                            </div>
                        </div>

                        
                    </div>

                    {{-- Review Expandable Content Block --}}
                    <div class="text-[13.5px] leading-relaxed text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-900/30 rounded-xl p-3 border border-slate-100 dark:border-slate-800/20">
                        <p :class="expandedReview ? '' : 'line-clamp-4'" class="whitespace-pre-line">
                            {{ $review->review }}
                        </p>
                        
                        @if(strlen($review->review) > 160)
                            <button @click="expandedReview = !expandedReview" 
                                    class="mt-2 text-[12.5px] font-600 text-blue-600 dark:text-blue-400 hover:underline cursor-pointer focus:outline-none flex items-center gap-0.5">
                                <span x-text="expandedReview ? 'Show Less' : 'Read Full Review'"></span>
                                <svg class="w-3 h-3 transition-transform duration-200" :class="expandedReview ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>

                {{-- Card Action Operations Control --}}
                <div class="mt-5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-end text-[13px] font-600">
                    <a href="{{ url('/delete-review/' . $review->id) }}" 
                       class="inline-flex items-center gap-1 text-slate-400 hover:text-red-600 dark:text-slate-500 dark:hover:text-red-400 no-underline hover:underline transition-colors"
                       onclick="return confirm('Are you sure you want to delete this client testimonial?');">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete review
                    </a>
                </div>

            </div>
        @empty
            {{-- Empty Grid State Engine --}}
            <div class="col-span-full flex flex-col items-center justify-center border border-dashed border-slate-300 dark:border-slate-700 rounded-2xl py-12 px-4 bg-slate-50/50 dark:bg-slate-900/20 text-center">
                <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                </div>
                <h3 class="text-[15px] font-600 text-slate-900 dark:text-slate-100">{{ $message ?? 'No reviews found' }}</h3>
                <p class="text-[13px] text-slate-400 dark:text-slate-500 mt-1 max-w-xs">User testimonial records and satisfaction submissions will appear here.</p>
            </div>
        @endforelse

    </div>

    {{-- Clean Framework Pagination Render --}}
    @if(method_exists($reviews, 'links'))
        <div class="mt-10 border-t border-slate-200 dark:border-slate-800/60 pt-6">
            {{ $reviews->links('pagination::tailwind') }}
        </div>
    @endif

</main>

@include('layouts.footer')