@extends('layouts.horse')

@section('css')
<style>
    /* ── Horses Hero ─────────────────────────── */
    .horses-hero {
        position: relative;
        background: linear-gradient(135deg, #071833 0%, #0a2560 60%, #0d3a8a 100%);
        padding: 72px 0 56px;
        text-align: center;
        overflow: hidden;
    }
    .horses-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .horses-hero h1 {
        position: relative;
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        letter-spacing: -0.5px;
        margin-bottom: 12px;
    }
    .horses-hero p {
        position: relative;
        color: rgba(255,255,255,0.65);
        font-size: 1.05rem;
        max-width: 520px;
        margin: 0 auto;
    }

    /* ── Horses Section ─────────────────────── */
    .horses-section {
        padding: 56px 0 80px;
        background: #f4f7fc;
    }
    .horses-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    /* ── Horse Card ─────────────────────────── */
    .horse-card {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        display: block;
        aspect-ratio: 3/4;
        box-shadow: 0 4px 20px rgba(7,24,51,0.18);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #101e3a;
    }
    .horse-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 18px 48px rgba(7,24,51,0.32);
        color: inherit;
        text-decoration: none;
    }
    .horse-card:hover .horse-card-img {
        transform: scale(1.07);
    }
    .horse-card:hover .horse-card-overlay {
        background: linear-gradient(to top,
            rgba(7,24,51,0.97) 0%,
            rgba(7,24,51,0.72) 45%,
            rgba(7,24,51,0.12) 75%,
            transparent 100%);
    }

    /* Image fills the full card */
    .horse-card-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }
    .horse-card-img-placeholder {
        position: absolute;
        inset: 0;
        background: linear-gradient(160deg, #0d2a5e 0%, #1a4a8a 50%, #0a1e45 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 72px;
    }

    /* Dark gradient overlay at the bottom */
    .horse-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top,
            rgba(7,24,51,0.93) 0%,
            rgba(7,24,51,0.55) 40%,
            rgba(7,24,51,0.08) 70%,
            transparent 100%);
        transition: background 0.3s ease;
    }

    /* Text on top of the overlay */
    .horse-card-body {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px 20px 22px;
        z-index: 2;
    }
    .horse-card-name {
        font-size: 1.2rem;
        font-weight: 800;
        color: #fff;
        margin: 0 0 4px;
        text-shadow: 0 1px 4px rgba(0,0,0,0.4);
        letter-spacing: -0.2px;
    }
    .horse-card-breed {
        font-size: 0.78rem;
        color: rgba(255,255,255,0.6);
        margin: 0 0 10px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .horse-card-meta {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }
    .horse-meta-tag {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .horse-card-arrow {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.25);
        color: #fff;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 30px;
        transition: background 0.2s ease;
    }
    .horse-card:hover .horse-card-arrow {
        background: rgba(255,255,255,0.28);
    }

    /* Badge top-right */
    .horse-card-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 3;
        background: rgba(10,82,158,0.85);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.2);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .horses-empty {
        text-align: center;
        padding: 80px 20px;
        color: #8a9bb8;
    }
    .horses-empty h3 { font-size: 1.2rem; color: #0a2560; margin-bottom: 8px; }

    @media (max-width: 1100px) { .horses-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 768px)  { .horses-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; } .horses-hero { padding: 52px 0 40px; } }
    @media (max-width: 480px)  { .horses-grid { grid-template-columns: 1fr; } .horse-card { aspect-ratio: 4/5; } }
</style>
@endsection

@section('content')

<div class="horses-hero">
    <div class="container">
        <h1>Türkmen Atlary</h1>
        <p>Ahalteke nesliniň iň görnükli bedewleri bilen tanyş boluň</p>
    </div>
</div>

<section class="horses-section">
    <div class="container">
        @if($horses->count() > 0)
        <div class="horses-grid">
            @foreach($horses as $horse)
            <a href="{{ route('horse.profile', $horse->id) }}" class="horse-card">

                {{-- Full-card image --}}
                @if($horse->cover_image_url)
                    <img src="{{ $horse->cover_image_url }}"
                         alt="{{ $horse->name }}"
                         class="horse-card-img"
                         onerror="this.style.display='none';">
                @endif
                <div class="horse-card-img-placeholder" @if($horse->cover_image_url) style="display:none;" @endif>🐴</div>

                {{-- Gradient overlay --}}
                <div class="horse-card-overlay"></div>

                {{-- Breed badge top-right --}}
                <div class="horse-card-badge">{{ $horse->breed ?? 'Ahalteke' }}</div>

                {{-- Info at the bottom --}}
                <div class="horse-card-body">
                    <h3 class="horse-card-name">{{ $horse->name }}</h3>
                    <div class="horse-card-meta">
                        @if($horse->age)   <span class="horse-meta-tag">{{ $horse->age }} ýaş</span> @endif
                        @if($horse->color) <span class="horse-meta-tag">{{ $horse->color }}</span> @endif
                        @if($horse->gender)<span class="horse-meta-tag">{{ $horse->gender }}</span> @endif
                    </div>
                    <span class="horse-card-arrow">
                        Giňişleýin
                        <svg width="13" height="13" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="horses-empty">
            <p style="font-size:48px;margin-bottom:12px;">🐴</p>
            <h3>Atlar heniz goşulmady</h3>
            <p>Admin panelden at maglumatlary goşuň.</p>
        </div>
        @endif
    </div>
</section>

@endsection
