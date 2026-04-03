@extends('layouts.horse')

@section('css')
<style>
    * { box-sizing: border-box; }
    body { background: #f7faff; font-family: 'Segoe UI', system-ui, sans-serif; margin: 0; }
    html { scrollbar-width: none; }
    body::-webkit-scrollbar { display: none; }

    /* ── TikTok-style fullscreen video/image hero ── */
    .tk-screen {
        position: relative;
        width: 100%;
        height: 100vh;
        min-height: 500px;
        background: #000;
        overflow: hidden;
    }

    /* The video itself — covers full viewport */
    .tk-video {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }

    /* Fallback image background (no video) */
    .tk-img-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
        opacity: 0.82;
    }
    .tk-placeholder-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #0a1a3a 0%, #0a529e 100%);
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 100px;
    }

    /* Dark gradient overlay — bottom portion */
    .tk-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to bottom,
            rgba(0,0,0,0.28) 0%,
            transparent 35%,
            transparent 50%,
            rgba(0,0,0,0.72) 80%,
            rgba(0,0,0,0.92) 100%
        );
        z-index: 2;
        pointer-events: none;
    }

    /* Back button (top-left) */
    .tk-back {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 10;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.9);
        background: rgba(0,0,0,0.32);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.18);
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }
    .tk-back:hover { background: rgba(0,0,0,0.55); color: #fff; text-decoration: none; }

    /* Mute toggle (top-right) — only when video exists */
    .tk-mute-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 10;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: none;
        background: rgba(0,0,0,0.35);
        backdrop-filter: blur(8px);
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }
    .tk-mute-btn:hover { background: rgba(0,0,0,0.6); }

    /* Horse info — bottom of the viewport */
    .tk-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 5;
        padding: 0 20px 52px;
    }
    .tk-horse-name {
        font-size: clamp(2rem, 6vw, 3.2rem);
        font-weight: 900;
        color: #fff;
        margin: 0 0 6px;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 16px rgba(0,0,0,0.5);
        line-height: 1.1;
    }
    .tk-horse-breed {
        font-size: 1rem;
        color: rgba(255,255,255,0.8);
        margin: 0 0 14px;
        font-weight: 500;
    }
    .tk-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .tk-badge {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
        color: #fff;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 20px;
    }

    /* Scroll hint arrow */
    .tk-scroll-hint {
        position: absolute;
        bottom: 16px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 5;
        color: rgba(255,255,255,0.6);
        animation: tkBounce 1.8s infinite;
        font-size: 22px;
        line-height: 1;
    }
    @keyframes tkBounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(8px); }
    }

    /* ── Info section below the video ── */
    .hd-body {
        background: #f7faff;
        padding: 48px 0 72px;
    }
    .hd-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 28px;
        align-items: start;
    }
    .hd-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid rgba(10,82,158,0.09);
        box-shadow: 0 2px 12px rgba(10,82,158,0.07);
        padding: 24px 24px 20px;
        margin-bottom: 20px;
    }
    .hd-card-title {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #0a529e;
        margin-bottom: 14px;
    }
    .hd-desc {
        font-size: 0.95rem;
        line-height: 1.8;
        color: #374151;
        margin: 0;
    }
    .hd-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }
    .hd-stat {
        text-align: center;
        background: #f0f5ff;
        border-radius: 12px;
        padding: 14px 8px;
    }
    .hd-stat-value {
        font-size: 1.4rem;
        font-weight: 800;
        color: #0a529e;
        line-height: 1;
        margin-bottom: 4px;
    }
    .hd-stat-label {
        font-size: 0.68rem;
        font-weight: 600;
        color: #5a6a88;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .hd-gallery {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .hd-gallery-item {
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        aspect-ratio: 4/3;
        background: #eaf1fb;
    }
    .hd-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.25s ease;
    }
    .hd-gallery-item:hover img { transform: scale(1.05); }

    /* Lightbox */
    .hd-lightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.95);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    .hd-lightbox.active { display: flex; }
    .hd-lightbox img { max-width: 92vw; max-height: 90vh; border-radius: 10px; }
    .hd-lightbox-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.15);
        border: none;
        border-radius: 50%;
        color: #fff;
        font-size: 22px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 900px) {
        .hd-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
        .hd-stats { grid-template-columns: repeat(2, 1fr); }
        .hd-card { padding: 18px 16px; }
        .tk-info { padding: 0 16px 48px; }
    }
</style>
@endsection

@section('content')

@php $images = $horse->image_urls; @endphp

{{-- ── TikTok-style fullscreen hero ── --}}
<div class="tk-screen">

    {{-- VIDEO (if exists) --}}
    @if($horse->video_url)
        <video class="tk-video" id="tkVideo" autoplay muted loop playsinline>
            <source src="{{ $horse->video_url }}" type="video/mp4">
        </video>
    {{-- FALLBACK: image --}}
    @elseif(count($images) > 0)
        <img src="{{ $images[0] }}"
             class="tk-img-bg"
             alt="{{ $horse->name }}"
             onerror="this.style.display='none';">
    {{-- FALLBACK: placeholder --}}
    @else
        <div class="tk-placeholder-bg">🐴</div>
    @endif

    <div class="tk-overlay"></div>

    {{-- Back button --}}
    <a href="{{ route('horses.all') }}" class="tk-back">
        <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M13 8H3M7 4L3 8l4 4" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Ähli atlar
    </a>

    {{-- Mute toggle (only when video) --}}
    @if($horse->video_url)
    <button class="tk-mute-btn" id="tkMuteBtn" onclick="tkToggleMute()" title="Ses">
        🔇
    </button>
    @endif

    {{-- Horse info at bottom --}}
    <div class="tk-info">
        <h1 class="tk-horse-name">{{ $horse->name }}</h1>
        <p class="tk-horse-breed">{{ $horse->breed ?? 'Ahalteke Bedewi' }}</p>
        <div class="tk-badges">
            @if($horse->age)    <span class="tk-badge">{{ $horse->age }} ýaş</span> @endif
            @if($horse->height) <span class="tk-badge">{{ $horse->height }} sm</span> @endif
            @if($horse->color)  <span class="tk-badge">{{ $horse->color }}</span> @endif
            @if($horse->gender) <span class="tk-badge">{{ $horse->gender }}</span> @endif
        </div>
    </div>

    {{-- Scroll hint --}}
    <div class="tk-scroll-hint">▾</div>
</div>

{{-- ── Info section ── --}}
<section class="hd-body">
    <div class="container">
        <div class="hd-grid">

            {{-- Left column --}}
            <div>
                {{-- Stats --}}
                @if($horse->age || $horse->height || $horse->breed)
                <div class="hd-card">
                    <p class="hd-card-title">Maglumatlar</p>
                    <div class="hd-stats">
                        @if($horse->age)
                        <div class="hd-stat">
                            <div class="hd-stat-value">{{ $horse->age }}</div>
                            <div class="hd-stat-label">Ýaşy (ýyl)</div>
                        </div>
                        @endif
                        @if($horse->height)
                        <div class="hd-stat">
                            <div class="hd-stat-value">{{ $horse->height }}</div>
                            <div class="hd-stat-label">Boýy (sm)</div>
                        </div>
                        @endif
                        @if($horse->breed)
                        <div class="hd-stat">
                            <div class="hd-stat-value" style="font-size:0.85rem;">{{ $horse->breed }}</div>
                            <div class="hd-stat-label">Tohumy</div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Description --}}
                @if($horse->description)
                <div class="hd-card">
                    <p class="hd-card-title">Atyň taryhy</p>
                    <p class="hd-desc">{{ $horse->description }}</p>
                </div>
                @endif

                {{-- Gallery --}}
                @if(count($images) > 0)
                <div class="hd-card">
                    <p class="hd-card-title">Surat galereýasy</p>
                    <div class="hd-gallery">
                        @foreach($images as $imgUrl)
                        <div class="hd-gallery-item" onclick="hdOpenLightbox('{{ $imgUrl }}')">
                            <img src="{{ $imgUrl }}" alt="{{ $horse->name }}">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Right sidebar --}}
            <div>
                {{-- Quick info list --}}
                <div class="hd-card">
                    <p class="hd-card-title">Häsiýetnamasy</p>
                    <ul style="list-style:none;padding:0;margin:0;">
                        @php
                            $infos = [
                                'Ady'    => $horse->name,
                                'Tohumy' => $horse->breed ?? 'Ahalteke Bedewi',
                                'Ýaşy'  => $horse->age    ? $horse->age    . ' ýyl' : null,
                                'Boýy'  => $horse->height ? $horse->height . ' sm'  : null,
                                'Reňki' => $horse->color,
                                'Jynsy' => $horse->gender,
                            ];
                        @endphp
                        @foreach($infos as $label => $value)
                            @if($value)
                            <li style="display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid #f0f5ff;font-size:0.88rem;">
                                <span style="color:#5a6a88;font-weight:600;">{{ $label }}</span>
                                <span style="color:#0a2560;font-weight:700;">{{ $value }}</span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Lightbox --}}
<div class="hd-lightbox" id="hdLightbox" onclick="hdCloseLightbox()">
    <button class="hd-lightbox-close" onclick="hdCloseLightbox()">×</button>
    <img id="hdLightboxImg" src="" alt="">
</div>

@endsection

@section('js')
<script>
// Mute/unmute toggle for TikTok video
var tkMuted = true;
function tkToggleMute() {
    var v = document.getElementById('tkVideo');
    var btn = document.getElementById('tkMuteBtn');
    if (!v) return;
    tkMuted = !tkMuted;
    v.muted = tkMuted;
    btn.textContent = tkMuted ? '🔇' : '🔊';
}

// Lightbox
function hdOpenLightbox(src) {
    document.getElementById('hdLightbox').classList.add('active');
    document.getElementById('hdLightboxImg').src = src;
}
function hdCloseLightbox() {
    document.getElementById('hdLightbox').classList.remove('active');
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') hdCloseLightbox();
});
</script>
@endsection
