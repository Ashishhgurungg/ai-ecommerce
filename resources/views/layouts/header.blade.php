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
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ════════════════════════════════════════════
           DESIGN TOKENS
        ════════════════════════════════════════════ */
        :root {
            --bg-base:       #090e18;
            --bg-surface:    #0d1525;
            --bg-raised:     #121e30;
            --bg-card:       #162034;
            --bg-hover:      #1a2840;
            --border-dim:    rgba(255,255,255,0.06);
            --border-mid:    rgba(255,255,255,0.10);
            --border-hi:     rgba(255,255,255,0.18);
            --accent:        #f97316;
            --accent-dim:    rgba(249,115,22,0.14);
            --accent-glow:   rgba(249,115,22,0.35);
            --text-1:        #f1f5f9;
            --text-2:        #94a3b8;
            --text-3:        #475569;
            --r-sm: 8px; --r-md: 12px; --r-lg: 16px; --r-xl: 20px;
            --nav-top-h: 62px;
            --nav-bar-h: 48px;
            --font-d: 'Syne',    sans-serif;
            --font-b: 'DM Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-b);
            background: var(--bg-base);
            color: var(--text-1);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            /* Subtle dot-grid depth */
            background-image: radial-gradient(circle, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg-base); }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 99px; }

        /* ════════════════════════════════════════════
           NAV SHELL
        ════════════════════════════════════════════ */
        .nav-shell {
            position: sticky; top: 0; z-index: 100;
            background: rgba(9,14,24,0.82);
            backdrop-filter: blur(18px) saturate(1.5);
            -webkit-backdrop-filter: blur(18px) saturate(1.5);
            border-bottom: 1px solid var(--border-dim);
        }

        /* ── Top row ── */
        .nav-top {
            max-width: 1320px; margin: 0 auto; padding: 0 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            height: var(--nav-top-h);
        }

        /* Logo */
        .logo {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none; flex-shrink: 0;
        }
        .logo-mark {
            width: 36px; height: 36px; border-radius: 9px;
            background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-d); font-size: 12px; font-weight: 800; color: #fff;
            letter-spacing: 0.3px;
            box-shadow: 0 0 0 1px rgba(249,115,22,0.45), 0 4px 14px rgba(249,115,22,0.28);
            transition: transform .15s, box-shadow .15s;
            flex-shrink: 0;
        }
        .logo:hover .logo-mark {
            transform: scale(1.07) rotate(-4deg);
            box-shadow: 0 0 0 1px rgba(249,115,22,0.6), 0 6px 20px rgba(249,115,22,0.4);
        }
        .logo-word {
            font-family: var(--font-d); font-size: 17px; font-weight: 700;
            color: var(--text-1); letter-spacing: -0.2px;
        }
        .logo-word span { color: var(--accent); }

        /* User pill */
        .user-wrap { position: relative; }
        .user-pill {
            display: flex; align-items: center; gap: 9px;
            padding: 5px 12px 5px 5px; border-radius: 99px;
            border: 1px solid var(--border-mid);
            background: rgba(255,255,255,0.04);
            cursor: pointer; user-select: none;
            transition: background .15s, border-color .15s;
        }
        .user-pill:hover, .user-pill.is-open {
            background: rgba(255,255,255,0.08); border-color: var(--border-hi);
        }
        .user-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .user-name {
            font-size: 13.5px; font-weight: 500; color: var(--text-2);
            max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .pill-chevron {
            width: 13px; height: 13px; color: var(--text-3);
            transition: transform .2s; flex-shrink: 0;
        }
        .pill-chevron.up { transform: rotate(180deg); }

        /* User dropdown */
        .user-dropdown {
            position: absolute; right: 0; top: calc(100% + 9px);
            width: 216px;
            background: var(--bg-raised);
            border: 1px solid var(--border-mid);
            border-radius: var(--r-lg);
            box-shadow: 0 20px 52px rgba(0,0,0,0.65);
            overflow: hidden;
            opacity: 0; transform: translateY(-6px) scale(.97);
            pointer-events: none;
            transition: opacity .15s, transform .15s;
        }
        .user-dropdown.is-open {
            opacity: 1; transform: translateY(0) scale(1); pointer-events: all;
        }
        .dd-head {
            padding: 13px 15px;
            border-bottom: 1px solid var(--border-dim);
        }
        .dd-head-name  { font-size: 13.5px; font-weight: 600; color: var(--text-1); }
        .dd-head-email { font-size: 11.5px; color: var(--text-3); margin-top: 2px; }
        .dd-item {
            display: flex; align-items: center; gap: 9px;
            padding: 10px 15px; font-size: 13.5px; color: var(--text-2);
            text-decoration: none; cursor: pointer;
            background: none; border: none; width: 100%; text-align: left;
            transition: color .1s, background .1s;
        }
        .dd-item:hover { color: var(--text-1); background: rgba(255,255,255,0.05); }
        .dd-item.danger:hover { color: #f87171; background: rgba(248,113,113,0.08); }
        .dd-item svg { width: 14px; height: 14px; color: var(--text-3); flex-shrink: 0; }
        .dd-sep { height: 1px; background: var(--border-dim); margin: 3px 0; }

        /* Hamburger */
        .hamburger {
            display: none; align-items: center; justify-content: center;
            width: 38px; height: 38px; border-radius: var(--r-sm);
            border: 1px solid var(--border-mid);
            background: rgba(255,255,255,0.04);
            color: var(--text-2); cursor: pointer;
            transition: background .15s, color .15s;
        }
        .hamburger:hover, .hamburger.is-open {
            background: rgba(255,255,255,0.09); color: var(--text-1);
        }
        .hamburger svg { width: 19px; height: 19px; }

        /* ── Bottom bar ── */
        .nav-bar {
            border-top: 1px solid var(--border-dim);
        }
        .nav-bar-inner {
            max-width: 1320px; margin: 0 auto; padding: 0 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            height: var(--nav-bar-h);
        }
        .nav-links { display: flex; align-items: center; gap: 1px; }

        .nav-link {
            position: relative;
            padding: 6px 14px; border-radius: var(--r-sm);
            font-size: 14px; font-weight: 500; color: var(--text-3);
            text-decoration: none; white-space: nowrap;
            border: 1px solid transparent;
            transition: color .15s, background .15s, border-color .15s;
        }
        .nav-link:hover { color: var(--text-1); background: rgba(255,255,255,0.05); }
        .nav-link.active {
            color: #fff; background: var(--accent-dim);
            border-color: rgba(249,115,22,0.28);
        }
        .nav-link.active::after {
            content: '';
            position: absolute; bottom: -1px; left: 50%; transform: translateX(-50%);
            width: 20px; height: 2px; background: var(--accent);
            border-radius: 2px 2px 0 0;
        }

        /* New button */
        .new-wrap { position: relative; }
        .new-btn {
            display: flex; align-items: center; gap: 6px;
            padding: 7px 18px; border-radius: var(--r-sm);
            background: var(--accent); color: #fff;
            font-size: 13.5px; font-weight: 600;
            border: none; cursor: pointer; text-decoration: none;
            box-shadow: 0 2px 14px var(--accent-glow);
            transition: background .15s, transform .15s, box-shadow .15s;
        }
        .new-btn:hover { background: #ea580c; transform: translateY(-1px); box-shadow: 0 4px 20px rgba(249,115,22,0.48); }
        .new-btn svg { width: 13px; height: 13px; flex-shrink: 0; }
        .new-chevron { width: 11px; height: 11px; transition: transform .2s; flex-shrink: 0; }
        .new-chevron.up { transform: rotate(180deg); }

        /* Create dropdown */
        .create-dropdown {
            position: absolute; right: 0; top: calc(100% + 9px);
            width: 190px;
            background: var(--bg-raised);
            border: 1px solid var(--border-mid);
            border-radius: var(--r-lg);
            box-shadow: 0 20px 52px rgba(0,0,0,0.65);
            overflow: hidden;
            opacity: 0; transform: translateY(-6px) scale(.97);
            pointer-events: none;
            transition: opacity .15s, transform .15s;
            z-index: 200;
        }
        .create-dropdown.is-open { opacity: 1; transform: translateY(0) scale(1); pointer-events: all; }
        .cd-label {
            padding: 9px 13px 5px;
            font-size: 9.5px; font-weight: 700;
            letter-spacing: 0.13em; text-transform: uppercase;
            color: var(--text-3);
        }
        .cd-item {
            display: flex; align-items: center; gap: 9px;
            padding: 9px 13px; font-size: 13.5px; font-weight: 500;
            color: var(--text-2); text-decoration: none;
            transition: color .1s, background .1s;
        }
        .cd-item:hover { color: var(--text-1); background: rgba(255,255,255,0.05); }
        .cd-item.active { color: #fb923c; background: var(--accent-dim); }
        .cd-icon {
            width: 26px; height: 26px; border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.06); color: var(--text-3); flex-shrink: 0;
        }
        .cd-icon svg { width: 12px; height: 12px; }
        .cd-item.active .cd-icon { background: rgba(249,115,22,0.18); color: var(--accent); }

        /* ════════════════════════════════════════════
           MOBILE DRAWER
        ════════════════════════════════════════════ */
        .mobile-menu {
            display: none;
            border-top: 1px solid var(--border-dim);
            background: var(--bg-surface);
            padding: 14px 16px;
        }
        .mobile-menu.is-open { display: block; animation: fadeSlide .16s ease; }
        @keyframes fadeSlide { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }

        .mob-label {
            font-size: 9.5px; font-weight: 700; letter-spacing: .14em;
            text-transform: uppercase; color: var(--text-3);
            padding: 0 8px; margin-bottom: 5px;
        }
        .mob-link {
            display: flex; align-items: center; gap: 11px;
            padding: 11px 10px; border-radius: var(--r-md);
            font-size: 14.5px; font-weight: 500; color: var(--text-2);
            text-decoration: none; margin-bottom: 2px;
            border: 1px solid transparent;
            transition: color .1s, background .1s, border-color .1s;
        }
        .mob-link:hover { color: var(--text-1); background: rgba(255,255,255,0.05); }
        .mob-link.active { color: #fb923c; background: var(--accent-dim); border-color: rgba(249,115,22,0.22); }
        .mob-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: rgba(255,255,255,0.14); flex-shrink: 0;
        }
        .mob-link.active .mob-dot { background: var(--accent); }
        .mob-sep { height: 1px; background: var(--border-dim); margin: 12px 0; }

        .mob-user { display: flex; align-items: center; gap: 11px; padding: 8px 10px 12px; }
        .mob-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .mob-uname  { font-size: 14.5px; font-weight: 600; color: var(--text-1); }
        .mob-uemail { font-size: 11.5px; color: var(--text-3); margin-top: 2px; }

        /* ════════════════════════════════════════════
           RESPONSIVE
        ════════════════════════════════════════════ */
        @media (max-width: 1023px) {
            .nav-bar          { display: none !important; }
            .user-pill-desktop { display: none !important; }
            .hamburger        { display: flex !important; }
        }
        @media (max-width: 540px) {
            .logo-word { display: none; }
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">

@php
    $navViews = [
        ['label' => 'Dashboard', 'url' => route('dashboard'),    'match' => 'route:dashboard'],
        ['label' => 'Galleries', 'url' => url('/all-galleries'), 'match' => 'path:all-galleries'],
        ['label' => 'Articles',  'url' => url('/all-articles'),  'match' => 'path:all-articles'],
        ['label' => 'Services',  'url' => url('/all-services'),  'match' => 'path:all-services'],
        ['label' => 'Events',    'url' => url('/all-events'),    'match' => 'path:all-events'],
        ['label' => 'Inquiries', 'url' => url('/inquiries'),     'match' => 'path:inquiries'],
        ['label' => 'Reviews',   'url' => url('/reviews'),       'match' => 'path:reviews'],
    ];
    $navCreates = [
        ['label' => 'Gallery', 'url' => url('/gallery-form'), 'path' => 'gallery-form'],
        ['label' => 'Article', 'url' => url('/article-form'), 'path' => 'article-form'],
        ['label' => 'Service', 'url' => url('/add-services'), 'path' => 'add-services'],
        ['label' => 'Event',   'url' => url('/add-events'),   'path' => 'add-events'],
    ];
@endphp

<header class="nav-shell" id="site-header">

    {{-- ── Top row ── --}}
    <div class="nav-top">

        <a href="{{ route('home') }}" class="logo">
            <span class="logo-mark">AI</span>
            <span class="logo-word">AI <span>Studio</span></span>
        </a>

        <div style="display:flex;align-items:center;gap:10px;">

            {{-- User pill — desktop --}}
            <div class="user-wrap user-pill-desktop">
                <button class="user-pill" id="user-btn">
                    <span class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <svg class="pill-chevron" id="user-chev" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="user-dropdown" id="user-dd">
                    <div class="dd-head">
                        <div class="dd-head-name">{{ Auth::user()->name }}</div>
                        <div class="dd-head-email">{{ Auth::user()->email }}</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dd-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profile settings
                    </a>
                    <div class="dd-sep"></div>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0">
                        @csrf
                        <button type="submit" class="dd-item danger">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Log out
                        </button>
                    </form>
                </div>
            </div>

            {{-- Hamburger — mobile --}}
            <button class="hamburger" id="mob-btn" aria-label="Toggle menu">
                <svg id="mob-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ── Bottom bar — desktop nav ── --}}
    <div class="nav-bar">
        <div class="nav-bar-inner">

            <nav class="nav-links">
                @foreach($navViews as $item)
                    @php
                        [$type, $val] = explode(':', $item['match']);
                        $active = $type === 'route' ? request()->routeIs($val) : request()->is($val);
                    @endphp
                    <a href="{{ $item['url'] }}" class="nav-link {{ $active ? 'active' : '' }}">{{ $item['label'] }}</a>
                @endforeach
            </nav>

            <div class="new-wrap">
                <button class="new-btn" id="new-btn">
                    <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    New
                    <svg class="new-chevron" id="new-chev" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </button>
                <div class="create-dropdown" id="create-dd">
                    <div class="cd-label">Create new</div>
                    @foreach($navCreates as $item)
                        @php $active = request()->is($item['path']); @endphp
                        <a href="{{ $item['url'] }}" class="cd-item {{ $active ? 'active' : '' }}">
                            <span class="cd-icon">
                                @switch($item['label'])
                                    @case('Gallery')<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>@break
                                    @case('Article')<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>@break
                                    @case('Service')<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>@break
                                    @case('Event')<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>@break
                                @endswitch
                            </span>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- ── Mobile drawer ── --}}
    <div class="mobile-menu" id="mob-menu">

        <p class="mob-label">Navigate</p>
        @foreach($navViews as $item)
            @php
                [$type, $val] = explode(':', $item['match']);
                $active = $type === 'route' ? request()->routeIs($val) : request()->is($val);
            @endphp
            <a href="{{ $item['url'] }}" class="mob-link {{ $active ? 'active' : '' }}">
                <span class="mob-dot"></span>{{ $item['label'] }}
            </a>
        @endforeach

        <div class="mob-sep"></div>

        <p class="mob-label">Create new</p>
        @foreach($navCreates as $item)
            @php $active = request()->is($item['path']); @endphp
            <a href="{{ $item['url'] }}" class="mob-link {{ $active ? 'active' : '' }}">
                <span class="mob-dot"></span>{{ $item['label'] }}
            </a>
        @endforeach

        <div class="mob-sep"></div>

        <div class="mob-user">
            <span class="mob-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
            <div>
                <div class="mob-uname">{{ Auth::user()->name }}</div>
                <div class="mob-uemail">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <a href="{{ route('profile.edit') }}" class="mob-link">
            <svg style="width:15px;height:15px;flex-shrink:0;color:var(--text-3)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profile settings
        </a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="mob-link" style="width:100%;border:none;background:none;cursor:pointer;text-align:left;font-family:inherit;">
                <svg style="width:15px;height:15px;flex-shrink:0;color:var(--text-3)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Log out
            </button>
        </form>

    </div>

</header>

<script>
(function(){
    const $ = id => document.getElementById(id);
    const userBtn  = $('user-btn'),  userDd   = $('user-dd'),   userChev = $('user-chev');
    const newBtn   = $('new-btn'),   createDd = $('create-dd'), newChev  = $('new-chev');
    const mobBtn   = $('mob-btn'),   mobMenu  = $('mob-menu'),  mobIcon  = $('mob-icon');

    const OPEN = 'M6 18L18 6M6 6l12 12';
    const SHUT = 'M4 6h16M4 12h16M4 18h16';

    function toggle(dd, btn, chev, closeOthers){
        closeOthers();
        const on = dd.classList.toggle('is-open');
        if(btn)  btn.classList.toggle('is-open', on);
        if(chev) chev.classList.toggle('up', on);
    }
    function closeUser(){ userDd.classList.remove('is-open'); userBtn.classList.remove('is-open'); userChev.classList.remove('up'); }
    function closeNew(){  createDd.classList.remove('is-open'); newChev.classList.remove('up'); }
    function closeMob(){  mobMenu.classList.remove('is-open'); mobBtn.classList.remove('is-open'); mobIcon.querySelector('path').setAttribute('d', SHUT); }

    userBtn.addEventListener('click', e => { e.stopPropagation(); toggle(userDd, userBtn, userChev, closeNew); });
    newBtn .addEventListener('click', e => { e.stopPropagation(); toggle(createDd, null, newChev, closeUser); });
    mobBtn .addEventListener('click', e => {
        e.stopPropagation();
        const on = mobMenu.classList.toggle('is-open');
        mobBtn.classList.toggle('is-open', on);
        mobIcon.querySelector('path').setAttribute('d', on ? OPEN : SHUT);
    });
    document.addEventListener('click', () => { closeUser(); closeNew(); });
})();
</script>