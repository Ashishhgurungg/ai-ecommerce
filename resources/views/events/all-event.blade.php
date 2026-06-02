@php $pageTitle = 'Events — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[1320px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row --}}
    <div class="flex items-end justify-between flex-wrap gap-4 mb-8">
        <div>
            <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Events</h1>
            <p class="text-[13.5px] text-slate-500 dark:text-slate-400 mt-1.5">Schedule, monitor registrations, and manage operational community events.</p>
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

        @forelse ($events ?? [] as $event)
            <article class="group bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-4 flex flex-col overflow-hidden transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 shadow-sm">

                {{-- Event Media Canvas --}}
                <div class="relative w-full h-44 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 shrink-0 mb-4 border border-slate-100 dark:border-slate-800/40">
                    @if($event->image_path && file_exists(storage_path('app/public/events/' . $event->image_path)))
                        <img src="{{ asset('storage/events/' . $event->image_path) }}" 
                             alt="{{ $event->name }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.03]"
                             loading="lazy">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 dark:text-slate-600 gap-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-[11px] font-600 uppercase tracking-wider">No Event Image</span>
                        </div>
                    @endif
                </div>

                {{-- Context Stack --}}
                <div class="flex-grow flex flex-col px-1">
                    
                    {{-- Row Info Header --}}
                    <div class="flex items-start justify-between gap-2 mb-1.5">
                        <h2 class="text-[17px] font-600 text-slate-900 dark:text-slate-100 tracking-tight leading-snug group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            {{ $event->name }}
                        </h2>
                        <span class="text-[14px] font-700 text-emerald-600 dark:text-emerald-400 shrink-0 font-display">
                            {{ (float)$event->price > 0 ? '$' . number_format($event->price, 2) : 'Free' }}
                        </span>
                    </div>

                    {{-- Event Meta Badge Strip --}}
                    <div class="flex items-center gap-1.5 text-slate-400 dark:text-slate-500 text-[12.5px] font-500 mb-2.5">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</span>
                    </div>

                    {{-- Description Content Block via AlpineJS --}}
                    <div x-data="{ expanded: false }" class="text-[13.5px] leading-relaxed text-slate-500 dark:text-slate-400 flex-grow mb-2">
                        <div class="inline">
                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 130, '...') }}
                            </span>
                            <span x-show="expanded" x-cloak class="prose prose-sm dark:prose-invert max-w-none">
                                {!! $event->description !!}
                            </span>
                        </div>

                        @if(strlen(strip_tags($event->description)) > 130)
                            <button @click="expanded = !expanded" 
                                    class="inline text-[13px] font-600 text-emerald-600 dark:text-emerald-400 hover:underline ml-1 cursor-pointer focus:outline-none"
                                    x-text="expanded ? 'Read Less' : 'Read More'">
                            </button>
                        @endif
                    </div>

                    {{-- Card Action Operations Control --}}
                    <div class="mt-5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-between text-[13px] font-600 gap-2 flex-wrap">
                        
                        <div class="flex items-center gap-3.5">
                            <a href="{{ url('update-event/' . $event->id) }}" 
                               class="inline-flex items-center gap-1 text-emerald-600 dark:text-emerald-400 no-underline hover:underline">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>

                            <a href="{{ url('/events/' . $event->id . '/attendees') }}" 
                               class="inline-flex items-center gap-1 text-slate-600 dark:text-slate-300 no-underline hover:underline">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Attendees
                            </a>
                        </div>

                        <a href="{{ url('/delete-event/' . $event->id) }}" 
                           class="inline-flex items-center gap-1 text-slate-400 hover:text-red-600 dark:text-slate-500 dark:hover:text-red-400 no-underline hover:underline transition-colors"
                           onclick="return confirm('Are you sure you want to cancel and remove this event?');">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-[15px] font-600 text-slate-900 dark:text-slate-100">{{ $message ?? 'No events found' }}</h3>
                <p class="text-[13px] text-slate-400 dark:text-slate-500 mt-1 max-w-xs">Organize an interactive milestone event listing to fill up the track grid.</p>
            </div>
        @endforelse

    </div>

    {{-- Clean Framework Pagination Render --}}
    @if(method_exists($events, 'links'))
        <div class="mt-10 border-t border-slate-200 dark:border-slate-800/60 pt-6">
            {{ $events->links('pagination::tailwind') }}
        </div>
    @endif

</main>

@include('layouts.footer')