<header x-data="{ mobileMenuOpen: false }" class="w-full bg-white dark:bg-slate-900/80 border-b border-slate-200 dark:border-slate-800/80 sticky top-0 z-50 backdrop-blur-md transition-colors">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        
        {{-- Brand Logo --}}
        <div class="flex items-center gap-8">
            <a href="{{ url('/') }}" class="shrink-0 group">
                <img src="{{ asset('images/my-logo.svg') }}" alt="AI Studio Logo" class="h-14 w-auto dark:transition-transform group-hover:scale-105" />
            </a>
            
            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-5 text-[18px] font-600 text-slate-600 dark:text-slate-300">
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

        {{-- Authentication & Mobile Toggle --}}
        <div class="flex items-center gap-3">
            @if (Route::has('login'))
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-[18px] font-600 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-sm transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-[18px] font-600 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800/60 rounded-xl transition-colors">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-[18px] font-600 bg-slate-900 hover:bg-slate-800 dark:bg-slate-100 dark:hover:bg-white text-white dark:text-slate-900 rounded-xl shadow-sm transition-all">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            {{-- Mobile Menu Trigger Button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-600 dark:text-slate-300 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Navigation Dropdown --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden border-t border-slate-200 dark:border-slate-800 p-6 flex flex-col gap-4 bg-white dark:bg-slate-900">
        @php
            $links = ['/' => 'Home', 'services' => 'Services', 'event' => 'Events', 'articles' => 'Articles', 'galleries' => 'Gallery', 'contact' => 'Contact Us', 'faq' => 'FAQ', 'about' => 'About', 'review' => 'Reviews'];
        @endphp
        @foreach($links as $path => $label)
            @php $isActive = ($path === '/') ? request()->is('/') : request()->is($path . '*'); @endphp
            <a href="{{ url($path) }}" class="text-[18px] font-600 {{ $isActive ? 'text-blue-600' : 'text-slate-600 dark:text-slate-400' }}">
                {{ $label }}
            </a>
        @endforeach
        
        @auth
            <a href="{{ url('/dashboard') }}" class="mt-2 px-4 py-2 text-center text-[18px] font-600 bg-blue-600 text-white rounded-xl">Dashboard</a>
        @else
            <div class="mt-2 flex flex-col gap-2">
                <a href="{{ route('login') }}" class="px-4 py-2 text-center text-[18px] font-600 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-800 rounded-xl">Log in</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-center text-[18px] font-600 bg-slate-900 text-white rounded-xl">Register</a>
            </div>
        @endauth
    </div>
</header>