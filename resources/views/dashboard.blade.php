@php $pageTitle = 'Dashboard — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[1320px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page heading --}}
    <div class="flex items-end justify-between flex-wrap gap-4 mb-10">
        <div>
            <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Dashboard</h1>
            <p class="text-[13.5px] text-slate-500 dark:text-slate-400 mt-1.5">Welcome back, {{ Auth::user()->name }} — here's everything at a glance.</p>
        </div>
        <span class="flex items-center gap-1.5 text-[12.5px] text-slate-500 dark:text-slate-400 font-500 bg-white dark:bg-slate-800/40 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-800/60 shadow-sm">
            <svg class="w-3.5 h-3.5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            {{ now()->format('D, d M Y') }}
        </span>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-[18px]">

        {{-- Galleries (Converted from Orange to Premium Blue-600) --}}
        <div class="group relative bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-[22px] overflow-hidden transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 cursor-default">
            {{-- Radial Top-Right Glow Effect --}}
            <div class="absolute top-0 right-0 w-[72px] h-[72px] rounded-bl-full bg-blue-600/5 dark:bg-blue-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            
            <div class="flex items-start justify-between">
                <span class="text-[10.5px] font-700 tracking-widest uppercase text-slate-400 dark:text-slate-500">Galleries</span>
                <span class="w-[38px] h-[38px] rounded-lg flex items-center justify-center shrink-0 bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400">
                    <svg class="w-[17px] h-[17px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
            </div>
            <p class="font-display text-[44px] sm:text-[36px] lg:text-[44px] font-700 text-slate-900 dark:text-slate-100 leading-none tracking-[-1.5px] mt-3">{{ $galleriesCount ?? 0 }}</p>
            <div class="mt-4.5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60">
                <a href="{{ url('/all-galleries') }}" class="inline-flex items-center gap-1 text-[12px] font-500 text-slate-400 dark:text-slate-500 no-underline transition-colors duration-150 hover:text-blue-600 dark:hover:text-blue-400">
                    View all galleries
                    <svg class="w-2.5 h-2.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Articles --}}
        <div class="group relative bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-[22px] overflow-hidden transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 cursor-default">
            <div class="absolute top-0 right-0 w-[72px] h-[72px] rounded-bl-full bg-blue-600/5 dark:bg-blue-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            
            <div class="flex items-start justify-between">
                <span class="text-[10.5px] font-700 tracking-widest uppercase text-slate-400 dark:text-slate-500">Articles</span>
                <span class="w-[38px] h-[38px] rounded-lg flex items-center justify-center shrink-0 bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400">
                    <svg class="w-[17px] h-[17px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </span>
            </div>
            <p class="font-display text-[44px] sm:text-[36px] lg:text-[44px] font-700 text-slate-900 dark:text-slate-100 leading-none tracking-[-1.5px] mt-3">{{ $articlesCount ?? 0 }}</p>
            <div class="mt-4.5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60">
                <a href="{{ url('/all-articles') }}" class="inline-flex items-center gap-1 text-[12px] font-500 text-slate-400 dark:text-slate-500 no-underline transition-colors duration-150 hover:text-blue-600 dark:hover:text-blue-400">
                    View all articles
                    <svg class="w-2.5 h-2.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Services --}}
        <div class="group relative bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-[22px] overflow-hidden transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 cursor-default">
            <div class="absolute top-0 right-0 w-[72px] h-[72px] rounded-bl-full bg-purple-600/5 dark:bg-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            
            <div class="flex items-start justify-between">
                <span class="text-[10.5px] font-700 tracking-widest uppercase text-slate-400 dark:text-slate-500">Services</span>
                <span class="w-[38px] h-[38px] rounded-lg flex items-center justify-center shrink-0 bg-purple-50 dark:bg-purple-950/50 text-purple-600 dark:text-purple-400">
                    <svg class="w-[17px] h-[17px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </span>
            </div>
            <p class="font-display text-[44px] sm:text-[36px] lg:text-[44px] font-700 text-slate-900 dark:text-slate-100 leading-none tracking-[-1.5px] mt-3">{{ $servicesCount ?? 0 }}</p>
            <div class="mt-4.5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60">
                <a href="{{ url('/all-services') }}" class="inline-flex items-center gap-1 text-[12px] font-500 text-slate-400 dark:text-slate-500 no-underline transition-colors duration-150 hover:text-purple-600 dark:hover:text-purple-400">
                    View all services
                    <svg class="w-2.5 h-2.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Events --}}
        <div class="group relative bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-[22px] overflow-hidden transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 cursor-default">
            <div class="absolute top-0 right-0 w-[72px] h-[72px] rounded-bl-full bg-emerald-600/5 dark:bg-emerald-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            
            <div class="flex items-start justify-between">
                <span class="text-[10.5px] font-700 tracking-widest uppercase text-slate-400 dark:text-slate-500">Events</span>
                <span class="w-[38px] h-[38px] rounded-lg flex items-center justify-center shrink-0 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-[17px] h-[17px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
            </div>
            <p class="font-display text-[44px] sm:text-[36px] lg:text-[44px] font-700 text-slate-900 dark:text-slate-100 leading-none tracking-[-1.5px] mt-3">{{ $eventsCount ?? 0 }}</p>
            <div class="mt-4.5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60">
                <a href="{{ url('/all-events') }}" class="inline-flex items-center gap-1 text-[12px] font-500 text-slate-400 dark:text-slate-500 no-underline transition-colors duration-150 hover:text-emerald-600 dark:hover:text-emerald-400">
                    View all events
                    <svg class="w-2.5 h-2.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Attendees --}}
        <div class="group relative bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-[22px] overflow-hidden transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 cursor-default">
            <div class="absolute top-0 right-0 w-[72px] h-[72px] rounded-bl-full bg-sky-600/5 dark:bg-sky-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            
            <div class="flex items-start justify-between">
                <span class="text-[10.5px] font-700 tracking-widest uppercase text-slate-400 dark:text-slate-500">Event Attendees</span>
                <span class="w-[38px] h-[38px] rounded-lg flex items-center justify-center shrink-0 bg-sky-50 dark:bg-sky-950/50 text-sky-600 dark:text-sky-400">
                    <svg class="w-[17px] h-[17px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </span>
            </div>
            <p class="font-display text-[44px] sm:text-[36px] lg:text-[44px] font-700 text-slate-900 dark:text-slate-100 leading-none tracking-[-1.5px] mt-3">{{ $attendeesCount ?? 0 }}</p>
            <div class="mt-4.5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60">
                <span class="text-[12px] font-500 text-slate-400 dark:text-slate-500 cursor-default">Total registered</span>
            </div>
        </div>

        {{-- Inquiries --}}
        <div class="group relative bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-[22px] overflow-hidden transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 cursor-default">
            <div class="absolute top-0 right-0 w-[72px] h-[72px] rounded-bl-full bg-rose-600/5 dark:bg-rose-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            
            <div class="flex items-start justify-between">
                <span class="text-[10.5px] font-700 tracking-widest uppercase text-slate-400 dark:text-slate-500">Contact Messages</span>
                <span class="w-[38px] h-[38px] rounded-lg flex items-center justify-center shrink-0 bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400">
                    <svg class="w-[17px] h-[17px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
            </div>
            <p class="font-display text-[44px] sm:text-[36px] lg:text-[44px] font-700 text-slate-900 dark:text-slate-100 leading-none tracking-[-1.5px] mt-3">{{ $inquiriesCount ?? 0 }}</p>
            <div class="mt-4.5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60">
                <a href="{{ url('/inquiries') }}" class="inline-flex items-center gap-1 text-[12px] font-500 text-slate-400 dark:text-slate-500 no-underline transition-colors duration-150 hover:text-rose-600 dark:hover:text-rose-400">
                    View all inquiries
                    <svg class="w-2.5 h-2.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

    </div>
</main>

@include('layouts.footer')