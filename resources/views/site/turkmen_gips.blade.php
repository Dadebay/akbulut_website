@extends('layouts.site')

@section('css')
<style>
    :root {
        --primary-color: #0a529e;
        --secondary-color: #144b9d;
        --accent-color: #ffd700;
        --accent-glow: #ffed4e;
        --text-light: #ffffff;
        --bg-dark: #0f1419;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .turkmen-gips-page {
        background: linear-gradient(135deg, #0a0e1a 0%, #1a2332 50%, #0f1419 100%);
        min-height: 100vh;
        overflow-x: hidden;
        position: relative;
        padding: 80px 0 60px;
    }

    /* Animated Background */
    .turkmen-gips-page::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 50%, rgba(10, 82, 158, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 20%, rgba(20, 75, 157, 0.1) 0%, transparent 50%);
        animation: backgroundShift 20s ease-in-out infinite;
        pointer-events: none;
        z-index: 0;
    }

    @keyframes backgroundShift {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        z-index: 2;
        padding: 60px 0 40px;
        text-align: center;
    }

    .hero-title {
        font-size: clamp(2.5rem, 8vw, 5rem);
        font-weight: 900;
        background: linear-gradient(135deg, 
            var(--accent-color) 0%, 
            var(--accent-glow) 25%,
            #fff 50%, 
            var(--accent-glow) 75%,
            var(--accent-color) 100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 2rem;
        animation: shimmerGold 3s linear infinite;
        text-shadow: 0 0 80px rgba(255, 215, 0, 0.5);
        filter: drop-shadow(0 0 30px rgba(255, 215, 0, 0.6));
    }

    @keyframes shimmerGold {
        0% { background-position: 0% center; }
        100% { background-position: 200% center; }
    }

    .hero-subtitle {
        font-size: clamp(1.2rem, 3vw, 2rem);
        color: var(--text-light);
        margin-bottom: 1.5rem;
        opacity: 0.95;
        text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        font-weight: 600;
        line-height: 1.6;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        padding: 0 20px;
    }

    /* Carousel Section */
    .carousel-section {
        position: relative;
        z-index: 2;
        padding: 40px 0;
    }

    .carousel-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
    }

    .carousel-wrapper {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border-radius: 30px;
        padding: 40px;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.4),
            inset 0 0 60px rgba(255, 215, 0, 0.05),
            0 0 100px rgba(10, 82, 158, 0.2);
        border: 2px solid rgba(255, 215, 0, 0.2);
        position: relative;
        overflow: hidden;
    }

    .carousel-wrapper::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, 
            var(--accent-color), 
            var(--primary-color), 
            var(--accent-color));
        background-size: 400% 400%;
        border-radius: 30px;
        z-index: -1;
        animation: borderGlow 6s ease infinite;
        opacity: 0.3;
    }

    @keyframes borderGlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .gips-carousel {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    }

    .gips-carousel .carousel-item {
        height: 85vh;
        min-height: 600px;
        max-height: 1000px;
        position: relative;
    }

    .gips-carousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(1.1) contrast(1.1);
        transition: transform 0.5s ease;
    }

    .gips-carousel .carousel-item:hover img {
        transform: scale(1.05);
    }

    /* Carousel Controls */
    .carousel-control-prev,
    .carousel-control-next {
        width: 60px;
        height: 60px;
        background: rgba(10, 82, 158, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 1;
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 215, 0, 0.3);
    }

    .carousel-control-prev {
        left: 20px;
    }

    .carousel-control-next {
        right: 20px;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background: rgba(255, 215, 0, 0.9);
        border-color: rgba(255, 215, 0, 0.8);
        box-shadow: 0 0 30px rgba(255, 215, 0, 0.6);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 30px;
        height: 30px;
    }

    /* Carousel Indicators */
    .carousel-indicators {
        bottom: 20px;
    }

    .carousel-indicators li {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        margin: 0 8px;
        border: 2px solid rgba(255, 215, 0, 0.3);
        transition: all 0.3s ease;
    }

    .carousel-indicators li.active {
        background: var(--accent-color);
        box-shadow: 0 0 20px var(--accent-color);
        transform: scale(1.3);
    }

    /* Info Section */
    .info-section {
        position: relative;
        z-index: 2;
        padding: 60px 0;
    }

    .info-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .info-tabs {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .tab-btn {
        padding: 15px 40px;
        font-size: 1.2rem;
        font-weight: 700;
        background: rgba(10, 82, 158, 0.3);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 215, 0, 0.3);
        border-radius: 50px;
        color: var(--text-light);
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .tab-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .tab-btn:hover::before {
        left: 100%;
    }

    .tab-btn:hover,
    .tab-btn.active {
        background: rgba(255, 215, 0, 0.2);
        border-color: var(--accent-color);
        box-shadow: 0 0 30px rgba(255, 215, 0, 0.4);
        transform: translateY(-3px);
    }

    .tab-content {
        display: none;
        animation: fadeInUp 0.5s ease;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .info-box {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 40px;
        border: 2px solid rgba(255, 215, 0, 0.2);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    .info-title {
        font-size: clamp(1.8rem, 4vw, 3rem);
        color: var(--accent-color);
        margin-bottom: 30px;
        text-align: center;
        font-weight: 900;
        text-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
    }

    .info-subtitle {
        font-size: clamp(1.2rem, 2.5vw, 1.8rem);
        color: var(--text-light);
        margin-bottom: 30px;
        line-height: 1.6;
        text-align: center;
        opacity: 0.9;
    }

    .capacity-list {
        list-style: none;
        padding: 0;
        margin: 30px 0;
    }

    .capacity-item {
        font-size: clamp(1.1rem, 2vw, 1.5rem);
        color: var(--text-light);
        padding: 20px;
        margin-bottom: 15px;
        background: rgba(10, 82, 158, 0.2);
        border-left: 4px solid var(--accent-color);
        border-radius: 10px;
        position: relative;
        transition: all 0.3s ease;
    }

    .capacity-item::before {
        content: '✓';
        position: absolute;
        left: -15px;
        top: 50%;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        background: var(--accent-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: var(--bg-dark);
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.6);
    }

    .capacity-item:hover {
        background: rgba(10, 82, 158, 0.3);
        transform: translateX(10px);
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.3);
    }

    .highlight-text {
        font-size: clamp(1.3rem, 2.5vw, 2rem);
        color: var(--accent-color);
        text-align: center;
        margin-top: 30px;
        font-weight: 800;
        text-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .gips-carousel .carousel-item {
            height: 60vh;
            min-height: 450px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 45px;
            height: 45px;
        }

        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
        }

        .carousel-wrapper {
            padding: 20px;
        }

        .info-box {
            padding: 25px;
        }

        .tab-btn {
            padding: 12px 25px;
            font-size: 1rem;
        }

        .capacity-item {
            padding: 15px 15px 15px 25px;
        }
    }

    /* Page Enter Animation */
    .animate-enter {
        animation: pageEnter 1s ease-out;
    }

    @keyframes pageEnter {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
                    
                    <p class="highlight-text">НОВЕЙШЕЕ ЕВРОПЕЙСКОЕ ОБОРУДОВАНИЕ И ТЕХНОЛОГИИ</p>
                    <p class="highlight-text">ОТКРЫТИЕ В 2026 ГОДУ.</p>
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
                    
                    <p class="highlight-text">LATEST EUROPEAN EQUIPMENT AND TECHNOLOGY</p>
                    <p class="highlight-text">OPENING IN 2026.</p>
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
                    
                    <p class="highlight-text">IŇ TÄZE ÝEWROPA ENJAMLARY WE TEHNOLOGIÝASY.</p>
                    <p class="highlight-text">2026-njy ÝYLDA AÇYLÝAR.</p>
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
