@php $pageTitle = 'Contact Desk — AI Studio'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

<main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300 flex flex-col items-center">

    {{-- Section Architecture Header Block --}}
    <header class="text-center max-w-xl mx-auto mb-10">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Communication Portal
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            Contact Our Engineering Desk
        </h1>
        <p class="mt-2 text-[14px] text-slate-500 dark:text-slate-400 leading-relaxed">
            Submit your parameters below. Our operations team will process your configuration requests and system specifications.
        </p>
    </header>

    <div class="w-full max-w-xl mx-auto">
        
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
                    <span>Please correct the following architectural variables:</span>
                </div>
                <ul class="list-disc pl-5 space-y-1 text-[13px] opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Main Registry Interactive Form --}}
        <form action="{{ url('/submit-contact') }}" method="POST" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-6 sm:p-8 rounded-2xl shadow-sm space-y-5">
            @csrf
            
            {{-- Form Row Cluster: Identity and Route --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="name" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" required>
                </div>
                <div>
                    <label for="email" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Email Router</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" required>
                </div>
            </div>

            {{-- Form Row Cluster: Connection and Target Subject --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="phone" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Phone Endpoint</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                           class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" required>
                </div>
                <div>
                    <label for="subject" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Subject Parameter</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                           class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" required>
                </div>
            </div>

            {{-- Core Message Text Node --}}
            <div>
                <label for="message" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Message Body</label>
                <textarea id="message" name="message" rows="4" 
                          class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors resize-none" required>{{ old('message') }}</textarea>
            </div>

            {{-- Separator Construct Line --}}
            <div class="relative py-2">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-slate-100 dark:border-slate-800/60"></div>
                </div>
                <div class="relative flex justify-start text-[10px] font-700 uppercase tracking-widest text-slate-400 dark:text-slate-500">
                    <span class="bg-white dark:bg-slate-900 pr-3">Corporate Metrics</span>
                </div>
            </div>

            {{-- Form Row Cluster: Corporate Architecture Metrics --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="company" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Organization / Enterprise</label>
                    <input type="text" id="company" name="company" value="{{ old('company') }}"
                           class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" required>
                </div>
                <div>
                    <label for="country" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Geographic Region (Country)</label>
                    <input type="text" id="country" name="country" value="{{ old('country') }}"
                           class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" required>
                </div>
            </div>

            {{-- Corporate Role Matrix Mapping --}}
            <div>
                <label for="job_title" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Professional Job Title</label>
                <input type="text" id="job_title" name="job_title" value="{{ old('job_title') }}"
                       class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" required>
            </div>

            <div>
                <label for="job_details" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Operational Project Specifications</label>
                <textarea id="job_details" name="job_details" rows="4" 
                          class="w-full px-3.5 py-2.5 text-[14px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors resize-none" required>{{ old('job_details') }}</textarea>
            </div>

            {{-- Submission Component Node --}}
            <div class="pt-2">
                <button type="submit" 
                        class="w-full flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-[14px] font-600 rounded-xl transition-all shadow-sm focus:outline-none">
                    Transmit Session Payload
                </button>
            </div>
        </form>

    </div>
</main>

@include('headerfooter.footer')