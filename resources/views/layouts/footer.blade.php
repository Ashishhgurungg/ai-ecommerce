<footer class="mt-auto border-t border-slate-200 dark:border-slate-800/80 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl px-6 py-10 transition-colors duration-200">
    <div class="max-w-[1320px] mx-auto flex flex-col items-center gap-[18px]">

        {{-- Accent bar --}}
        <span class="w-9 h-1 rounded-full bg-blue-600 dark:bg-blue-500 opacity-45 block"></span>

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="group flex items-center gap-2.5 no-underline">
            <img src="{{ asset('images/my-logo.svg') }}" alt="AI Studio Logo" class="h-10 w-auto dark:transition-transform group-hover:scale-105" />
        </a>

        {{-- Social icons --}}
        <div class="flex gap-2">
            @foreach([
                ['fa-github',    '#', 'GitHub'],
                ['fa-codepen',   '#', 'CodePen'],
                ['fa-dribbble',  '#', 'Dribbble'],
                ['fa-instagram', '#', 'Instagram'],
            ] as [$icon, $href, $label])
            <a href="{{ $href }}" aria-label="{{ $label }}"
               class="w-12 h-12 rounded-full border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/30 flex items-center justify-center text-slate-400 dark:text-slate-500 text-[14px] no-underline transition-all duration-150 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-950/30 hover:border-blue-200 dark:hover:border-blue-900/50 hover:-translate-y-0.5">
                <i class="fa-brands {{ $icon }}"></i>
            </a>
            @endforeach
        </div>

        {{-- Footer nav --}}
        <nav class="flex gap-5 flex-wrap justify-center" aria-label="Footer Navigation">
            @foreach([
                ['Dashboard', route('dashboard')],
                ['Galleries', url('/all-galleries')],
                ['Articles',  url('/all-articles')],
                ['Services',  url('/all-services')],
                ['Events',    url('/all-events')],
                ['Inquiries', url('/inquiries')],
            ] as [$label, $url])
            <a href="{{ $url }}"
               class="text-[14px] font-500 text-slate-600 dark:text-slate-300 no-underline transition-colors duration-150 hover:text-slate-900 dark:hover:text-slate-100">
                {{ $label }}
            </a>
            @endforeach
        </nav>

        <p class="text-[12px] text-slate-500 dark:text-slate-400 font-400">© {{ date('Y') }} AI Solutions. All rights reserved.</p>
    </div>
</footer>

</body>
</html>