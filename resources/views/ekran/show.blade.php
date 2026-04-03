<!DOCTYPE html>
<html lang="tk" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $horse['name'] }} — Türkmen Atlary</title>
    <link rel="shortcut icon" href="{{ asset('images/mini_logo_rounded.png') }}" type="image/png">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }

        :root { --gold:#c9a84c; --gold-dim:rgba(201,168,76,.18); --gold-border:rgba(201,168,76,.38); }

        [data-theme="dark"] {
            --bg:#060e1c; --bg2:#071833; --surface:#0d1e38; --surface2:#091628;
            --text:#fff; --text2:rgba(255,255,255,.55); --text3:rgba(255,255,255,.3);
            --header-bg:linear-gradient(90deg,#040b16,#071833); --border:rgba(255,255,255,.06);
            --stat-bg:rgba(255,255,255,.05); --stat-border:rgba(255,255,255,.1);
        }
        [data-theme="light"] {
            --bg:#f0f4fb; --bg2:#e8eef8; --surface:#fff; --surface2:#f8faff;
            --text:#0a1e50; --text2:#4a5a80; --text3:#8a9ab8;
            --header-bg:linear-gradient(90deg,#0a2355,#0d3280); --border:rgba(10,37,96,.08);
            --stat-bg:rgba(10,82,158,.04); --stat-border:rgba(10,82,158,.1);
        }

        html,body { height:100%; overflow:hidden; font-family:'Segoe UI',system-ui,sans-serif; background:var(--bg); color:var(--text); transition:background .3s, color .3s; }

        .ek-wrap { display:flex; flex-direction:column; height:100vh; }

        /* Header */
        .ek-header {
            flex-shrink:0; background:var(--header-bg); border-bottom:1px solid rgba(255,255,255,.06);
            padding:12px 28px; display:flex; align-items:center; gap:16px; position:relative; z-index:300;
        }
        .ek-back {
            background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.14);
            color:rgba(255,255,255,.7); font-size:.72rem; font-weight:700;
            padding:6px 16px; border-radius:20px; text-decoration:none;
            display:flex; align-items:center; gap:6px; transition:all .2s;
        }
        .ek-back:hover { background:var(--gold-dim); border-color:var(--gold-border); color:var(--gold); }
        .ek-header-title { font-size:1.1rem; font-weight:800; color:#fff; }
        .ek-header-title span { color:var(--gold); }

        /* Theme toggle in header */
        .theme-toggle {
            display:flex; align-items:center; gap:8px; margin-left:auto; cursor:pointer; user-select:none;
        }
        .theme-track {
            width:42px; height:24px; border-radius:12px; background:rgba(255,255,255,.15);
            border:1px solid rgba(255,255,255,.2); position:relative; transition:background .3s;
        }
        [data-theme="light"] .theme-track { background:rgba(255,255,255,.28); }
        .theme-thumb {
            position:absolute; top:3px; left:3px; width:16px; height:16px; border-radius:50%;
            background:#fff; transition:transform .3s cubic-bezier(.34,1.56,.64,1);
            display:flex; align-items:center; justify-content:center; font-size:9px;
        }
        [data-theme="light"] .theme-thumb { transform:translateX(18px); }
        .theme-label { font-size:.65rem; font-weight:700; color:rgba(255,255,255,.55); letter-spacing:.3px; }

        /* Body */
        .ek-body { flex:1; display:flex; overflow:hidden; }

        /* ═══ LEFT PANEL ═══ */
        .ek-left {
            width:50%; display:flex; flex-direction:column;
            overflow-y:auto; border-right:1px solid var(--border);
            scrollbar-width:thin; scrollbar-color:rgba(201,168,76,.2) transparent;
        }
        .ek-left::-webkit-scrollbar { width:5px; }
        .ek-left::-webkit-scrollbar-thumb { background:rgba(201,168,76,.2); border-radius:3px; }

        .ek-hero-img {
            position:relative; flex-shrink:0; background:var(--surface);
            height:62vh; overflow:hidden;
        }
        .ek-hero-img img {
            width:100%; height:100%; object-fit:cover; display:block;
            cursor:zoom-in; transition:transform .5s ease;
        }
        .ek-hero-img:hover img { transform:scale(1.02); }
        .ek-hero-img-gradient {
            position:absolute; bottom:0; left:0; right:0; height:55%;
            background:linear-gradient(to top, rgba(5,13,26,.94), transparent);
            pointer-events:none;
        }
        [data-theme="light"] .ek-hero-img-gradient {
            background:linear-gradient(to top, rgba(10,30,70,.93), transparent);
        }
        .ek-hero-name {
            position:absolute; bottom:22px; left:26px; z-index:2;
        }
        .ek-hero-name h1 {
            font-size:clamp(1.8rem, 3.2vw, 2.6rem); font-weight:900; color:#fff;
            text-shadow:0 2px 10px rgba(0,0,0,.6); letter-spacing:-.6px; line-height:1; margin-bottom:7px;
        }
        .ek-hero-breed {
            font-size:.72rem; font-weight:800; color:var(--gold);
            text-transform:uppercase; letter-spacing:1.8px;
        }

        /* Info area — no own scroll, flows inline */
        .ek-info-area {
            flex-shrink:0; padding:24px 26px 40px;
            background:var(--bg2);
        }

        .ek-stats-grid {
            display:grid; grid-template-columns:repeat(3,1fr); gap:12px; margin-bottom:22px;
        }
        .ek-stat {
            background:var(--stat-bg); border:1px solid var(--stat-border);
            border-radius:12px; padding:14px 16px; text-align:center;
        }
        .ek-stat-label {
            font-size:.58rem; font-weight:800; color:var(--text3);
            text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;
        }
        .ek-stat-value {
            font-size:1.05rem; font-weight:900; color:var(--text);
        }

        .ek-section-title {
            font-size:.6rem; font-weight:800; color:var(--text3);
            text-transform:uppercase; letter-spacing:2px; margin-bottom:12px;
        }
        .ek-desc {
            font-size:.88rem; color:var(--text2); line-height:1.7; margin-bottom:24px;
            border-left:3px solid var(--gold); padding-left:14px;
        }

        /* Staggered masonry gallery */
        .ek-gallery {
            columns: 3;
            column-gap: 8px;
            padding-bottom: 6px;
        }
        .ek-gallery-thumb {
            break-inside: avoid;
            width: 100%;
            margin-bottom: 8px;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid transparent;
            cursor: pointer;
            transition: border-color .2s, transform .2s;
            display: block;
        }
        /* Vary heights for staggered look */
        .ek-gallery-thumb:nth-child(3n+1) { aspect-ratio: 3/4; }
        .ek-gallery-thumb:nth-child(3n+2) { aspect-ratio: 1/1; }
        .ek-gallery-thumb:nth-child(3n)   { aspect-ratio: 4/5; }
        .ek-gallery-thumb:hover { border-color:var(--gold); transform:scale(1.03); }
        .ek-gallery-thumb img { width:100%; height:100%; object-fit:cover; display:block; }

        /* ═══ RIGHT PANEL ═══ */
        .ek-right {
            width:50%; background:radial-gradient(ellipse at center, #0d1e40, #040b18 72%);
            display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden;
        }
        [data-theme="light"] .ek-right {
            background:radial-gradient(ellipse at center, #d0ddf2, #b8c8e8 70%);
        }

        /* Decorative rings */
        .ek-right::before, .ek-right::after {
            content:''; position:absolute; border-radius:50%;
            border:1px solid rgba(201,168,76,.08); pointer-events:none;
        }
        .ek-right::before { width:620px; height:620px; }
        .ek-right::after  { width:420px; height:420px; }

        .ek-video-label {
            position:absolute; top:26px; left:0; right:0; text-align:center;
            font-size:.62rem; font-weight:800; color:var(--text3);
            text-transform:uppercase; letter-spacing:2.5px;
        }

        .ek-circle-wrap { position:relative; z-index:2; }

        .ek-pulse-ring {
            position:absolute; inset:-22px; border-radius:50%;
            border:2px solid rgba(201,168,76,.35);
            animation:pulseRing 2.4s ease-out infinite;
        }
        .ek-pulse-ring:nth-child(2) { inset:-44px; animation-delay:.8s; border-color:rgba(201,168,76,.15); }
        .ek-pulse-ring:nth-child(3) { inset:-66px; animation-delay:1.6s; border-color:rgba(201,168,76,.07); }
        @keyframes pulseRing { 0% { opacity:1; transform:scale(1); } 100% { opacity:0; transform:scale(1.18); } }

        .ek-circle {
            width:clamp(260px, 38vw, 420px); height:clamp(260px, 38vw, 420px);
            border-radius:50%; overflow:hidden; background:#000;
            border:4px solid rgba(201,168,76,.6); position:relative;
            box-shadow:0 0 70px rgba(201,168,76,.15), 0 0 140px rgba(5,13,26,.8);
            transition:border-color .3s, box-shadow .3s;
            cursor:pointer;
        }
        .ek-circle:hover { border-color:rgba(201,168,76,.9); box-shadow:0 0 90px rgba(201,168,76,.28); }
        .ek-circle video { width:100%; height:100%; object-fit:cover; display:block; }

        /* Full-page circle video overlay */
        .ek-video-page {
            position:fixed; inset:0; z-index:9500;
            background:radial-gradient(ellipse at center, #0b1d3e 0%, #020810 70%);
            display:flex; flex-direction:column; align-items:center; justify-content:center;
            opacity:0; pointer-events:none;
            transition:opacity .4s cubic-bezier(.4,0,.2,1);
        }
        [data-theme="light"] .ek-video-page {
            background:radial-gradient(ellipse at center, #c8d8f0 0%, #8fadd4 70%);
        }
        .ek-video-page.open { opacity:1; pointer-events:all; }

        .ek-video-page-title {
            position:absolute; top:36px; left:0; right:0; text-align:center;
            font-size:.65rem; font-weight:800; letter-spacing:3px;
            text-transform:uppercase; color:rgba(201,168,76,.6);
        }

        /* Big circle rings */
        .ek-vp-wrap { position:relative; display:flex; align-items:center; justify-content:center; }
        .ek-vp-ring {
            position:absolute; border-radius:50%;
            border:1.5px solid rgba(201,168,76,.3);
            animation:pulseRing 2.4s ease-out infinite;
        }
        .ek-vp-ring:nth-child(1) { inset:-30px; }
        .ek-vp-ring:nth-child(2) { inset:-60px; animation-delay:.8s; border-color:rgba(201,168,76,.15); }
        .ek-vp-ring:nth-child(3) { inset:-90px; animation-delay:1.6s; border-color:rgba(201,168,76,.07); }
        .ek-vp-ring:nth-child(4) { inset:-130px; animation-delay:2.4s; border-color:rgba(201,168,76,.04); }

        .ek-vp-circle {
            width:clamp(300px, 68vmin, 680px); height:clamp(300px, 68vmin, 680px);
            border-radius:50%; overflow:hidden; background:#000;
            border:5px solid rgba(201,168,76,.7); position:relative; z-index:2;
            box-shadow:0 0 100px rgba(201,168,76,.2), 0 0 200px rgba(0,0,0,.9);
        }
        .ek-vp-circle video { width:100%; height:100%; object-fit:cover; display:block; }

        .ek-vp-close {
            position:absolute; top:26px; right:30px;
            width:48px; height:48px; border-radius:50%;
            background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.18);
            color:#fff; font-size:1.4rem; cursor:pointer;
            display:flex; align-items:center; justify-content:center;
            transition:background .2s, border-color .2s;
        }
        .ek-vp-close:hover { background:rgba(201,168,76,.2); border-color:rgba(201,168,76,.5); color:var(--gold); }

        /* Lightbox */
        .ek-lightbox {
            position:fixed; inset:0; background:rgba(0,0,0,.93); z-index:8888;
            display:flex; align-items:center; justify-content:center;
            opacity:0; pointer-events:none; transition:opacity .25s; cursor:zoom-out;
        }
        .ek-lightbox.open { opacity:1; pointer-events:all; }
        .ek-lightbox img { max-width:92vw; max-height:90vh; border-radius:12px; box-shadow:0 0 70px rgba(0,0,0,.8); }

        /* Audio bar */
        .ek-audio-bar {
            position:fixed; bottom:26px; right:30px; z-index:999;
            display:flex; align-items:center; gap:10px;
            background:rgba(5,13,26,.88); backdrop-filter:blur(12px);
            border:1px solid rgba(201,168,76,.3); border-radius:40px;
            padding:10px 18px; cursor:pointer; user-select:none; transition:border-color .2s;
        }
        .ek-audio-bar:hover { border-color:rgba(201,168,76,.6); }
        .ek-audio-icon {
            width:32px; height:32px; border-radius:50%; background:rgba(201,168,76,.15);
            display:flex; align-items:center; justify-content:center;
        }
        .ek-audio-waves { display:flex; align-items:center; gap:3px; height:20px; }
        .ek-audio-waves span {
            display:block; width:3px; background:#c9a84c; border-radius:2px;
            animation:wavePulse 1s ease-in-out infinite;
        }
        .ek-audio-waves span:nth-child(1) { height:8px;  animation-delay:0s; }
        .ek-audio-waves span:nth-child(2) { height:16px; animation-delay:.15s; }
        .ek-audio-waves span:nth-child(3) { height:12px; animation-delay:.3s; }
        .ek-audio-waves span:nth-child(4) { height:18px; animation-delay:.1s; }
        .ek-audio-waves span:nth-child(5) { height:10px; animation-delay:.25s; }
        .ek-audio-waves.paused span { animation-play-state:paused; height:4px !important; }
        @keyframes wavePulse { 0%,100% { transform:scaleY(1); } 50% { transform:scaleY(1.8); } }
        .ek-audio-label { font-size:.7rem; font-weight:600; color:rgba(255,255,255,.55); white-space:nowrap; }

        @media (max-width:768px) {
            /* Full page scroll on mobile — no nested scrolls */
            html, body { overflow:auto; height:auto; }
            .ek-wrap { height:auto; min-height:100vh; }
            .ek-body {
                flex-direction:column;
                overflow:visible;
                height:auto;
            }
            /* Left panel: natural height, no own scroll */
            .ek-left {
                width:100%;
                overflow-y:visible;
                height:auto;
                border-right:none;
                border-bottom:1px solid var(--border);
            }
            /* Hero image shorter on mobile */
            .ek-hero-img { height:48vh; max-height:480px; }
            /* Info area: natural height */
            .ek-info-area { padding:18px 16px 30px; }
            /* Gallery 2 columns on mobile */
            .ek-gallery { columns:2; }
            /* Right panel: video circle centered, natural height */
            .ek-right {
                width:100%;
                min-height:0;
                padding:40px 0 50px;
            }
            /* Audio bar smaller on mobile */
            .ek-audio-bar { bottom:14px; right:14px; padding:8px 14px; }
        }
    </style>
</head>
<body>
<div class="ek-wrap">

    <header class="ek-header">
        <a class="ek-back" href="{{ route('ekran.index', $screen) }}">
            <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                <path d="M13 8H3M7 4l-4 4 4 4" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Yza
        </a>
        <span class="ek-header-title">Türkmen <span>Atlary</span></span>

        <div class="theme-toggle" onclick="toggleTheme()">
            <div class="theme-track">
                <div class="theme-thumb"><span id="themeIcon">🌙</span></div>
            </div>
            <span class="theme-label" id="themeLabel">Dark</span>
        </div>
    </header>

    <div class="ek-body">

        <!-- LEFT PANEL -->
        <div class="ek-left">
            <div class="ek-hero-img">
                <img src="{{ asset('images/all_horses/' . $horse['img']) }}"
                     alt="{{ $horse['name'] }}" onclick="openLightbox(this.src)">
                <div class="ek-hero-img-gradient"></div>
                <div class="ek-hero-name">
                    <h1>{{ $horse['name'] }}</h1>
                    <div class="ek-hero-breed">{{ $horse['breed'] }}</div>
                </div>
            </div>

            <div class="ek-info-area">
                <div class="ek-stats-grid">
                    <div class="ek-stat">
                        <div class="ek-stat-label">Ýaşy</div>
                        <div class="ek-stat-value">{{ $horse['age'] }} ýaş</div>
                    </div>
                    <div class="ek-stat">
                        <div class="ek-stat-label">Reňki</div>
                        <div class="ek-stat-value">{{ $horse['color'] }}</div>
                    </div>
                    <div class="ek-stat">
                        <div class="ek-stat-label">Jynsy</div>
                        <div class="ek-stat-value">{{ $horse['gender'] }}</div>
                    </div>
                </div>

                <div class="ek-section-title">Barada</div>
                <p class="ek-desc">{{ $horse['desc'] }}</p>

                <div class="ek-section-title">Galerýa</div>
                <div class="ek-gallery">
                    @php
                        $galleryImgs = ['3.jpg','5.jpg','7.jpg','9.jpg','11.jpg','13.jpg','15.jpg','2.jpg','4.jpg','6.jpg','8.jpg','10.jpg'];
                        $shown = 0;
                        foreach ($galleryImgs as $gi) {
                            if ($gi === $horse['img']) continue;
                            if ($shown >= 9) break;
                            $shown++;
                            echo '<div class="ek-gallery-thumb" onclick="openLightbox(\''. asset('images/all_horses/'.$gi) .'\')">'
                               . '<img src="' . asset('images/all_horses/'.$gi) . '" loading="lazy" alt="at resmi">'
                               . '</div>';
                        }
                    @endphp
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="ek-right">
            <div class="ek-video-label">Wideo — {{ $horse['name'] }}</div>

            <div class="ek-circle-wrap">
                <div class="ek-pulse-ring"></div>
                <div class="ek-pulse-ring"></div>
                <div class="ek-pulse-ring"></div>

                <div class="ek-circle" id="circlePlayer" onclick="openVideoPage()">
                    <video id="circleVideo" muted loop playsinline preload="auto" autoplay>
                        <source src="{{ asset('images/all_horses/1.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Full-page circle video overlay -->
<div class="ek-video-page" id="videoPage">
    <div class="ek-video-page-title">Wideo — {{ $horse['name'] }}</div>
    <div class="ek-vp-wrap">
        <div class="ek-vp-ring"></div>
        <div class="ek-vp-ring"></div>
        <div class="ek-vp-ring"></div>
        <div class="ek-vp-ring"></div>
        <div class="ek-vp-circle">
            <video id="vpVideo" loop playsinline preload="auto">
                <source src="{{ asset('images/all_horses/1.mp4') }}" type="video/mp4">
            </video>
        </div>
    </div>
    <div class="ek-vp-close" onclick="closeVideoPage()">✕</div>
</div>

<!-- Lightbox -->
<div class="ek-lightbox" id="lightbox" onclick="closeLightbox()">
    <img id="lightboxImg" src="" alt="">
</div>

<!-- Background audio -->
<audio id="bgAudio" loop preload="auto">
    <source src="{{ asset('images/all_horses/1.m4a') }}" type="audio/mp4">
</audio>

<!-- Audio toggle bar -->
<div class="ek-audio-bar" id="audioBar" onclick="toggleAudio()">
    <div class="ek-audio-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <path d="M11 5L6 9H2v6h4l5 4V5z" fill="#c9a84c"/>
            <path d="M15.54 8.46a5 5 0 0 1 0 7.07" stroke="#c9a84c" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M19.07 4.93a10 10 0 0 1 0 14.14" stroke="#c9a84c" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
    </div>
    <div class="ek-audio-waves" id="audioWaves">
        <span></span><span></span><span></span><span></span><span></span>
    </div>
    <span class="ek-audio-label" id="audioLabel">Saz</span>
</div>

<script>
    /* Theme */
    const html = document.documentElement;
    const themeIcon = document.getElementById('themeIcon');
    const themeLabel = document.getElementById('themeLabel');
    applyTheme(localStorage.getItem('ek-theme') || 'dark');

    function toggleTheme() { applyTheme(html.dataset.theme === 'dark' ? 'light' : 'dark'); }
    function applyTheme(t) {
        html.dataset.theme = t;
        themeIcon.textContent = t === 'dark' ? '🌙' : '☀️';
        themeLabel.textContent = t === 'dark' ? 'Dark' : 'Light';
        localStorage.setItem('ek-theme', t);
    }

    /* Small circle video — autoplay looping */
    const circleVid = document.getElementById('circleVideo');
    const circlePlayer = document.getElementById('circlePlayer');
    circleVid.play().catch(() => {});

    /* Full-page circle video overlay */
    const videoPage = document.getElementById('videoPage');
    const vpVideo   = document.getElementById('vpVideo');

    function openVideoPage() {
        if (!circleVid) return;
        videoPage.classList.add('open');
        circleVid.pause();
        vpVideo.currentTime = 0;
        vpVideo.play().catch(() => {});
    }
    function closeVideoPage() {
        videoPage.classList.remove('open');
        vpVideo.pause();
        circleVid.play().catch(() => {});
    }

    /* Audio */
    const audio = document.getElementById('bgAudio');
    const waves = document.getElementById('audioWaves');
    const label = document.getElementById('audioLabel');
    let audioPlaying = false;

    // Auto-play audio on page load
    window.addEventListener('load', function() {
        audio.play().then(() => { 
            audioPlaying = true; 
            updateAudioUI(); 
        }).catch(() => {
            // If autoplay is blocked, try on first user interaction
            document.addEventListener('click', function() {
                if (!audioPlaying) { audio.play().then(() => { audioPlaying = true; updateAudioUI(); }); }
            }, { once: true });
        });
    });

    function toggleAudio() {
        if (audioPlaying) { audio.pause(); audioPlaying = false; }
        else { audio.play().then(() => { audioPlaying = true; }); }
        updateAudioUI();
    }
    function updateAudioUI() {
        if (audioPlaying) { waves.classList.remove('paused'); label.textContent = 'Saz'; }
        else { waves.classList.add('paused'); label.textContent = 'Ýapyk'; }
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeVideoPage(); closeLightbox(); }
    });
    videoPage.addEventListener('click', e => { if (e.target === videoPage) closeVideoPage(); });

    /* Lightbox */
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    function openLightbox(src) { lightboxImg.src = src; lightbox.classList.add('open'); }
    function closeLightbox() { lightbox.classList.remove('open'); }

    /* Stop audio on page exit */
    window.addEventListener('beforeunload', () => audio.pause());
</script>
</body>
</html>
