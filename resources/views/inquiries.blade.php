@php $pageTitle = 'Inquiries — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[1320px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row --}}
    <div class="flex items-end justify-between flex-wrap gap-4 mb-8">
        <div>
            <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Inquiries</h1>
            <p class="text-[13.5px] text-slate-500 dark:text-slate-400 mt-1.5">Review system inquiries, submission details, and client messages.</p>
        </div>
    </div>

    {{-- Notification System Alerts --}}
    @if(session('success'))
        <div class="flex items-center gap-2.5 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200/60 dark:border-emerald-900/40 text-emerald-800 dark:text-emerald-400 px-4 py-3.5 rounded-xl text-[14px] font-500 mb-6 shadow-sm">
            <svg class="w-4 h-4 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Grid Layout Engine --}}
    @if($inquiries->isEmpty())
        <div class="flex flex-col items-center justify-center border border-dashed border-slate-300 dark:border-slate-700 rounded-2xl py-12 px-4 bg-slate-50/50 dark:bg-slate-900/20 text-center">
            <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
            </div>
            <h3 class="text-[15px] font-600 text-slate-900 dark:text-slate-100">Inbox is empty</h3>
            <p class="text-[13px] text-slate-400 dark:text-slate-500 mt-1 max-w-xs">No user contact inquiries or external submissions have arrived yet.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($inquiries as $inquiry)
                <div x-data="{ expandedMsg: false, expandedJob: false }" 
                     class="group bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-5 flex flex-col justify-between transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-700/80 hover:bg-slate-50/50 dark:hover:bg-slate-800/70 hover:-translate-y-0.5 shadow-sm">
                    
                    <div>
                        {{-- Row Info Header --}}
                        <div class="flex items-start gap-2.5 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L22 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-[16px] font-600 text-slate-900 dark:text-slate-100 tracking-tight leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                {{ $inquiry->subject }}
                            </h3>
                        </div>

                        {{-- Structured Information Grid --}}
                        <div class="space-y-3.5 text-[13px] border-t border-slate-100 dark:border-slate-800/40 pt-3.5">
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-slate-400 dark:text-slate-500 font-500">Sender:</span>
                                <span class="col-span-2 text-slate-700 dark:text-slate-300 font-600 truncate">{{ $inquiry->name }}</span>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-slate-400 dark:text-slate-500 font-500">Email:</span>
                                <a href="mailto:{{ $inquiry->email }}" class="col-span-2 text-blue-600 dark:text-blue-400 hover:underline truncate">{{ $inquiry->email }}</a>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-slate-400 dark:text-slate-500 font-500">Phone:</span>
                                <span class="col-span-2 text-slate-600 dark:text-slate-400 font-500 truncate">{{ $inquiry->phone ?? '—' }}</span>
                            </div>

                            @if($inquiry->company || $inquiry->job_title)
                                <div class="grid grid-cols-3 gap-1">
                                    <span class="text-slate-400 dark:text-slate-500 font-500">Company:</span>
                                    <span class="col-span-2 text-slate-600 dark:text-slate-400 font-500 truncate">
                                        {{ $inquiry->job_title }}{{ $inquiry->company ? ' @ ' . $inquiry->company : '' }}
                                    </span>
                                </div>
                            @endif

                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-slate-400 dark:text-slate-500 font-500">Country:</span>
                                <span class="col-span-2 text-slate-600 dark:text-slate-400 font-500 truncate">{{ $inquiry->country ?? '—' }}</span>
                            </div>
                            
                            {{-- Expandable Message Area --}}
                            <div class="border-t border-slate-100 dark:border-slate-800/40 pt-3 mt-1">
                                <span class="text-slate-400 dark:text-slate-500 font-500 block mb-1">Message Detail:</span>
                                <div class="text-slate-600 dark:text-slate-400 leading-relaxed bg-slate-50 dark:bg-slate-900/30 rounded-xl p-2.5 border border-slate-100 dark:border-slate-800/20 text-[13px]">
                                    <p :class="expandedMsg ? '' : 'line-clamp-2'">
                                        {{ $inquiry->message }}
                                    </p>
                                    @if(strlen($inquiry->message) > 90)
                                        <button @click="expandedMsg = !expandedMsg" 
                                                class="mt-1.5 text-[12px] font-600 text-blue-600 dark:text-blue-400 hover:underline cursor-pointer focus:outline-none flex items-center gap-0.5">
                                            <span x-text="expandedMsg ? 'View Less' : 'View Full Text'"></span>
                                            <svg class="w-3 h-3 transition-transform duration-200" :class="expandedMsg ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>

                            {{-- Expandable Job Context Requirements Area --}}
                            @if($inquiry->job_details)
                                <div class="pt-1">
                                    <span class="text-slate-400 dark:text-slate-500 font-500 block mb-1">Job Context Requirements:</span>
                                    <div class="text-slate-600 dark:text-slate-400 leading-relaxed bg-slate-50 dark:bg-slate-900/30 rounded-xl p-2.5 border border-slate-100 dark:border-slate-800/20 text-[13px]">
                                        <p :class="expandedJob ? '' : 'line-clamp-2'">
                                            {{ $inquiry->job_details }}
                                        </p>
                                        @if(strlen($inquiry->job_details) > 90)
                                            <button @click="expandedJob = !expandedJob" 
                                                    class="mt-1.5 text-[12px] font-600 text-blue-600 dark:text-blue-400 hover:underline cursor-pointer focus:outline-none flex items-center gap-0.5">
                                                <span x-text="expandedJob ? 'View Less' : 'View Full Text'"></span>
                                                <svg class="w-3 h-3 transition-transform duration-200" :class="expandedJob ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Card Action Footer Area --}}
                    <div class="mt-5 pt-3.5 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-end text-[13px] font-600">
                        <a href="{{ url('/inquiries-delete/'.$inquiry->id) }}" 
                           class="inline-flex items-center gap-1 text-slate-400 hover:text-red-600 dark:text-slate-500 dark:hover:text-red-400 no-underline hover:underline transition-colors"
                           onclick="return confirm('Are you sure you want to permanently clear this user submission?');">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Remove inquiry
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

    {{-- Clean Framework Pagination Render --}}
    @if(method_exists($inquiries, 'links'))
        <div class="mt-10 border-t border-slate-200 dark:border-slate-800/60 pt-6">
            {{ $inquiries->links('pagination::tailwind') }}
        </div>
    @endif

</main>

@include('layouts.footer')