<footer style="border-top:1px solid var(--border-dim); background:rgba(9,14,24,0.7); padding:2.5rem 1.5rem; margin-top:auto;">
    <div style="max-width:1320px; margin:0 auto; display:flex; flex-direction:column; align-items:center; gap:18px;">

        {{-- Accent bar --}}
        <span style="width:36px; height:3px; border-radius:99px; background:var(--accent); opacity:0.45; display:block;"></span>

        {{-- Logo --}}
        <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:9px; text-decoration:none;">
            <span style="width:28px; height:28px; border-radius:7px; background:var(--accent); display:flex; align-items:center; justify-content:center; font-family:var(--font-d); font-size:10px; font-weight:800; color:#fff;">AI</span>
            <span style="font-family:var(--font-d); font-size:14px; font-weight:700; color:var(--text-2);">AI <span style="color:var(--accent);">Studio</span></span>
        </a>

        {{-- Social icons --}}
        <div style="display:flex; gap:8px;">
            @foreach([
                ['fa-github',    '#', 'GitHub'],
                ['fa-codepen',   '#', 'CodePen'],
                ['fa-dribbble',  '#', 'Dribbble'],
                ['fa-instagram', '#', 'Instagram'],
            ] as [$icon, $href, $label])
            <a href="{{ $href }}" aria-label="{{ $label }}"
               style="width:34px; height:34px; border-radius:50%; border:1px solid var(--border-mid); background:rgba(255,255,255,0.03); display:flex; align-items:center; justify-content:center; color:var(--text-3); font-size:14px; text-decoration:none; transition:color .15s, background .15s, border-color .15s, transform .15s;"
               onmouseover="this.style.color='var(--accent)'; this.style.background='var(--accent-dim)'; this.style.borderColor='rgba(249,115,22,0.3)'; this.style.transform='translateY(-2px)';"
               onmouseout="this.style.color='var(--text-3)'; this.style.background='rgba(255,255,255,0.03)'; this.style.borderColor='var(--border-mid)'; this.style.transform='translateY(0)';">
                <i class="fa-brands {{ $icon }}"></i>
            </a>
            @endforeach
        </div>

        {{-- Footer nav --}}
        <nav style="display:flex; gap:20px; flex-wrap:wrap; justify-content:center;">
            @foreach([
                ['Dashboard', route('dashboard')],
                ['Galleries', url('/all-galleries')],
                ['Articles',  url('/all-articles')],
                ['Services',  url('/all-services')],
                ['Events',    url('/all-events')],
                ['Inquiries', url('/inquiries')],
            ] as [$label, $url])
            <a href="{{ $url }}"
               style="font-size:12.5px; color:var(--text-3); text-decoration:none; transition:color .15s;"
               onmouseover="this.style.color='var(--text-1)'"
               onmouseout="this.style.color='var(--text-3)'">{{ $label }}</a>
            @endforeach
        </nav>

        <p style="font-size:11.5px; color:var(--text-3);">© {{ date('Y') }} AI Studio. All rights reserved.</p>
    </div>
</footer>

</body>
</html>