<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? config('app.name', 'AI Studio') }}</title>

    {{-- Fonts: Syne (display) + DM Sans (body) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght=600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --font-d: 'Syne', sans-serif;
            --font-b: 'DM Sans', sans-serif;
        }
        body {
            font-family: var(--font-b);
            background-image: radial-gradient(circle, rgba(15, 23, 42, 0.04) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        /* Subtly shift dot matrix in dark mode for better contrast */
        .dark body {
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }
        .font-display { font-family: var(--font-d); }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 min-h-screen antialiased flex flex-col transition-colors duration-200">

@php
    $navViews = [
        ['label' => 'Dashboard', 'url' => route('dashboard'),    'route' => 'dashboard'],
        ['label' => 'Galleries', 'url' => url('/all-galleries'), 'path' => 'all-galleries*'],
        ['label' => 'Articles',  'url' => url('/all-articles'),  'path' => 'all-articles*'],
        ['label' => 'Services',  'url' => url('/all-services'),  'path' => 'all-services*'],
        ['label' => 'Events',    'url' => url('/all-events'),    'path' => 'all-events*'],
        ['label' => 'Inquiries', 'url' => url('/inquiries'),     'path' => 'inquiries*'],
        ['label' => 'Reviews',   'url' => url('/reviews'),       'path' => 'reviews*'],
    ];
    $navCreates = [
        ['label' => 'Gallery', 'url' => url('/gallery-form'), 'path' => 'gallery-form*'],
        ['label' => 'Article', 'url' => url('/article-form'), 'path' => 'article-form*'],
        ['label' => 'Service', 'url' => url('/add-services'), 'path' => 'add-services*'],
        ['label' => 'Event',   'url' => url('/add-events'),   'path' => 'add-events*'],
    ];
@endphp

<header class="sticky top-0 z-50 w-full bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200/80 dark:border-slate-800/80 transition-colors duration-200" id="site-header">
    
    {{-- ── Top Row ── --}}
    <div class="max-w-[1320px] mx-auto h-[64px] px-6 flex items-center justify-between">
        
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="group flex items-center gap-3 no-underline shrink-0">
            <span class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center font-display text-[12px] font-800 text-white tracking-wider shadow-[0_0_0_1px_rgba(37,99,235,0.2),0_4px_12px_rgba(37,99,235,0.24)] transition-all duration-200 group-hover:scale-105 group-hover:-rotate-3 group-hover:shadow-[0_0_0_1px_rgba(37,99,235,0.3),0_6px_16px_rgba(37,99,235,0.35)] shrink-0">
                AI
            </span>
            <span class="font-display text-lg font-700 text-slate-900 dark:text-slate-100 tracking-tight transition-colors group-hover:text-black dark:group-hover:text-white">
                AI <span class="text-blue-600 dark:text-blue-500">Studio</span>
            </span>
        </a>

        <div class="flex items-center gap-3">
            @auth
                {{-- User Pill — Desktop --}}
                <div class="relative hidden lg:block">
                    <button class="flex items-center gap-2.5 p-1 pr-3.5 rounded-full border border-slate-200 dark:border-slate-700 bg-slate-50/60 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-700 hover:border-slate-300 dark:hover:border-slate-600 transition-all cursor-pointer select-none" id="user-btn" aria-haspopup="true" aria-expanded="false" aria-label="User navigation menu">
                        <span class="w-7 h-7 rounded-full bg-blue-600 flex items-center justify-center text-[11px] font-700 text-white shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                        <span class="text-[14px] font-500 text-slate-700 dark:text-slate-300 max-w-[120px] truncate">
                            {{ Auth::user()->name }}
                        </span>
                        <svg class="w-3.5 h-3.5 text-slate-400 dark:text-slate-500 transition-transform duration-200 [html.is-open_&]:rotate-180" id="user-chev" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    {{-- Dropdown Menu --}}
                    <div class="absolute right-0 top-[calc(100%+8px)] w-56 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-xl shadow-slate-200/60 dark:shadow-none overflow-hidden opacity-0 -translate-y-1.5 pointer-events-none transition-all duration-150 [&.is-open]:opacity-100 [&.is-open]:translate-y-0 [&.is-open]:pointer-events-auto" id="user-dd">
                        <div class="p-3.5 border-b border-slate-100 dark:border-slate-700/60 bg-slate-50/50 dark:bg-slate-800/50">
                            <div class="text-[14px] font-600 text-slate-900 dark:text-slate-100">{{ Auth::user()->name }}</div>
                            <div class="text-[12px] text-slate-400 dark:text-slate-400 mt-0.5 truncate">{{ Auth::user()->email }}</div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-[14px] text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Profile settings
                        </a>
                        <div class="h-px bg-slate-100 dark:bg-slate-700 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-[14px] text-slate-600 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50/60 dark:hover:bg-red-950/30 transition-colors text-left border-none bg-none cursor-pointer">
                                <svg class="w-4 h-4 text-slate-400 dark:text-slate-500 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Log out
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            {{-- Hamburger — Mobile Toggle --}}
            <button class="lg:hidden flex items-center justify-center w-9 h-9 rounded-md border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors cursor-pointer" id="mob-btn" aria-label="Toggle structural menus" aria-expanded="false">
                <svg id="mob-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ── Bottom Bar — Desktop Nav Row ── --}}
    <div class="hidden lg:block border-t border-slate-200/80 dark:border-slate-800/80 bg-white/40 dark:bg-slate-900/40">
        <div class="max-w-[1320px] mx-auto h-12 px-6 flex items-center justify-between">
            
            {{-- Navigation Links (text-[15px]) --}}
            <nav class="flex items-center gap-1" aria-label="Desktop Primary Navigation">
                @foreach($navViews as $item)
                    @php
                        $active = isset($item['route']) ? request()->routeIs($item['route']) : request()->is($item['path']);
                    @endphp
                    <a href="{{ $item['url'] }}" class="relative px-3.5 py-1.5 rounded-md text-[15px] font-500 transition-all tracking-tight {{ $active ? 'text-blue-600 dark:text-blue-400 bg-blue-50/80 dark:bg-blue-950/40 font-600' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 hover:dark:text-white hover:bg-slate-100/70 dark:hover:bg-slate-800/60' }}">
                        {{ $item['label'] }}
                        @if($active)
                            <span class="absolute bottom-[-13px] left-1/2 -translate-x-1/2 w-5 h-0.5 bg-blue-600 dark:bg-blue-400 rounded-t-sm"></span>
                        @endif
                    </a>
                @endforeach
            </nav>

            {{-- Create Action Dropdown Wrapper --}}
            <div class="relative">
                <button class="flex items-center gap-1.5 px-4 py-1.5 rounded-md bg-blue-600 hover:bg-blue-700 text-white text-[14px] font-600 shadow-sm transition-all hover:-translate-y-0.5 cursor-pointer" id="new-btn" aria-haspopup="true" aria-expanded="false">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    New
                    <svg class="w-3.5 h-3.5 text-blue-200/90 transition-transform duration-200" id="new-chev" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </button>
                
                <div class="absolute right-0 top-[calc(100%+8px)] w-48 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-xl shadow-slate-200/60 dark:shadow-none overflow-hidden opacity-0 -translate-y-1.5 pointer-events-none transition-all duration-150 z-50 [&.is-open]:opacity-100 [&.is-open]:translate-y-0 [&.is-open]:pointer-events-auto" id="create-dd">
                    <div class="px-3.5 pt-3 pb-1 text-[10px] font-700 uppercase tracking-widest text-slate-400 dark:text-slate-500">Create new</div>
                    @foreach($navCreates as $item)
                        @php $active = request()->is($item['path']); @endphp
                        <a href="{{ $item['url'] }}" class="flex items-center gap-2.5 px-3.5 py-2 text-[14px] font-500 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-700/60 {{ $active ? 'text-blue-600 dark:text-blue-400 bg-blue-50/40 dark:bg-blue-950/20 hover:text-blue-600 dark:hover:text-blue-400' : '' }}">
                            <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 text-slate-400 dark:text-slate-500 flex items-center justify-center shrink-0 {{ $active ? 'bg-blue-100/70 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400' : '' }}">
                                @switch($item['label'])
                                    @case('Gallery')<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>@break
                                    @case('Article')<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>@break
                                    @case('Service')<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>@break
                                    @case('Event')<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>@break
                                @endswitch
                            </span>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ── Mobile Navigation Drawer ── --}}
    <nav class="hidden border-t border-slate-200 dark:border-slate-800 bg-slate-50/95 dark:bg-slate-900/95 px-4 py-4 transition-all duration-200 [&.is-open]:block animate-in fade-in slide-in-from-top-2 duration-150" id="mob-menu" aria-label="Mobile Navigation Drawer">
        <p class="px-2 text-[10px] font-700 uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-1.5">Navigate</p>
        @foreach($navViews as $item)
            @php
                $active = isset($item['route']) ? request()->routeIs($item['route']) : request()->is($item['path']);
            @endphp
            <a href="{{ $item['url'] }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[15px] font-500 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200/50 dark:hover:bg-slate-800/60 transition-colors mb-0.5 {{ $active ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/40 border border-blue-100/60 dark:border-blue-900/40 font-600' : '' }}">
                <span class="w-1.5 h-1.5 rounded-full bg-slate-300 dark:bg-slate-700 shrink-0 {{ $active ? 'bg-blue-600 dark:bg-blue-400' : '' }}"></span>
                {{ $item['label'] }}
            </a>
        @endforeach

        <div class="h-px bg-slate-200 dark:bg-slate-800 my-4"></div>

        <p class="px-2 text-[10px] font-700 uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-1.5">Create new</p>
        @foreach($navCreates as $item)
            @php $active = request()->is($item['path']); @endphp
            <a href="{{ $item['url'] }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[15px] font-500 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200/50 dark:hover:bg-slate-800/60 transition-colors mb-0.5 {{ $active ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/40 border border-blue-100/60 dark:border-blue-900/40 font-600' : '' }}">
                <span class="w-1.5 h-1.5 rounded-full bg-slate-300 dark:bg-slate-700 shrink-0 {{ $active ? 'bg-blue-600 dark:bg-blue-400' : '' }}"></span>
                {{ $item['label'] }}
            </a>
        @endforeach

        @auth
            <div class="h-px bg-slate-200 dark:bg-slate-800 my-4"></div>
            <div class="flex items-center gap-3 px-2 py-2 mb-2">
                <span class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-[14px] font-700 text-white shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>
                <div>
                    <div class="text-[14.5px] font-600 text-slate-900 dark:text-slate-100">{{ Auth::user()->name }}</div>
                    <div class="text-[11.5px] text-slate-400 dark:text-slate-400 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>
            
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[14.5px] font-500 text-slate-600 dark:text-slate-300 hover:bg-slate-200/50 dark:hover:bg-slate-800/60 transition-all">
                <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profile settings
            </a>
            
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-[14.5px] font-500 text-slate-600 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20 text-left border-none bg-none cursor-pointer">
                    <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Log out
                </button>
            </form>
        @endauth
    </nav>
</header>

<script>
(function(){
    const $ = id => document.getElementById(id);
    const userBtn   = $('user-btn'),   userDd   = $('user-dd'),   userChev = $('user-chev');
    const newBtn    = $('new-btn'),    createDd = $('create-dd'), newChev  = $('new-chev');
    const mobBtn    = $('mob-btn'),    mobMenu  = $('mob-menu'),  mobIcon  = $('mob-icon');

    const OPEN = 'M6 18L18 6M6 6l12 12';
    const SHUT = 'M4 6h16M4 12h16M4 18h16';

    function toggle(dd, btn, chev, closeOthers){
        closeOthers();
        const on = dd.classList.toggle('is-open');
        if(btn) {
            btn.classList.toggle('is-open', on);
            btn.setAttribute('aria-expanded', on ? 'true' : 'false');
        }
        if(chev) chev.classList.toggle('up', on);
    }
    
    function closeUser(){ 
        if(userDd) {
            userDd.classList.remove('is-open'); 
            userBtn.classList.remove('is-open'); 
            userBtn.setAttribute('aria-expanded', 'false');
            userChev.classList.remove('up'); 
        }
    }
    function closeNew(){ 
        if(createDd) {
            createDd.classList.remove('is-open'); 
            newBtn.setAttribute('aria-expanded', 'false');
            newChev.classList.remove('up'); 
        }
    }
    function closeMob(){ 
        if(mobMenu) {
            mobMenu.classList.remove('is-open'); 
            mobBtn.classList.remove('is-open'); 
            mobBtn.setAttribute('aria-expanded', 'false');
            mobIcon.querySelector('path').setAttribute('d', SHUT); 
        }
    }

    if(userBtn && userDd) {
        userBtn.addEventListener('click', e => { e.stopPropagation(); toggle(userDd, userBtn, userChev, closeNew); });
    }
    if(newBtn && createDd) {
        newBtn.addEventListener('click', e => { e.stopPropagation(); toggle(createDd, newBtn, newChev, closeUser); });
    }
    if(mobBtn && mobMenu) {
        mobBtn.addEventListener('click', e => {
            e.stopPropagation();
            const on = mobMenu.classList.toggle('is-open');
            mobBtn.classList.toggle('is-open', on);
            mobBtn.setAttribute('aria-expanded', on ? 'true' : 'false');
            mobIcon.querySelector('path').setAttribute('d', on ? OPEN : SHUT);
        });
    }
    
    document.addEventListener('click', () => { closeUser(); closeNew(); });
})();
</script>