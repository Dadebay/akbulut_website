@extends('layouts.site')

@section('css')
<style>
    :root {
        --brand:        #0a529e;
        --brand-mid:    #1271cc;
        --brand-light:  #e8f0fb;
        --brand-lighter:#f0f5ff;
        --text-dark:    #1a2340;
        --text-muted:   #6b7a9a;
        --border:       #dde6f5;
        --white:        #ffffff;
        --shadow-sm:    0 2px 12px rgba(10,82,158,.07);
        --shadow-md:    0 6px 28px rgba(10,82,158,.12);
        --radius:       16px;
    }

    .anniversary-page {
        background: #f4f7fc;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* ── Twinkling Stars ── */
    .hero-stars { position: absolute; inset: 0; overflow: hidden; pointer-events: none; }
    .star {
        position: absolute;
        background: #fff;
        border-radius: 50%;
        opacity: 0;
        animation: twinkle var(--dur, 3s) var(--delay, 0s) infinite ease-in-out;
    }
    @keyframes twinkle {
        0%, 100% { opacity: 0; transform: scale(.4); }
        50%       { opacity: var(--op, .75); transform: scale(1.15); }
    }

    /* ── Hero ── */
    .hero-section {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-mid) 60%, #1a8de8 100%);
        padding: 128px 0 108px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .hero-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 15% 60%, rgba(255,255,255,.09) 0%, transparent 50%),
            radial-gradient(circle at 85% 25%, rgba(255,255,255,.07) 0%, transparent 50%);
        pointer-events: none;
    }
    .hero-badge {
        display: inline-block;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.30);
        color: #fff;
        font-size: .82rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        padding: 7px 18px;
        border-radius: 50px;
        margin-bottom: 24px;
        animation: badgeShine 4s ease-in-out infinite;
    }
    @keyframes badgeShine {
        0%, 100% { box-shadow: 0 0 0 0 rgba(255,255,255,0); }
        50%       { box-shadow: 0 0 22px 4px rgba(255,255,255,.22); }
    }

    /* Number wrapper + rings */
    .hero-number-wrap {
        position: relative;
        display: inline-block;
        animation: numFloat 5s ease-in-out infinite;
    }
    @keyframes numFloat {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-12px); }
    }
    .hero-ring {
        position: absolute;
        border-radius: 50%;
        border: 1.5px solid rgba(255,255,255,.18);
        top: 50%; left: 50%;
        pointer-events: none;
        animation: ringPulse 3.5s ease-in-out infinite;
    }
    .hero-ring-1 { width: 220px; height: 220px; margin-top: -110px; margin-left: -110px; animation-delay: 0s; }
    .hero-ring-2 { width: 320px; height: 320px; margin-top: -160px; margin-left: -160px; animation-delay: 1.15s; }
    .hero-ring-3 { width: 430px; height: 430px; margin-top: -215px; margin-left: -215px; animation-delay: 2.3s; }
    @keyframes ringPulse {
        0%   { opacity: 0; transform: scale(.8); }
        35%  { opacity: .55; }
        100% { opacity: 0; transform: scale(1.25); }
    }
    .hero-number {
        font-size: clamp(5rem, 18vw, 11rem);
        font-weight: 900;
        color: #fff;
        line-height: 1;
        letter-spacing: -4px;
        display: block;
        text-shadow: 0 0 70px rgba(255,255,255,.28);
        position: relative; z-index: 1;
    }
    .hero-number sup {
        font-size: .28em;
        letter-spacing: 2px;
        font-weight: 700;
        vertical-align: super;
        opacity: .85;
    }
    .hero-subtitle {
        font-size: clamp(1.1rem, 3vw, 1.75rem);
        color: rgba(255,255,255,.9);
        font-weight: 600;
        margin: 16px 0 6px;
        letter-spacing: .5px;
    }
    .hero-years {
        font-size: .92rem;
        color: rgba(255,255,255,.55);
        letter-spacing: 4px;
        font-weight: 600;
    }
    /* Tagline */
    .hero-tagline {
        margin: 28px auto 0;
        max-width: 560px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        flex-wrap: wrap;
    }
    .hero-tagline-word {
        font-size: clamp(.82rem, 2vw, 1.05rem);
        font-weight: 600;
        color: rgba(255,255,255,.82);
        letter-spacing: .5px;
        padding: 0 14px;
        position: relative;
    }
    .hero-tagline-word:not(:last-child)::after {
        content: '·';
        position: absolute;
        right: -2px;
        color: rgba(255,255,255,.35);
        font-size: 1.2em;
    }
    /* Scroll hint */
    .hero-scroll {
        margin-top: 44px;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        animation: scrollBounce 2.4s ease-in-out infinite;
        cursor: pointer;
    }
    .hero-scroll svg  { opacity: .4; }
    @keyframes scrollBounce {
        0%, 100% { transform: translateY(0); opacity: .6; }
        50%       { transform: translateY(8px); opacity: 1; }
    }

    /* ── Stats ── */
    .stats-section {
        background: #f4f7fc;
        padding: 72px 0 64px;
        border-bottom: 1px solid var(--border);
    }
    .stats-section .row { align-items: stretch; }
    .stats-section .col-6,
    .stats-section .col-md-3 { display: flex; flex-direction: column; }
    .stat-card {
        text-align: center;
        padding: 0;
        border-radius: var(--radius);
        background: #ffffff;
        border: 1px solid var(--border);
        box-shadow: 0 2px 16px rgba(10,82,158,.07);
        position: relative;
        overflow: hidden;
        transition: transform .28s cubic-bezier(.25,.46,.45,.94), box-shadow .28s;
        margin-bottom: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
    }
    /* Blue top stripe — same for all cards */
    .stat-card-stripe {
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #0a529e, #1271cc, #1a8de8);
        flex-shrink: 0;
    }
    .stat-card-body {
        padding: 28px 16px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 48px rgba(10,82,158,.14);
    }
    .stat-icon {
        width: 54px; height: 54px;
        background: var(--brand-lighter);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        transition: transform .28s cubic-bezier(.25,.46,.45,.94), background .25s;
    }
    .stat-icon svg { display: block; }
    .stat-card:hover .stat-icon {
        transform: scale(1.12) rotate(-6deg);
        background: rgba(10,82,158,.12);
    }
    .stat-number {
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 900;
        background: linear-gradient(135deg, #0a529e, #1271cc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 10px;
        display: block;
    }
    .stat-label {
        font-size: .76rem;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        line-height: 1.5;
    }

    /* ── Timeline ── */
    .timeline-section { padding: 72px 0 96px; }

    .timeline-header {
        text-align: center;
        margin-bottom: 56px;
    }
    .timeline-header h2 {
        font-size: clamp(1.5rem, 4vw, 2.2rem);
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -.4px;
    }
    .timeline-header p { color: var(--text-muted); margin-top: 6px; font-size: .95rem; }
    .accent-line {
        width: 44px; height: 4px;
        background: linear-gradient(90deg, var(--brand), var(--brand-mid));
        border-radius: 3px;
        margin: 12px auto 0;
    }

    /* Vertical rail */
    .tl-wrap {
        position: relative;
        max-width: 880px;
        margin: 0 auto;
        padding: 0 24px;
    }
    .tl-wrap::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0; bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, var(--brand-light), var(--brand) 40%, var(--brand-light));
        transform: translateX(-50%);
    }

    /* Row */
    .tl-item {
        display: grid;
        grid-template-columns: 1fr 24px 1fr;
        gap: 0 8px;
        align-items: start;
        margin-bottom: 48px;
        opacity: 0;
        transform: translateY(24px);
        transition: opacity .45s ease, transform .45s ease;
    }
    .tl-item.visible { opacity: 1; transform: none; }

    /* Odd: card on left, empty on right */
    .tl-item:nth-child(odd)  .tl-left  { grid-column: 1; }
    .tl-item:nth-child(odd)  .tl-mid   { grid-column: 2; }
    .tl-item:nth-child(odd)  .tl-right { grid-column: 3; visibility: hidden; }

    /* Even: empty on left, card on right */
    .tl-item:nth-child(even) .tl-left  { grid-column: 1; visibility: hidden; }
    .tl-item:nth-child(even) .tl-mid   { grid-column: 2; }
    .tl-item:nth-child(even) .tl-right { grid-column: 3; }

    .tl-left, .tl-right { padding: 0 20px; }
    .tl-item:nth-child(odd) .tl-left  { text-align: right; }
    .tl-item:nth-child(even) .tl-right { text-align: left; }

    /* Card */
    .tl-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 24px 22px 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border);
        text-align: left;
        display: inline-block;
        width: 100%;
        transition: box-shadow .22s, transform .22s;
        position: relative;
    }
    .tl-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }

    /* Arrow right (odd cards pointing right toward line) */
    .tl-item:nth-child(odd) .tl-card::after {
        content: '';
        position: absolute;
        right: -10px; top: 22px;
        border: 9px solid transparent;
        border-left-color: var(--white);
    }
    /* Arrow left (even cards pointing left toward line) */
    .tl-item:nth-child(even) .tl-card::after {
        content: '';
        position: absolute;
        left: -10px; top: 22px;
        border: 9px solid transparent;
        border-right-color: var(--white);
    }

    .tl-year {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--brand);
        line-height: 1;
        margin-bottom: 6px;
        letter-spacing: -1px;
    }
    .tl-title {
        font-size: .98rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 6px;
        line-height: 1.4;
    }
    .tl-desc {
        font-size: .86rem;
        color: var(--text-muted);
        line-height: 1.7;
        margin: 0;
    }

    /* Center dot */
    .tl-mid {
        display: flex;
        justify-content: center;
        padding-top: 22px;
    }
    .tl-dot {
        width: 16px; height: 16px;
        background: var(--brand);
        border-radius: 50%;
        border: 3px solid #f4f7fc;
        box-shadow: 0 0 0 2px var(--brand);
        flex-shrink: 0;
        transition: transform .22s, background .22s;
    }
    .tl-item:hover .tl-dot { transform: scale(1.3); background: var(--brand-mid); }

    /* Last item highlight */
    .tl-item--featured .tl-card {
        border-left: 3px solid var(--brand);
        background: var(--brand-lighter);
    }
    .tl-item--featured .tl-dot {
        width: 22px; height: 22px;
        background: var(--brand-mid);
    }

    /* ── Mobile ── */
    @media (max-width: 767px) {
        .tl-wrap::before { left: 16px; transform: none; }
        .tl-item {
            grid-template-columns: 32px 1fr;
            gap: 0 12px;
        }
        .tl-item .tl-left,
        .tl-item .tl-right,
        .tl-item .tl-mid { all: unset; }
        .tl-item { position: relative; padding-left: 0; }
        .tl-item::before {
            content: '';
            position: absolute;
            left: 7px; top: 20px;
            width: 16px; height: 16px;
            background: var(--brand);
            border-radius: 50%;
            border: 3px solid #f4f7fc;
            box-shadow: 0 0 0 2px var(--brand);
        }
        .tl-card { margin-left: 40px; }
        .tl-card::after { display: none !important; }
        .tl-item:nth-child(odd) .tl-left,
        .tl-item:nth-child(even) .tl-left  { display: none; }
        .tl-item .tl-right { display: block !important; visibility: visible !important; }
    }
</style>
@endsection

@section('content')
<div class="anniversary-page">

    <!-- Hero -->
    <section class="hero-section">
        <div class="hero-stars" id="heroStars"></div>
        <div class="container">
            <div class="hero-inner">
                <div class="hero-badge">2015 &mdash; 2025</div>
                <div class="hero-number-wrap">
                    <div class="hero-ring hero-ring-1"></div>
                    <div class="hero-ring hero-ring-2"></div>
                    <div class="hero-ring hero-ring-3"></div>
                    <span class="hero-number">10<sup>@lang('main.years')</sup></span>
                </div>
                <p class="hero-subtitle">@lang('main.years_of_excellence')</p>
                <p class="hero-years">AK BULUT</p>
                <div class="hero-tagline">
                    <span class="hero-tagline-word">Binýadymyz berk</span>
                    <span class="hero-tagline-word">Işimiz ygtybarly</span>
                    <span class="hero-tagline-word">Geljegiñiz aýdyň</span>
                </div>
                <div class="hero-scroll" onclick="document.querySelector('.stats-section').scrollIntoView({behavior:'smooth'})" aria-hidden="true">
                    <svg width="18" height="22" viewBox="0 0 16 20" fill="none">
                        <path d="M8 1v14M2 9l6 7 6-7" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-3 justify-content-center">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-card-stripe"></div>
                        <div class="stat-card-body">
                            <div class="stat-icon">
                                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#0a529e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                            <span class="stat-number counter" data-target="10">0</span>
                            <div class="stat-label">@lang('main.years_of_stability')</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-card-stripe"></div>
                        <div class="stat-card-body">
                            <div class="stat-icon">
                                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#0a529e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <span class="stat-number counter" data-target="500">0</span>
                            <div class="stat-label">@lang('main.employees')</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-card-stripe"></div>
                        <div class="stat-card-body">
                            <div class="stat-icon">
                                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#0a529e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                            </div>
                            <span class="stat-number counter" data-target="10">0</span>
                            <div class="stat-label">@lang('main.countries_in_export')</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-card-stripe"></div>
                        <div class="stat-card-body">
                            <div class="stat-icon">
                                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#0a529e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                            </div>
                            <span class="stat-number counter" data-target="150">0</span>
                            <div class="stat-label">@lang('main.products')</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline -->
    <section class="timeline-section">
        <div class="container">
            <div class="timeline-header">
                <h2>@lang('main.years_of_excellence')</h2>
                <p>2015 &mdash; 2025</p>
                <div class="accent-line"></div>
            </div>

            <div class="tl-wrap">

                <div class="tl-item">
                    <div class="tl-left"><div class="tl-card">
                        <div class="tl-year">2015</div>
                        <div class="tl-title">@lang('main.company_founded')</div>
                        <p class="tl-desc">@lang('main.company_founded_desc')</p>
                    </div></div>
                    <div class="tl-mid"><div class="tl-dot"></div></div>
                    <div class="tl-right"></div>
                </div>

                <div class="tl-item">
                    <div class="tl-left"></div>
                    <div class="tl-mid"><div class="tl-dot"></div></div>
                    <div class="tl-right"><div class="tl-card">
                        <div class="tl-year">2016</div>
                        <div class="tl-title">@lang('main.suspended_ceilings_factory')</div>
                        <p class="tl-desc">@lang('main.suspended_ceilings_factory_desc')</p>
                    </div></div>
                </div>

                <div class="tl-item">
                    <div class="tl-left"><div class="tl-card">
                        <div class="tl-year">2017</div>
                        <div class="tl-title">@lang('main.production_capacity_expansion')</div>
                        <p class="tl-desc">@lang('main.production_capacity_expansion_desc')</p>
                    </div></div>
                    <div class="tl-mid"><div class="tl-dot"></div></div>
                    <div class="tl-right"></div>
                </div>

                <div class="tl-item">
                    <div class="tl-left"></div>
                    <div class="tl-mid"><div class="tl-dot"></div></div>
                    <div class="tl-right"><div class="tl-card">
                        <div class="tl-year">2018</div>
                        <div class="tl-title">@lang('main.new_production_line')</div>
                        <p class="tl-desc">@lang('main.new_production_line_desc')</p>
                    </div></div>
                </div>

                <div class="tl-item">
                    <div class="tl-left"><div class="tl-card">
                        <div class="tl-year">2019</div>
                        <div class="tl-title">@lang('main.international_expansion')</div>
                        <p class="tl-desc">@lang('main.international_expansion_desc')</p>
                    </div></div>
                    <div class="tl-mid"><div class="tl-dot"></div></div>
                    <div class="tl-right"></div>
                </div>

                <div class="tl-item">
                    <div class="tl-left"></div>
                    <div class="tl-mid"><div class="tl-dot"></div></div>
                    <div class="tl-right"><div class="tl-card">
                        <div class="tl-year">2020</div>
                        <div class="tl-title">@lang('main.export_covid')</div>
                        <p class="tl-desc">@lang('main.export_covid_desc')</p>
                    </div></div>
                </div>

                <div class="tl-item">
                    <div class="tl-left"><div class="tl-card">
                        <div class="tl-year">2023</div>
                        <div class="tl-title">@lang('main.new_factory_plasterboard')</div>
                        <p class="tl-desc">@lang('main.new_factory_plasterboard_desc')</p>
                    </div></div>
                    <div class="tl-mid"><div class="tl-dot"></div></div>
                    <div class="tl-right"></div>
                </div>

                <div class="tl-item">
                    <div class="tl-left"></div>
                    <div class="tl-mid"><div class="tl-dot"></div></div>
                    <div class="tl-right"><div class="tl-card">
                        <div class="tl-year">2024</div>
                        <div class="tl-title">@lang('main.new_export_countries')</div>
                        <p class="tl-desc">@lang('main.new_export_countries_desc')</p>
                    </div></div>
                </div>

                <div class="tl-item tl-item--featured">
                    <div class="tl-left"><div class="tl-card">
                        <div class="tl-year">2025</div>
                        <div class="tl-title">@lang('main.anniversary_milestone')</div>
                        <p class="tl-desc">@lang('main.anniversary_milestone_desc')</p>
                    </div></div>
                    <div class="tl-mid"><div class="tl-dot"></div></div>
                    <div class="tl-right"></div>
                </div>

            </div>
        </div>
    </section>

</div>
@include('inc.footer')
@endsection

@section('js')
<script>
    /* ── Generate twinkling stars ── */
    (function () {
        const cont = document.getElementById('heroStars');
        if (!cont) return;
        const durs  = [2.4, 3.0, 3.6, 2.8, 3.2, 4.0, 2.6, 3.8, 3.4, 2.2];
        const sizes = [2, 2, 3, 3, 4, 2, 3, 2, 4, 2];
        for (let i = 0; i < 45; i++) {
            const el = document.createElement('div');
            el.className = 'star';
            const sz = sizes[i % sizes.length];
            el.style.cssText = [
                'width:'  + sz + 'px',
                'height:' + sz + 'px',
                'top:'    + (Math.random() * 100).toFixed(2) + '%',
                'left:'   + (Math.random() * 100).toFixed(2) + '%',
                '--dur:'   + durs[i % durs.length] + 's',
                '--delay:' + (Math.random() * 5).toFixed(2) + 's',
                '--op:'    + (0.4 + Math.random() * 0.5).toFixed(2)
            ].join(';');
            cont.appendChild(el);
        }
    })();

    /* ── Counter animation ── */
    function animateCounter(el) {
        if (el.dataset.done) return;
        el.dataset.done = '1';
        const target = parseInt(el.getAttribute('data-target'));
        const step = target / (1400 / 16);
        let cur = 0;
        const t = setInterval(() => {
            cur += step;
            if (cur >= target) {
                /* restore gradient text after textContent change */
                el.textContent = target + '+';
                el.style.cssText = 'background:linear-gradient(135deg,#0a529e,#1271cc);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text';
                clearInterval(t);
            } else {
                el.textContent = Math.floor(cur);
                el.style.cssText = 'background:linear-gradient(135deg,#0a529e,#1271cc);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text';
            }
        }, 16);
    }

    /* ── Timeline scroll-reveal ── */
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.tl-item').forEach((el, i) => {
        el.style.transitionDelay = (i * 0.06) + 's';
        io.observe(el);
    });

    /* ── Stats counter trigger ── */
    const sIo = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                document.querySelectorAll('.counter').forEach(animateCounter);
                sIo.unobserve(e.target);
            }
        });
    }, { threshold: 0.3 });
    const ss = document.querySelector('.stats-section');
    if (ss) sIo.observe(ss);
</script>
@endsection
