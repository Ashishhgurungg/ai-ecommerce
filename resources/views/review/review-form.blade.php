@php $pageTitle = 'Submit Feedback — AI Studio'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

<main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300 flex flex-col items-center">

    {{-- Section Architecture Header Block --}}
    <header class="text-center max-w-xl mx-auto mb-10">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[15px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Share your experience and insights
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            Write a Review
        </h1>
        <p class="mt-2 text-[16px] text-slate-600 dark:text-slate-300 leading-relaxed">
            Share your thoughts, workflow insights, and operational feedback directly with our engineering team.
        </p>
    </header>

    <div class="w-full max-w-lg mx-auto">
        
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
                    <span>Please correct the following submission variables:</span>
                </div>
                <ul class="list-disc pl-5 space-y-1 text-[13px] opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Main Review Submission Form --}}
        <form action="{{ url('/submit-review') }}" method="POST" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-6 sm:p-8 rounded-2xl shadow-sm space-y-5">
            @csrf
            
            {{-- User Identity Input Node --}}
            <div>
                <label for="name" class="block text-[16px] font-700 uppercase tracking-wider text-slate-600 dark:text-slate-300 mb-1.5">Your Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="w-full px-3.5 py-2.5 text-[16px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors" placeholder="Alex Rivera" required>
            </div>

            {{-- Text Review Node Area --}}
            <div>
                <label for="review" class="block text-[16px] font-700 uppercase tracking-wider text-slate-600 dark:text-slate-300 mb-1.5">Feedback</label>
                <textarea id="review" name="review" rows="6" 
                          class="w-full px-3.5 py-2.5 text-[16px] bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 transition-colors resize-none" placeholder="Elaborate on interface deployment, feature preferences, or general operation summaries..." required>{{ old('review') }}</textarea>
            </div>

            {{-- Submission Interactive Button --}}
            <div class="pt-2">
                <button type="submit" 
                        class="w-full flex items-center justify-center px-5 py-5 bg-blue-600 hover:bg-blue-700 text-white text-[16px] font-600 rounded-xl transition-all shadow-sm focus:outline-none">
                    Submit Review
                </button>
            </div>
        </form>

    </div>
</main>

@include('components.chatbot')
@include('headerfooter.footer')