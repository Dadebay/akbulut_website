<!DOCTYPE html>
<html lang="tk" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Türkmen Atlary — Ekran {{ $screen }}</title>
    <link rel="shortcut icon" href="{{ asset('images/mini_logo_rounded.png') }}" type="image/png">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root { --gold:#c9a84c; --gold-dim:rgba(201,168,76,.18); --gold-border:rgba(201,168,76,.38); }

        [data-theme="dark"] {
            --bg:#060e1c; --surface:#0d1e38; --text:#fff; --text2:rgba(255,255,255,.55);
            --text3:rgba(255,255,255,.25); --header-bg:linear-gradient(90deg,#040b16,#071833,#0a2355);
            --shadow:rgba(0,0,0,.55); --shadow-h:rgba(0,0,0,.78);
            --card-grad:linear-gradient(to top,rgba(4,10,22,.97) 0%,rgba(4,10,22,.55) 42%,rgba(4,10,22,.08) 70%,transparent 100%);
            --card-grad-h:linear-gradient(to top,rgba(4,10,22,.99) 0%,rgba(4,10,22,.72) 48%,rgba(4,10,22,.18) 74%,transparent 100%);
        }
        [data-theme="light"] {
            --bg:#eef3fc; --surface:#fff; --text:#0a1e50; --text2:#4a5a80;
            --text3:#9aaac8; --header-bg:linear-gradient(90deg,#0a2355,#0d3280,#1242bb);
            --shadow:rgba(10,37,96,.13); --shadow-h:rgba(10,37,96,.26);
            --card-grad:linear-gradient(to top,rgba(4,10,30,.95) 0%,rgba(4,10,30,.52) 42%,rgba(4,10,30,.06) 68%,transparent 100%);
            --card-grad-h:linear-gradient(to top,rgba(4,10,30,.98) 0%,rgba(4,10,30,.7) 48%,rgba(4,10,30,.14) 72%,transparent 100%);
        }

        body { background:var(--bg); font-family:'Segoe UI',system-ui,sans-serif; min-height:100vh; color:var(--text); transition:background .3s,color .3s; }

        /* Header */
        .ek-header {
            background:var(--header-bg); border-bottom:1px solid rgba(255,255,255,.06);
            padding:0 28px; height:62px; display:flex; align-items:center; justify-content:space-between;
            position:sticky; top:0; z-index:200;
        }
        .theme-toggle { display:flex; align-items:center; gap:11px; cursor:pointer; user-select:none; }
        .theme-track {
            width:46px; height:26px; border-radius:13px; background:rgba(255,255,255,.15);
            border:1px solid rgba(255,255,255,.22); position:relative; transition:background .3s; flex-shrink:0;
        }
        [data-theme="light"] .theme-track { background:rgba(255,255,255,.3); }
        .theme-thumb {
            position:absolute; top:3px; left:3px; width:18px; height:18px; border-radius:50%; background:#fff;
            transition:transform .32s cubic-bezier(.34,1.56,.64,1);
            display:flex; align-items:center; justify-content:center; font-size:10px;
        }
        [data-theme="light"] .theme-thumb { transform:translateX(20px); }
        .ek-site-title { font-size:1.28rem; font-weight:800; color:#fff; letter-spacing:-.3px; }
        .ek-site-title span { color:var(--gold); }

        .ek-header-right { display:flex; align-items:center; gap:10px; }
        .ek-screen-badge {
            background:var(--gold-dim); border:1px solid var(--gold-border); color:var(--gold);
            font-size:.68rem; font-weight:700; padding:4px 14px; border-radius:30px;
            text-transform:uppercase; letter-spacing:1px;
        }
        .ek-screen-switch { display:flex; gap:6px; }
        .ek-screen-switch a {
            background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.14);
            color:rgba(255,255,255,.55); font-size:.7rem; font-weight:700;
            padding:5px 14px; border-radius:20px; text-decoration:none;
            transition:all .2s; letter-spacing:.5px;
        }
        .ek-screen-switch a.active, .ek-screen-switch a:hover {
            background:var(--gold-dim); border-color:var(--gold-border); color:var(--gold);
        }

        /* Main */
        .ek-main { padding:30px 28px 64px; max-width:1600px; margin:0 auto; }
        .ek-section-label { 
            font-size:.62rem; font-weight:700; letter-spacing:2.5px; 
            text-transform:uppercase; color:var(--text3); margin-bottom:22px; 
        }

        /* Grid */
        .ek-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:18px; }

        /* Card — portrait, fully image-driven */
        .ek-card {
            position:relative; border-radius:16px; overflow:hidden; display:block;
            text-decoration:none; color:inherit; aspect-ratio:3/4; background:var(--surface);
            cursor:pointer; transition:transform .35s cubic-bezier(.22,.68,0,1.2), box-shadow .3s;
            box-shadow:0 4px 22px var(--shadow);
        }
        .ek-card:hover {
            transform:translateY(-8px) scale(1.018);
            box-shadow:0 24px 60px var(--shadow-h), 0 0 0 1.5px var(--gold);
            text-decoration:none; color:inherit;
        }
        .ek-card-img {
            position:absolute; inset:0; width:100%; height:100%; object-fit:cover; display:block;
            transition:transform .55s ease, filter .55s ease; filter:brightness(.82) saturate(1.1);
        }
        .ek-card:hover .ek-card-img { transform:scale(1.08); filter:brightness(.94) saturate(1.2); }
        .ek-card-grad {
            position:absolute; inset:0; background:var(--card-grad);
            pointer-events:none; transition:background .3s;
        }
        .ek-card:hover .ek-card-grad { background:var(--card-grad-h); }

        .ek-card-num {
            position:absolute; top:12px; left:12px; z-index:4; background:var(--gold); color:#050d1a;
            font-size:.6rem; font-weight:900; width:26px; height:26px; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
        }
        .ek-card-gender {
            position:absolute; top:12px; right:12px; z-index:4; background:rgba(0,0,0,.52);
            backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,.2); color:#fff;
            font-size:.6rem; font-weight:800; padding:3px 10px; border-radius:20px;
            text-transform:uppercase; letter-spacing:.5px;
        }
        .ek-card-info { position:absolute; bottom:0; left:0; right:0; z-index:3; padding:0 16px 18px; }
        .ek-card-name { 
            font-size:1.08rem; font-weight:900; color:#fff; letter-spacing:-.2px; 
            margin-bottom:3px; text-shadow:0 1px 6px rgba(0,0,0,.5); 
        }
        .ek-card-breed { 
            font-size:.63rem; font-weight:700; color:var(--gold); 
            text-transform:uppercase; letter-spacing:1px; margin-bottom:9px; 
        }
        .ek-card-tags { display:flex; gap:5px; flex-wrap:wrap; }
        .ek-tag {
            background:rgba(255,255,255,.13); backdrop-filter:blur(6px);
            border:1px solid rgba(255,255,255,.2); color:rgba(255,255,255,.9);
            font-size:.6rem; font-weight:700; padding:3px 9px; border-radius:20px;
        }
        .ek-card-cta {
            position:absolute; bottom:18px; right:16px; z-index:5; opacity:0;
            transform:translateY(10px); transition:opacity .25s, transform .25s;
        }
        .ek-card:hover .ek-card-cta { opacity:1; transform:translateY(0); }
        .ek-cta-btn {
            background:var(--gold); color:#050d1a; font-size:.72rem; font-weight:800;
            padding:8px 18px; border-radius:30px; display:flex; align-items:center; gap:5px;
            box-shadow:0 4px 18px rgba(201,168,76,.45);
        }

        @media (max-width:1280px) { .ek-grid { grid-template-columns:repeat(3,1fr); } }
        @media (max-width:860px)  { .ek-grid { grid-template-columns:repeat(2,1fr); } .ek-main { padding:20px 16px 48px; } }
        @media (max-width:480px)  { .ek-grid { grid-template-columns:1fr; } .ek-header { padding:0 16px; } }
    </style>
</head>
<body>

<header class="ek-header">
    <div class="theme-toggle" onclick="toggleTheme()">
        <div class="theme-track">
            <div class="theme-thumb"><span id="themeIcon">🌙</span></div>
        </div>
        <span class="ek-site-title">Türkmen <span>Atlary</span></span>
    </div>
    <div class="ek-header-right">
        <div class="ek-screen-badge">Ekran {{ $screen }}</div>
        <div class="ek-screen-switch">
            <a href="{{ route('ekran.index', 1) }}" class="{{ $screen == 1 ? 'active' : '' }}">Ekran 1</a>
            <a href="{{ route('ekran.index', 2) }}" class="{{ $screen == 2 ? 'active' : '' }}">Ekran 2</a>
        </div>
    </div>
</header>

<main class="ek-main">
    <div class="ek-section-label">{{ $screen == 1 ? 'Birinji' : 'Ikinji' }} ekran — 12 at</div>
    <div class="ek-grid">
        @foreach($horses as $i => $horse)
        <a href="{{ route('ekran.show', ['screen' => $screen, 'id' => $horse['id']]) }}" class="ek-card">
            <img src="{{ asset('images/all_horses/' . $horse['img']) }}" alt="{{ $horse['name'] }}" class="ek-card-img">
            <div class="ek-card-grad"></div>
            <span class="ek-card-num">{{ $i + 1 }}</span>
            <span class="ek-card-gender">{{ $horse['gender'] }}</span>
            <div class="ek-card-info">
                <div class="ek-card-name">{{ $horse['name'] }}</div>
                <div class="ek-card-breed">{{ $horse['breed'] }}</div>
                <div class="ek-card-tags">
                    <span class="ek-tag">{{ $horse['age'] }} ýaş</span>
                    <span class="ek-tag">{{ $horse['color'] }}</span>
                </div>
            </div>
            <div class="ek-card-cta">
                <div class="ek-cta-btn">
                    Giňişleýin
                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="#050d1a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</main>

<script>
    const html = document.documentElement;
    const icon = document.getElementById('themeIcon');
    applyTheme(localStorage.getItem('ek-theme') || 'dark');
    function toggleTheme() { applyTheme(html.dataset.theme === 'dark' ? 'light' : 'dark'); }
    function applyTheme(t) { html.dataset.theme = t; icon.textContent = t === 'dark' ? '🌙' : '☀️'; localStorage.setItem('ek-theme', t); }
</script>
</body>
</html>
