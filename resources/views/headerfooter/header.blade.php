<header class="w-full bg-white dark:bg-slate-900/80 border-b border-slate-200 dark:border-slate-800/80 sticky top-0 z-50 backdrop-blur-md transition-colors">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        
        {{-- Brand Navigation Matrix Stack --}}
        <div class="flex items-center gap-8">
            <a href="{{ url('/') }}" class="shrink-0 group">
                <img src="{{ asset('images/my-logo.svg') }}" alt="AI Studio Logo" class="h-6 w-auto dark:invert transition-transform group-hover:scale-105" />
            </a>
            
            <nav class="hidden lg:flex items-center gap-5 text-[14px] font-600 text-slate-600 dark:text-slate-400">
                @php
                    $links = [
                        '/' => 'Home',
                        'services' => 'Services',
                        'event' => 'Events',
                        'articles' => 'Articles',
                        'galleries' => 'Gallery',
                        'contact' => 'Contact Us',
                        'faq' => 'FAQ',
                        'about' => 'About',
                        'review' => 'Reviews'
                    ];
                @endphp

                @foreach($links as $path => $label)
                    @php 
                        $isActive = ($path === '/') ? request()->is('/') : request()->is($path . '*'); 
                    @endphp
                    <a href="{{ url($path) }}" 
                       class="py-1.5 transition-colors border-b-2 {{ $isActive ? 'text-blue-600 dark:text-blue-400 border-blue-600 dark:border-blue-400' : 'border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
        </div>

        {{-- Authentication Management Sub-layer --}}
        @if (Route::has('login'))
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" 
                       class="px-4 py-2 text-[13px] font-600 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-sm hover:shadow transition-all">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-4 py-2 text-[13px] font-600 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800/60 rounded-xl transition-colors">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="px-4 py-2 text-[13px] font-600 bg-slate-900 hover:bg-slate-800 dark:bg-slate-100 dark:hover:bg-white text-white dark:text-slate-900 rounded-xl shadow-sm transition-all">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</header>