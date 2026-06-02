@php $pageTitle = 'Register for ' . $event->name . ' — AI Studio'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

<main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300 flex flex-col items-center justify-center">

    {{-- Section Architecture Header Block --}}
    <header class="text-center max-w-xl mx-auto mb-10">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Event Access Pipeline
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            Register for Event
        </h1>
    </header>

    <div class="w-full max-w-md mx-auto">
        
        {{-- System Action Status Flash Toast --}}
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm text-[13.5px] font-500">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- System Validation Error Log Overlay --}}
        @if ($errors->any())
            <div class="mb-6 bg-rose-500/10 border border-rose-500/30 text-rose-600 dark:text-rose-400 p-4 rounded-xl shadow-sm text-[13.5px]">
                <div class="flex items-center gap-2 font-600 mb-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Please correct registration parameters:</span>
                </div>
                <ul class="list-disc pl-5 space-y-1 text-[13px] opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Primary Registration Context Node Frame --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded-2xl shadow-sm overflow-hidden">
            
            {{-- Selected Target Target Context Block --}}
            <div class="bg-slate-50 dark:bg-slate-800/40 border-b border-slate-100 dark:border-slate-800/60 p-5 flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <span class="block text-[10px] font-700 uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-0.5">Selected Core Module</span>
                    <h2 class="text-[15px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-tight">
                        {{ $event->name }}
                    </h2>
                </div>
            </div>

            {{-- Main Dynamic Stream Registration Submission Form --}}
            <form method="POST" action="{{ url('/events/' . $event->id . '/register') }}" class="p-6 space-y-4">
                @csrf
                
                {{-- User Identity Input Node --}}
                <div>
                    <label for="name" class="block text-[11px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" placeholder="Jordan Vance">
                </div>

                {{-- User Contact Electronic Routing Node --}}
                <div>
                    <label for="email" class="block text-[11px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" placeholder="jordan@domain.com">
                </div>

                {{-- User Contact Mobile Routing Node --}}
                <div>
                    <label for="phone" class="block text-[11px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Phone Connection</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                           class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" placeholder="+1 (555) 019-2834">
                </div>

                {{-- Interaction Submission Vector --}}
                <div class="pt-2">
                    <button type="submit" class="w-full flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-[14px] font-600 rounded-xl transition-all shadow-sm focus:outline-none">
                        Commit Slot Reservation
                    </button>
                </div>
            </form>
        </div>

        {{-- Direct Access Directory Reverse Navigation Hook --}}
        <div class="mt-6 text-center">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1.5 text-[12.5px] font-600 text-slate-400 hover:text-slate-700 dark:text-slate-500 dark:hover:text-slate-300 transition-colors">
                &larr; Cancel and Return to Index
            </a>
        </div>

    </div>
</main>

@include('headerfooter.footer')