@php $pageTitle = 'Articles — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[1320px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row --}}
    <div class="flex items-end justify-between flex-wrap gap-4 mb-8">
        <div>
            <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Articles</h1>
            <p class="text-[13.5px] text-slate-500 dark:text-slate-400 mt-1.5">Manage, review, and organize published content blocks.</p>
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse ($articles ?? [] as $article)
            <article class="group bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-4 flex flex-col overflow-hidden transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 shadow-sm">

                {{-- Article Cover Image Engine --}}
                <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 shrink-0 mb-4 border border-slate-100 dark:border-slate-800/40">
                    @if($article->image_path && file_exists(storage_path('app/public/articles/' . $article->image_path)))
                        <img src="{{ asset('storage/articles/' . $article->image_path) }}" 
                             alt="{{ $article->name ?? $article->title }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.03]"
                             loading="lazy">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 dark:text-slate-600 gap-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 012 2v6a2 2 0 01-2 2h-2m-4-14h.01M9 16h.01M9 12h.01M13 16h.01M13 12h.01"/>
                            </svg>
                            <span class="text-[11px] font-600 uppercase tracking-wider">No Cover Image</span>
                        </div>
                    @endif
                </div>

                {{-- Context Content Stack --}}
                <div class="flex-grow flex flex-col px-1">
                    <h2 class="text-[17px] font-600 text-slate-900 dark:text-slate-100 tracking-tight leading-snug mb-1.5 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ $article->title }}
                    </h2>

                    {{-- Description Blocks via AlpineJS --}}
                    <div x-data="{ expanded: false }" class="text-[13.5px] leading-relaxed text-slate-500 dark:text-slate-400 flex-grow mb-2">
                        <div class="inline">
                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->description), 130, '...') }}
                            </span>
                            <span x-show="expanded" x-cloak class="prose prose-sm dark:prose-invert max-w-none">
                                {!! $article->description !!}
                            </span>
                        </div>

                        @if(strlen(strip_tags($article->description)) > 130)
                            <button @click="expanded = !expanded" 
                                    class="inline text-[13px] font-600 text-blue-600 dark:text-blue-400 hover:underline ml-1 cursor-pointer focus:outline-none"
                                    x-text="expanded ? 'Read Less' : 'Read More'">
                            </button>
                        @endif
                    </div>

                    {{-- Card Level Action Controls --}}
                    <div class="mt-5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-between text-[13px] font-600">
                        <a href="{{ url('update-articles/' . $article->id) }}" 
                           class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 no-underline hover:underline">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit article
                        </a>

                        <a href="{{ url('/delete-article/' . $article->id) }}" 
                           class="inline-flex items-center gap-1 text-slate-400 hover:text-red-600 dark:text-slate-500 dark:hover:text-red-400 no-underline hover:underline transition-colors"
                           onclick="return confirm('Are you sure you want to permanently remove this article?');">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete
                        </a>
                    </div>
                </div>

            </article>
        @empty
            {{-- Empty State Engine --}}
            <div class="col-span-full flex flex-col items-center justify-center border border-dashed border-slate-300 dark:border-slate-700 rounded-2xl py-12 px-4 bg-slate-50/50 dark:bg-slate-900/20 text-center">
                <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 012 2v6a2 2 0 01-2 2h-2m-4-14h.01"/>
                    </svg>
                </div>
                <h3 class="text-[15px] font-600 text-slate-900 dark:text-slate-100">{{ $message ?? 'No articles found' }}</h3>
                <p class="text-[13px] text-slate-400 dark:text-slate-500 mt-1 max-w-xs">Draft or publish a brand new article resource to get started.</p>
            </div>
        @endforelse

    </div>

    {{-- Clean Framework Pagination Render --}}
    @if(method_exists($articles, 'links'))
        <div class="mt-10 border-t border-slate-200 dark:border-slate-800/60 pt-6">
            {{ $articles->links('pagination::tailwind') }}
        </div>
    @endif

</main>

@include('layouts.footer')