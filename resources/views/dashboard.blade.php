@php $pageTitle = 'Dashboard — AI Studio'; @endphp
@include('layouts.header')

<main style="max-width:1320px; margin:0 auto; padding:2.5rem 1.5rem;">

    <style>
        /* ── Dashboard page styles ── */
        .dash-header {
            display: flex; align-items: flex-end; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
            margin-bottom: 2.5rem;
        }
        .dash-title {
            font-family: var(--font-d); font-size: 26px; font-weight: 700;
            color: var(--text-1); letter-spacing: -0.4px; line-height: 1.1;
        }
        .dash-sub {
            font-size: 13.5px; color: var(--text-3); margin-top: 5px;
        }
        .dash-date {
            display: flex; align-items: center; gap: 6px;
            font-size: 12.5px; color: var(--text-3);
        }
        .dash-date svg { width: 13px; height: 13px; }

        /* Stats grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        /* Stat card */
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border-dim);
            border-radius: var(--r-xl);
            padding: 22px;
            position: relative; overflow: hidden;
            transition: border-color .2s, background .2s, transform .2s;
            cursor: default;
        }
        .stat-card:hover {
            border-color: var(--border-mid);
            background: var(--bg-hover);
            transform: translateY(-2px);
        }
        /* Tinted corner glow */
        .stat-card::after {
            content: '';
            position: absolute; top: 0; right: 0;
            width: 72px; height: 72px;
            border-radius: 0 var(--r-xl) 0 100%;
            background: var(--c-glow, transparent);
            transition: opacity .3s; opacity: 0;
            pointer-events: none;
        }
        .stat-card:hover::after { opacity: 1; }

        .card-row   { display: flex; align-items: flex-start; justify-content: space-between; }
        .card-label {
            font-size: 10.5px; font-weight: 700;
            letter-spacing: 0.12em; text-transform: uppercase;
            color: var(--text-3);
        }
        .card-icon {
            width: 38px; height: 38px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .card-icon svg { width: 17px; height: 17px; }
        .card-number {
            font-family: var(--font-d);
            font-size: 44px; font-weight: 700;
            color: var(--text-1); line-height: 1;
            letter-spacing: -1.5px;
            margin-top: 12px;
        }
        .card-foot {
            margin-top: 18px; padding-top: 14px;
            border-top: 1px solid var(--border-dim);
        }
        .card-link {
            font-size: 12px; font-weight: 500; color: var(--text-3);
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 4px;
            transition: color .15s;
        }
        .card-link:hover { color: var(--accent); }
        .card-link svg { width: 11px; height: 11px; }

        /* Icon colour variants */
        .ic-orange  { background:rgba(249,115,22,0.12); color:#fb923c; --c-glow:rgba(249,115,22,0.08); }
        .ic-blue    { background:rgba(59,130,246,0.12);  color:#60a5fa; --c-glow:rgba(59,130,246,0.08); }
        .ic-purple  { background:rgba(168,85,247,0.12); color:#c084fc; --c-glow:rgba(168,85,247,0.08); }
        .ic-emerald { background:rgba(16,185,129,0.12); color:#34d399; --c-glow:rgba(16,185,129,0.08); }
        .ic-sky     { background:rgba(14,165,233,0.12);  color:#38bdf8; --c-glow:rgba(14,165,233,0.08); }
        .ic-rose    { background:rgba(244,63,94,0.12);   color:#fb7185; --c-glow:rgba(244,63,94,0.08); }

        @media (max-width:1023px) { .stats-grid { grid-template-columns:repeat(2,1fr); } }
        @media (max-width:560px)  { .stats-grid { grid-template-columns:1fr; gap:12px; } .card-number { font-size:36px; } }
    </style>

    {{-- Page heading --}}
    <div class="dash-header">
        <div>
            <h1 class="dash-title">Dashboard</h1>
            <p class="dash-sub">Welcome back, {{ Auth::user()->name }} — here's everything at a glance.</p>
        </div>
        <span class="dash-date">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            {{ now()->format('D, d M Y') }}
        </span>
    </div>

    {{-- Stats --}}
    <div class="stats-grid">

        {{-- Galleries --}}
        <div class="stat-card" style="--c-glow:rgba(249,115,22,0.08)">
            <div class="card-row">
                <span class="card-label">Galleries</span>
                <span class="card-icon ic-orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
            </div>
            <p class="card-number">{{ $galleriesCount ?? 0 }}</p>
            <div class="card-foot">
                <a href="{{ url('/all-galleries') }}" class="card-link">
                    View all galleries
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Articles --}}
        <div class="stat-card" style="--c-glow:rgba(59,130,246,0.08)">
            <div class="card-row">
                <span class="card-label">Articles</span>
                <span class="card-icon ic-blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </span>
            </div>
            <p class="card-number">{{ $articlesCount ?? 0 }}</p>
            <div class="card-foot">
                <a href="{{ url('/all-articles') }}" class="card-link">
                    View all articles
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Services --}}
        <div class="stat-card" style="--c-glow:rgba(168,85,247,0.08)">
            <div class="card-row">
                <span class="card-label">Services</span>
                <span class="card-icon ic-purple">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </span>
            </div>
            <p class="card-number">{{ $servicesCount ?? 0 }}</p>
            <div class="card-foot">
                <a href="{{ url('/all-services') }}" class="card-link">
                    View all services
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Events --}}
        <div class="stat-card" style="--c-glow:rgba(16,185,129,0.08)">
            <div class="card-row">
                <span class="card-label">Events</span>
                <span class="card-icon ic-emerald">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
            </div>
            <p class="card-number">{{ $eventsCount ?? 0 }}</p>
            <div class="card-foot">
                <a href="{{ url('/all-events') }}" class="card-link">
                    View all events
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Attendees --}}
        <div class="stat-card" style="--c-glow:rgba(14,165,233,0.08)">
            <div class="card-row">
                <span class="card-label">Event Attendees</span>
                <span class="card-icon ic-sky">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </span>
            </div>
            <p class="card-number">{{ $attendeesCount ?? 0 }}</p>
            <div class="card-foot">
                <span style="font-size:12px; color:var(--text-3);">Total registered</span>
            </div>
        </div>

        {{-- Inquiries --}}
        <div class="stat-card" style="--c-glow:rgba(244,63,94,0.08)">
            <div class="card-row">
                <span class="card-label">Contact Messages</span>
                <span class="card-icon ic-rose">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
            </div>
            <p class="card-number">{{ $inquiriesCount ?? 0 }}</p>
            <div class="card-foot">
                <a href="{{ url('/inquiries') }}" class="card-link">
                    View all inquiries
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

    </div>

</main>

@include('layouts.footer')