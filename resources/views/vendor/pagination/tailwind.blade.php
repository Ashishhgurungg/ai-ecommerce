@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-8 border-t border-slate-200 dark:border-slate-800/80 pt-6">
        <ul class="flex items-center gap-1.5">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800/60 text-slate-400 dark:text-slate-600 text-[13px] font-600 rounded-lg cursor-not-allowed select-none border border-slate-200/40 dark:border-slate-800/40">
                    <span class="sr-only">Previous</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-1.5 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-[13px] font-600 rounded-lg border border-slate-200 dark:border-slate-800 transition-colors shadow-sm flex items-center"
                       rel="prev">
                        <span class="sr-only">Previous</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements Matrix Loop --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="w-8 h-8 flex items-end justify-center text-slate-400 dark:text-slate-600 font-600 text-[14px] pb-2 select-none">
                        {{ $element }}
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="w-8 h-8 flex items-center justify-center text-[13px] font-600 rounded-lg bg-blue-600 text-white shadow-sm shadow-blue-500/20 select-none">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="w-8 h-8 flex items-center justify-center text-[13px] font-600 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-1.5 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-[13px] font-600 rounded-lg border border-slate-200 dark:border-slate-800 transition-colors shadow-sm flex items-center"
                       rel="next">
                        <span class="sr-only">Next</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </li>
            @else
                <li class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800/60 text-slate-400 dark:text-slate-600 text-[13px] font-600 rounded-lg cursor-not-allowed select-none border border-slate-200/40 dark:border-slate-800/40">
                    <span class="sr-only">Next</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
            @endif

        </ul>
    </nav>
@endif