@extends('layouts.site')

@section('css')
<style>
    :root {
        --brand:        #0a529e;
        --brand-mid:    #1271cc;
        --brand-light:  #e8f0fb;
        --brand-lighter:#f0f5ff;
        --accent:       #f97316;   /* orange – matches the site logo palette */
        --text-dark:    #1a2340;
        --text-muted:   #6b7a9a;
        --border:       #dde6f5;
        --white:        #ffffff;
        --shadow-sm:    0 2px 12px rgba(10,82,158,.08);
        --shadow-md:    0 8px 32px rgba(10,82,158,.13);
        --shadow-lg:    0 20px 60px rgba(10,82,158,.18);
        --radius:       16px;
    }

    /* ── Page wrapper ── */
    .turkmen-gips-page {
        background: #f4f7fc;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* ── Hero banner ── */
    .hero-section {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-mid) 60%, #1a8de8 100%);
        padding: 72px 0 56px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    /* subtle geometric pattern overlay */
    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 15% 50%, rgba(255,255,255,.06) 0%, transparent 55%),
            radial-gradient(circle at 85% 20%, rgba(255,255,255,.07) 0%, transparent 50%);
        pointer-events: none;
    }

    .hero-title {
        font-size: clamp(2rem, 6vw, 3.6rem);
        font-weight: 900;
        color: #fff;
        letter-spacing: -.5px;
        margin-bottom: 1.2rem;
        position: relative;
    }

    .hero-subtitle {
        font-size: clamp(1rem, 2vw, 1.3rem);
        color: rgba(255,255,255,.85);
        font-weight: 500;
        line-height: 1.65;
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
    }

    /* ── Carousel section ── */
    .carousel-section {
        padding: 48px 0 40px;
    }

    .carousel-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .carousel-wrapper {
        background: var(--white);
        border-radius: 24px;
        padding: 24px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
    }

    .gips-carousel {
        border-radius: var(--radius);
        overflow: hidden;
    }

    .gips-carousel .carousel-item {
        height: 82vh;
        min-height: 520px;
        max-height: 900px;
    }

    .gips-carousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }

    .gips-carousel .carousel-item:hover img {
        transform: scale(1.04);
    }

    /* Carousel controls */
    .carousel-control-prev,
    .carousel-control-next {
        width: 52px;
        height: 52px;
        background: var(--brand);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 1;
        transition: background .22s, box-shadow .22s, transform .22s;
        border: 2px solid rgba(255,255,255,.25);
        box-shadow: var(--shadow-sm);
    }
    .carousel-control-prev { left: 18px; }
    .carousel-control-next { right: 18px; }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background: var(--brand-mid);
        box-shadow: 0 6px 20px rgba(10,82,158,.4);
        transform: translateY(-50%) scale(1.08);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 24px;
        height: 24px;
    }

    .carousel-indicators {
        bottom: 16px;
    }

    .carousel-indicators li {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255,255,255,.5);
        border: none;
        margin: 0 5px;
        transition: all .25s;
    }

    .carousel-indicators li.active {
        background: var(--white);
        width: 24px;
        border-radius: 4px;
        box-shadow: 0 0 8px rgba(255,255,255,.6);
    }

    /* ── Info section ── */
    .info-section {
        padding: 0 0 64px;
    }

    .info-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* Tab buttons */
    .info-tabs {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 32px;
        flex-wrap: wrap;
    }

    .tab-btn {
        padding: 11px 32px;
        font-size: 1rem;
        font-weight: 700;
        background: var(--white);
        border: 2px solid var(--border);
        border-radius: 50px;
        color: var(--text-muted);
        cursor: pointer;
        transition: all .22s;
        letter-spacing: .02em;
        box-shadow: var(--shadow-sm);
    }

    .tab-btn:hover {
        border-color: var(--brand);
        color: var(--brand);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .tab-btn.active {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-mid) 100%);
        border-color: transparent;
        color: var(--white);
        box-shadow: 0 6px 20px rgba(10,82,158,.30);
        transform: translateY(-2px);
    }

    /* Tab content */
    .tab-content {
        display: none;
        animation: fadeInUp .4s ease;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Info box card */
    .info-box {
        background: var(--white);
        border-radius: 20px;
        padding: 48px;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
    }

    .info-title {
        font-size: clamp(1.5rem, 3.5vw, 2.4rem);
        color: var(--brand);
        margin-bottom: 16px;
        text-align: center;
        font-weight: 900;
        letter-spacing: -.3px;
    }

    .info-subtitle {
        font-size: clamp(1rem, 2vw, 1.25rem);
        color: var(--text-muted);
        margin-bottom: 36px;
        line-height: 1.7;
        text-align: center;
    }

    /* Section divider inside card */
    .info-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--brand-light), transparent);
        border: none;
        margin: 32px 0;
    }

    /* Capacity list */
    .capacity-list {
        list-style: none;
        padding: 0;
        margin: 24px 0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 16px;
    }

    .capacity-item {
        font-size: clamp(1rem, 1.8vw, 1.2rem);
        color: var(--text-dark);
        font-weight: 600;
        padding: 20px 20px 20px 28px;
        background: var(--brand-lighter);
        border-left: 4px solid var(--brand);
        border-radius: 12px;
        position: relative;
        transition: transform .22s, box-shadow .22s;
    }

    .capacity-item::before {
        content: '✓';
        position: absolute;
        left: -14px;
        top: 50%;
        transform: translateY(-50%);
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-mid) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .8rem;
        font-weight: 900;
        color: #fff;
        box-shadow: 0 3px 10px rgba(10,82,158,.35);
    }

    .capacity-item:hover {
        transform: translateX(6px);
        box-shadow: var(--shadow-sm);
    }

    /* Highlight badges */
    .highlight-badges {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 14px;
        margin-top: 36px;
    }

    .highlight-text {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-mid) 100%);
        color: #fff;
        font-size: clamp(.9rem, 1.6vw, 1.05rem);
        font-weight: 700;
        padding: 12px 24px;
        border-radius: 50px;
        box-shadow: 0 4px 16px rgba(10,82,158,.25);
        letter-spacing: .02em;
        text-align: center;
        /* override old pulse animation */
        animation: none;
    }

    /* Page entrance */
    .animate-enter {
        animation: pageEnter .7s ease-out;
    }

    @keyframes pageEnter {
        from { opacity: 0; transform: translateY(28px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .gips-carousel .carousel-item {
            height: 58vh;
            min-height: 380px;
        }
        .carousel-control-prev,
        .carousel-control-next { width: 40px; height: 40px; }
        .carousel-wrapper { padding: 14px; }
        .info-box { padding: 28px 20px; }
        .tab-btn { padding: 10px 22px; font-size: .9rem; }
    }
</style>
@endsection

@section('content')
<div class="turkmen-gips-page animate-enter">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">@lang('main.turkmen_gips')</h1>
            <p class="hero-subtitle">@lang('main.turkmen_gips_subtitle')</p>
        </div>
    </div>

    <!-- Carousel Section -->
    <div class="carousel-section">
        <div class="carousel-container">
            <div class="carousel-wrapper">
                <div id="turkmenGipsCarousel" class="carousel slide gips-carousel" data-ride="carousel" data-interval="8000">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#turkmenGipsCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#turkmenGipsCarousel" data-slide-to="1"></li>
                        <li data-target="#turkmenGipsCarousel" data-slide-to="2"></li>
                        <li data-target="#turkmenGipsCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Carousel Items -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/new_images/1.webp') }}" alt="Turkmen Gips Plant 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/new_images/2.webp') }}" alt="Turkmen Gips Plant 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/new_images/3.webp') }}" alt="Turkmen Gips Plant 3">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/new_images/4.webp') }}" alt="Turkmen Gips Plant 4">
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="carousel-control-prev" href="#turkmenGipsCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next" href="#turkmenGipsCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Section with Language Tabs -->
    <div class="info-section">
        <div class="info-container">
            <div class="info-tabs">
                @if (LaravelLocalization::getCurrentLocale() == 'ru')
                    <button class="tab-btn active" onclick="switchTab('ru')">Русский</button>
                    <button class="tab-btn" onclick="switchTab('en')">English</button>
                    <button class="tab-btn" onclick="switchTab('tk')">Türkmençe</button>
                @elseif(LaravelLocalization::getCurrentLocale() == 'tk')
                    <button class="tab-btn" onclick="switchTab('ru')">Русский</button>
                    <button class="tab-btn" onclick="switchTab('en')">English</button>
                    <button class="tab-btn active" onclick="switchTab('tk')">Türkmençe</button>
                @else
                    <button class="tab-btn" onclick="switchTab('ru')">Русский</button>
                    <button class="tab-btn active" onclick="switchTab('en')">English</button>
                    <button class="tab-btn" onclick="switchTab('tk')">Türkmençe</button>
                @endif
            </div>

            <!-- Russian Content -->
            <div id="tab-ru" class="tab-content {{ LaravelLocalization::getCurrentLocale() == 'ru' ? 'active' : '' }}">
                <div class="info-box">
                    <h2 class="info-title">НОВЫЙ ЗАВОД "ТУРКМЕН ГИПС"</h2>
                    <p class="info-subtitle">СОВМЕСТНЫЙ ПРОЕКТ ХО "АК БУЛУТ" И МИНИСТЕРСТВА ПРОМЫШЛЕННОСТИ И СТРОИТЕЛЬНОГО ПРОИЗВОДСТВА ТУРКМЕНИСТАНА.</p>
                    
                    <h3 class="info-title" style="font-size: 2rem; margin-top: 40px;">ПРОИЗВОДСТВЕННАЯ МОЩНОСТЬ В ГОД</h3>
                    <ul class="capacity-list">
                        <li class="capacity-item">250 000 тонн сухих строительных смесей</li>
                        <li class="capacity-item">20 миллионов квадратных метров гипсокартона</li>
                    </ul>
                    
                    <div class="highlight-badges">
                        <p class="highlight-text">НОВЕЙШЕЕ ЕВРОПЕЙСКОЕ ОБОРУДОВАНИЕ И ТЕХНОЛОГИИ</p>
                        <p class="highlight-text">ОТКРЫТИЕ В 2026 ГОДУ.</p>
                    </div>
                </div>
            </div>

            <!-- English Content -->
            <div id="tab-en" class="tab-content {{ LaravelLocalization::getCurrentLocale() == 'en' ? 'active' : '' }}">
                <div class="info-box">
                    <h2 class="info-title">NEW "TURKMEN GIPS" PLANT</h2>
                    <p class="info-subtitle">A JOINT PROJECT OF ES "AK BULUT" AND THE MINISTRY OF INDUSTRY AND CONSTRUCTION PRODUCTION OF TURKMENISTAN.</p>
                    
                    <h3 class="info-title" style="font-size: 2rem; margin-top: 40px;">ANNUAL PRODUCTION CAPACITY</h3>
                    <ul class="capacity-list">
                        <li class="capacity-item">250,000 tons of dry construction mixes</li>
                        <li class="capacity-item">20 million square meters of gypsum board</li>
                    </ul>
                    
                    <div class="highlight-badges">
                        <p class="highlight-text">LATEST EUROPEAN EQUIPMENT AND TECHNOLOGY</p>
                        <p class="highlight-text">OPENING IN 2026.</p>
                    </div>
                </div>
            </div>

            <!-- Turkmen Content -->
            <div id="tab-tk" class="tab-content {{ LaravelLocalization::getCurrentLocale() == 'tk' ? 'active' : '' }}">
                <div class="info-box">
                    <h2 class="info-title">TÄZE "TÜRKMEN GIPS" ZAWODY</h2>
                    <p class="info-subtitle">"AK BULUT" HJ WE TÜRKMENISTANYŇ SENAGAT WE GURLUŞYK ÖNÜMÇILIGI MINISTRLIGINIŇ BILELIKDE DÖREDILEN KÄRHANASY.</p>
                    
                    <h3 class="info-title" style="font-size: 2rem; margin-top: 40px;">ÝYLLYK ÖNDÜRIŞ KUWWATLYLYGY</h3>
                    <ul class="capacity-list">
                        <li class="capacity-item">250,000 tonna gury gurluşyk garyndylary</li>
                        <li class="capacity-item">20 million inedördül metr gipsokarton</li>
                    </ul>
                    
                    <div class="highlight-badges">
                        <p class="highlight-text">IŇ TÄZE ÝEWROPA ENJAMLARY WE TEHNOLOGIÝASY.</p>
                        <p class="highlight-text">2026-njy ÝYLDA AÇYLÝAR.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function switchTab(lang) {
        // Remove active class from all tabs and contents
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        
        // Add active class to selected tab and content
        event.target.classList.add('active');
        document.getElementById('tab-' + lang).classList.add('active');
    }

    // Initialize carousel
    $(document).ready(function() {
        $('#turkmenGipsCarousel').carousel({
            interval: 8000,
            pause: 'hover'
        });
    });
</script>
@endsection
