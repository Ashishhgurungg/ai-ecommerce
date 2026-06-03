@php $pageTitle = 'Event Attendees — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-7xl mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row & Context --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">
                Attendees list
            </h1>
            <p class="text-[16px] text-slate-600 dark:text-slate-300 mt-1.5">
                Active registration roster for <span class="font-600 text-blue-600 dark:text-blue-400">{{ $event->name }}</span>.
            </p>
        </div>
        
        {{-- Total Count Badge --}}
        <div class="inline-flex items-center px-3 py-1 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/60 rounded-full text-[16px] font-600 text-slate-600 dark:text-slate-400 self-start md:self-auto">
            Total Records: {{ $attendees->total() }}
        </div>
    </div>

    {{-- Success Notification Alerts --}}
    @if(session('success'))
        <div class="flex items-center gap-2.5 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200/60 dark:border-emerald-900/40 text-emerald-800 dark:text-emerald-400 px-4 py-3.5 rounded-xl text-[14px] font-500 mb-6 shadow-sm">
            <svg class="w-4 h-4 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Empty State Content Canvas --}}
    @if($attendees->isEmpty())
        <div class="text-center py-16 bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl shadow-sm">
            <svg class="w-12 h-12 text-slate-300 dark:text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <h3 class="text-[15px] font-600 text-slate-700 dark:text-slate-300">No Attendees Linked</h3>
            <p class="text-[13px] text-slate-400 dark:text-slate-500 mt-1 max-w-sm mx-auto">There are currently no active public registrations documented for this scheduled operational event package.</p>
        </div>
    @else
        {{-- Responsive Registry Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($attendees as $attendee)
                <div class="bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-8 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between group">
                    <div>
                        {{-- Name Header & Identity --}}
                        <div class="flex items-start justify-between gap-2 mb-4">
                            <h3 class="text-[16px] font-600 text-slate-900 dark:text-slate-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-1">
                                {{ $attendee->name }}
                            </h3>
                            <span class="inline-flex w-2 h-2 rounded-full bg-blue-500/80 mt-1.5 shrink-0"></span>
                        </div>

                        {{-- Metadata Stack --}}
                        <div class="space-y-3 border-t border-slate-100 dark:border-slate-800/60 pt-3.5 text-[15px]">
                            <div>
                                <span class="block text-[12px] font-700 text-slate-500 dark:text-slate-400 uppercase tracking-wider">Email Address</span>
                                <p class="text-slate-700 dark:text-slate-300 font-500 mt-0.5 break-all select-all">{{ $attendee->email }}</p>
                            </div>
                            
                            <div>
                                <span class="block text-[12px] font-700 text-slate-500 dark:text-slate-400 uppercase tracking-wider">Contact Phone</span>
                                <p class="text-slate-700 dark:text-slate-300 font-500 mt-0.5 select-all">{{ $attendee->phone ?? 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Action Control Row --}}
                    <div class="mt-5 pt-3 border-t border-slate-50 dark:border-slate-800/40 flex items-center justify-end">
                        <a href="{{ url('/events/attendees/delete/' . $attendee->id) }}" 
                           onclick="return confirm('Are you sure you want to completely remove this entry from the attendance registry?')"
                           class="text-[12px] font-600 text-red-500 dark:text-red-400/80 hover:text-red-700 dark:hover:text-red-400 inline-flex items-center gap-1.5 transition-colors group/btn">
                            <svg class="w-3.5 h-3.5 opacity-70 group-hover/btn:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Revoke Registration
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Customized UI Control Pagination Strip --}}
        @if ($attendees->hasPages())
            <div class="flex justify-center items-center gap-1.5 mt-8 border-t border-slate-200 dark:border-slate-800/80 pt-6">

                {{-- Previous Toggle Button --}}
                @if ($attendees->onFirstPage())
                    <span class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800/60 text-slate-400 dark:text-slate-600 text-[13px] font-600 rounded-lg cursor-not-allowed select-none border border-slate-200/40 dark:border-slate-800/40">
                        Previous
                    </span>
                @else
                    <a href="{{ $attendees->previousPageUrl() }}"
                       class="px-3 py-1.5 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-[13px] font-600 rounded-lg border border-slate-200 dark:border-slate-800 transition-colors shadow-sm">
                        Previous
                    </a>
                @endif

                {{-- Dynamic Page Matrix Loops --}}
                @foreach ($attendees->getUrlRange(1, $attendees->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                       class="w-8 h-8 flex items-center justify-center text-[13px] font-600 rounded-lg transition-all {{ $attendees->currentPage() == $page ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/20' : 'bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                        {{ $page }}
                    </a>
                @endforeach

                {{-- Next Toggle Button --}}
                @if ($attendees->hasMorePages())
                    <a href="{{ $attendees->nextPageUrl() }}"
                       class="px-3 py-1.5 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-[13px] font-600 rounded-lg border border-slate-200 dark:border-slate-800 transition-colors shadow-sm">
                        Next
                    </a>
                @else
                    <span class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800/60 text-slate-400 dark:text-slate-600 text-[13px] font-600 rounded-lg cursor-not-allowed select-none border border-slate-200/40 dark:border-slate-800/40">
                        Next
                    </span>
                @endif

            </div>
        @endif
    @endif
</main>

@include('layouts.footer')