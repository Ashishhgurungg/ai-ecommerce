@php $pageTitle = 'Services — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[1320px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row --}}
    <div class="flex items-end justify-between flex-wrap gap-4 mb-8">
        <div>
            <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Services</h1>
            <p class="text-[15px] text-slate-600 dark:text-slate-300 mt-1.5">Configure, update, and manage your operational service listings.</p>
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

        @forelse ($services ?? [] as $service)
            @php
                $avg = $service->average_rating;
                $count = $service->rating_count;
                $rated = $alreadyRatedForService[$service->id] ?? false;
            @endphp
            <article class="group bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-4 flex flex-col overflow-hidden transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 shadow-sm">

                {{-- Service Block Cover Image --}}
                <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 shrink-0 mb-4 border border-slate-100 dark:border-slate-800/40 p-2 flex items-center justify-center">
                    @if($service->image_path && file_exists(storage_path('app/public/services/' . $service->image_path)))
                        <img src="{{ asset('storage/services/' . $service->image_path) }}" 
                             alt="{{ $service->name }}" 
                             class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-[1.02]"
                             loading="lazy">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 dark:text-slate-600 gap-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            </svg>
                            <span class="text-[11px] font-600 uppercase tracking-wider">Asset Missing</span>
                        </div>
                    @endif
                </div>

                {{-- Context Stack --}}
                <div class="flex-grow flex flex-col px-1">
                    
                    {{-- Row Info Header --}}
                    <div class="flex items-start justify-between gap-2 mb-1.5">
                        <h2 class="text-[20px] font-600 text-slate-900 dark:text-slate-100 tracking-tight leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            {{ $service->name }}
                        </h2>
                        <span class="text-[15px] font-700 text-blue-600 dark:text-blue-400 shrink-0 font-display">
                            ${{ number_format($service->price, 2) }}
                        </span>
                    </div>

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

                    {{-- Description Content Block via AlpineJS --}}
                    <div x-data="{ expanded: false }" class="text-[16px] leading-relaxed text-slate-600 dark:text-slate-300 flex-grow mb-2">
                        <div class="inline">
                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 130, '...') }}
                            </span>
                            <span x-show="expanded" x-cloak class="prose prose-sm dark:prose-invert max-w-none">
                                {!! $service->description !!}
                            </span>
                        </div>

                        @if(strlen(strip_tags($service->description)) > 130)
                            <button @click="expanded = !expanded" 
                                    class="inline text-[16px] font-600 text-blue-600 dark:text-blue-400 hover:underline ml-1 cursor-pointer focus:outline-none"
                                    x-text="expanded ? 'Read Less' : 'Read More'">
                            </button>
                        @endif
                    </div>

                    {{-- Card Action Operations Control --}}
                    <div class="mt-5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-between text-[16px] font-600">
                        <a href="{{ url('update-services/' . $service->id) }}" 
                           class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 no-underline hover:underline">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit service
                        </a>

                        <a href="{{ url('/delete-service/' . $service->id) }}" 
                           class="inline-flex items-center gap-1 text-slate-400 hover:text-red-600 dark:text-slate-500 dark:hover:text-red-400 no-underline hover:underline transition-colors"
                           onclick="return confirm('Are you sure you want to permanently remove this service listing?');">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete
                        </a>
                    </div>
                </div>

            </article>
        @empty
            {{-- Empty Grid State Engine --}}
            <div class="col-span-full flex flex-col items-center justify-center border border-dashed border-slate-300 dark:border-slate-700 rounded-2xl py-12 px-4 bg-slate-50/50 dark:bg-slate-900/20 text-center">
                <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37"/>
                    </svg>
                </div>
                <h3 class="text-[15px] font-600 text-slate-900 dark:text-slate-100">{{ $message ?? 'No services found' }}</h3>
                <p class="text-[13px] text-slate-400 dark:text-slate-500 mt-1 max-w-xs">Publish a professional service offering to initialize layout listings.</p>
            </div>
        @endforelse

    </div>

    {{-- Clean Framework Pagination Render --}}
    @if(method_exists($services, 'links'))
        <div class="mt-10 border-t border-slate-200 dark:border-slate-800/60 pt-6">
            {{ $services->links('pagination::tailwind') }}
        </div>
    @endif

</main>

@include('layouts.footer')