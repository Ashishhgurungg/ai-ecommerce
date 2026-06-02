<footer class="w-full bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800/80 mt-auto transition-colors">
    <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col items-center gap-6">

        {{-- Centered Accent Separation Marker --}}
        <div class="w-12 h-1 rounded-full bg-blue-600/20 dark:bg-blue-500/30"></div>

        {{-- Social Profiles Media Array Links --}}
        <ul class="flex items-center gap-3.5">
            @php
                $socials = [
                    ['icon' => 'fa-github', 'url' => '#'],
                    ['icon' => 'fa-codepen', 'url' => '#'],
                    ['icon' => 'fa-dribbble', 'url' => '#'],
                    ['icon' => 'fa-instagram', 'url' => '#']
                ];
            @endphp

            @foreach ($socials as $social)
                <li>
                    <a href="{{ $social['url'] }}" 
                       class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 hover:bg-blue-50 dark:bg-slate-800/40 dark:hover:bg-blue-950/30 border border-slate-200/60 dark:border-slate-800 text-slate-500 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition-all">
                        <i class="fa-brands {{ $social['icon'] }} text-[15px]"></i>
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Utility Sub-Navigation Footer Grid --}}
        <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-[13px] font-500 text-slate-500 dark:text-slate-400">
            <a href="{{ url('/') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Home</a>
            <a href="{{ url('/about') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">About</a>
            <a href="{{ url('/services') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Services</a>
            <a href="{{ url('/event') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Events</a>
            <a href="{{ url('/contact') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Contact</a>
        </nav>

        {{-- Copyright Compliance System Output --}}
        <p class="text-[11.5px] font-500 text-slate-400 dark:text-slate-500 tracking-wide">
            &copy; {{ date('Y') }} AI Studio. All rights reserved.
        </p>
    </div>
</footer>
</body>
</html>