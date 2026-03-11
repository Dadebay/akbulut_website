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

    .anniversary-page {
        background: linear-gradient(135deg, #0a0e1a 0%, #1a2332 50%, #0f1419 100%);
        min-height: 100vh;
        overflow-x: hidden;
        position: relative;
    }

    /* Animated Background */
    .anniversary-page::before {
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
    }

    @keyframes backgroundShift {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }

    /* Hero Section - Enhanced */
    .hero-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 800px;
        height: 800px;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.2) 0%, transparent 70%);
        animation: heroGlow 4s ease-in-out infinite;
    }

    @keyframes heroGlow {
        0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
        50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.6; }
    }

    .hero-content {
        text-align: center;
        z-index: 2;
        animation: heroEntrance 1.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
    }

    @keyframes heroEntrance {
        0% {
            opacity: 0;
            transform: translateY(100px) scale(0.8);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .hero-title {
        font-size: clamp(4rem, 15vw, 12rem);
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
        margin-bottom: 1rem;
        animation: shimmerGold 3s linear infinite, titleFloat 3s ease-in-out infinite;
        text-shadow: 0 0 80px rgba(255, 215, 0, 0.5);
        position: relative;
        filter: drop-shadow(0 0 30px rgba(255, 215, 0, 0.6));
    }

    @keyframes shimmerGold {
        0% { background-position: 0% center; }
        100% { background-position: 200% center; }
    }

    @keyframes titleFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .hero-subtitle {
        font-size: clamp(1.8rem, 5vw, 3.5rem);
        color: var(--text-light);
        margin-bottom: 2rem;
        opacity: 0;
        animation: fadeInScale 1s ease-out 0.5s forwards;
        text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        font-weight: 600;
        letter-spacing: 2px;
    }

    @keyframes fadeInScale {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .hero-year {
        font-size: clamp(1.2rem, 3vw, 2rem);
        color: var(--accent-color);
        opacity: 0;
        animation: fadeInUp 1s ease-out 1s forwards;
        font-weight: 700;
        letter-spacing: 4px;
    }

    /* Enhanced Particles - Stars and Circles Only */
    .particles {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        top: 0;
        left: 0;
        pointer-events: none;
    }

    .particle {
        position: absolute;
        animation: floatParticle 20s infinite;
    }

    /* Star Shape - Gold */
    .particle:nth-child(4n+1) {
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 8px solid var(--accent-color);
        position: relative;
        filter: drop-shadow(0 0 3px var(--accent-color));
    }
    
    .particle:nth-child(4n+1)::before {
        content: '';
        position: absolute;
        top: 3px;
        left: -5px;
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 8px solid var(--accent-color);
    }

    /* Star Shape - White */
    .particle:nth-child(4n+3) {
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 8px solid rgba(255, 255, 255, 0.9);
        position: relative;
        filter: drop-shadow(0 0 3px rgba(255, 255, 255, 0.6));
    }
    
    .particle:nth-child(4n+3)::before {
        content: '';
        position: absolute;
        top: 3px;
        left: -5px;
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 8px solid rgba(255, 255, 255, 0.9);
    }

    /* Circle Shape - Gold */
    .particle:nth-child(4n+2) {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: radial-gradient(circle, var(--accent-color) 0%, transparent 70%);
        filter: blur(1px);
    }

    /* Circle Shape - White */
    .particle:nth-child(4n) {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, transparent 70%);
        filter: blur(1px);
    }

    @keyframes floatParticle {
        0% {
            transform: translateY(100vh) translateX(0) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) translateX(100px) rotate(360deg);
            opacity: 0;
        }
    }

    /* Timeline Section - Dramatically Enhanced */
    .timeline-section {
        padding: 150px 0;
        position: relative;
    }

    .timeline-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
    }

    /* Animated Progress Line */
    .timeline-line {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 6px;
        height: 0;
        background: linear-gradient(180deg, 
            var(--primary-color) 0%, 
            var(--accent-color) 50%,
            var(--accent-glow) 100%);
        box-shadow: 0 0 20px var(--accent-color);
        animation: growLine 2s ease-out 0.5s forwards;
        border-radius: 3px;
    }

    @keyframes growLine {
        to {
            height: 100%;
        }
    }

    .timeline-line::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 20px;
        background: var(--accent-color);
        border-radius: 50%;
        box-shadow: 0 0 30px var(--accent-color);
        animation: pulse 2s infinite;
    }

    /* Timeline Items - 3D Effect */
    .timeline-item {
        display: flex;
        margin-bottom: 150px;
        position: relative;
        opacity: 0;
        transform: translateY(100px) rotateX(20deg);
        transition: all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        perspective: 1000px;
    }

    .timeline-item.visible {
        opacity: 1;
        transform: translateY(0) rotateX(0deg);
    }

    .timeline-item:nth-child(even) {
        flex-direction: row-reverse;
    }

    .timeline-content {
        flex: 1;
        padding: 0 60px;
    }

    /* Glassmorphism Cards with 3D Transform */
    .timeline-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px) saturate(180%);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 30px;
        padding: 50px;
        position: relative;
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        transform-style: preserve-3d;
        overflow: hidden;
    }

    .timeline-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .timeline-card:hover::before {
        opacity: 1;
        animation: rotateGradient 3s linear infinite;
    }

    @keyframes rotateGradient {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .timeline-card:hover {
        transform: translateY(-20px) scale(1.05) rotateY(5deg);
        background: rgba(255, 255, 255, 0.08);
        border-color: var(--accent-color);
        box-shadow: 
            0 30px 80px rgba(10, 82, 158, 0.4),
            0 0 60px rgba(255, 215, 0, 0.3),
            inset 0 0 60px rgba(255, 215, 0, 0.1);
    }

    /* Animated Year Number */
    .timeline-year {
        font-size: clamp(3rem, 6vw, 5rem);
        font-weight: 900;
        background: linear-gradient(135deg, 
            var(--accent-color) 0%, 
            var(--accent-glow) 50%,
            var(--primary-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
        animation: yearPulse 2s ease-in-out infinite;
    }

    @keyframes yearPulse {
        0%, 100% {
            transform: scale(1);
            filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.5));
        }
        50% {
            transform: scale(1.05);
            filter: drop-shadow(0 0 20px rgba(255, 215, 0, 0.8));
        }
    }

    .timeline-title {
        font-size: clamp(1.5rem, 3vw, 2.5rem);
        color: var(--text-light);
        margin-bottom: 1.5rem;
        font-weight: 700;
        position: relative;
        padding-left: 20px;
    }

    .timeline-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 0;
        background: var(--accent-color);
        transition: height 0.5s ease;
        border-radius: 3px;
    }

    .timeline-card:hover .timeline-title::before {
        height: 100%;
    }

    .timeline-description {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.2rem;
        line-height: 1.9;
        position: relative;
        z-index: 1;
    }

    /* Enhanced Timeline Dots */
    .timeline-dot {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-glow) 100%);
        border-radius: 50%;
        z-index: 10;
        box-shadow: 
            0 0 30px var(--accent-color),
            0 0 60px rgba(255, 215, 0, 0.5),
            inset 0 0 20px rgba(255, 255, 255, 0.5);
        animation: dotPulse 2s infinite, dotRotate 10s linear infinite;
    }

    @keyframes dotPulse {
        0%, 100% {
            transform: translateX(-50%) scale(1);
            box-shadow: 
                0 0 30px var(--accent-color),
                0 0 60px rgba(255, 215, 0, 0.5);
        }
        50% {
            transform: translateX(-50%) scale(1.3);
            box-shadow: 
                0 0 50px var(--accent-color),
                0 0 100px rgba(255, 215, 0, 0.8);
        }
    }

    @keyframes dotRotate {
        0% { filter: hue-rotate(0deg); }
        100% { filter: hue-rotate(360deg); }
    }

    /* Stats Section - Enhanced */
    .stats-section {
        padding: 150px 0;
        background: linear-gradient(135deg, rgba(10, 82, 158, 0.15) 0%, rgba(255, 215, 0, 0.05) 100%);
        position: relative;
        overflow: hidden;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 30% 50%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 70% 50%, rgba(10, 82, 158, 0.1) 0%, transparent 50%);
        animation: statsBackground 15s ease-in-out infinite;
    }

    @keyframes statsBackground {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(50px); }
    }

    .stat-card {
        text-align: center;
        padding: 50px 30px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 30px;
        margin-bottom: 30px;
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
        min-height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .stat-card:hover::before {
        left: 100%;
    }

    .stat-card:hover {
        transform: translateY(-20px) scale(1.05);
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--accent-color);
        box-shadow: 
            0 30px 80px rgba(10, 82, 158, 0.4),
            0 0 60px rgba(255, 215, 0, 0.3);
    }

    .stat-number {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 900;
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-glow) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1.2rem;
        filter: drop-shadow(0 0 20px rgba(255, 215, 0, 0.5));
        line-height: 1;
    }

    .stat-label {
        font-size: clamp(0.75rem, 1.8vw, 1.1rem);
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        line-height: 1.5;
        max-width: 100%;
        word-wrap: break-word;
        hyphens: auto;
    }

    /* General Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .timeline-line {
            left: 30px;
        }

        .timeline-item,
        .timeline-item:nth-child(even) {
            flex-direction: column;
        }

        .timeline-content {
            padding: 0 20px;
        }

        .timeline-dot {
            left: 30px;
        }

        .timeline-card {
            padding: 30px;
        }

        .stat-card {
            padding: 40px 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="anniversary-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="particles">
            @for ($i = 0; $i < 150; $i++)
                <div class="particle" style="left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 20) }}s;"></div>
            @endfor
        </div>
        
        <div class="hero-content">
            <h1 class="hero-title">10</h1>
            <h2 class="hero-subtitle">@lang('main.years_of_excellence')</h2>
            <p class="hero-year">2015 - 2025</p>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number counter" data-target="10">0</div>
                        <div class="stat-label">@lang('main.years_of_stability')</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number counter" data-target="500">0</div>
                        <div class="stat-label">@lang('main.employees')</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number counter" data-target="10">0</div>
                        <div class="stat-label">@lang('main.countries_in_export')</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number counter" data-target="150">0</div>
                        <div class="stat-label">@lang('main.products')</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline-section">
        <div class="container">
            <div class="timeline-container">
                <div class="timeline-line"></div>

                <!-- 2015 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-card">
                            <div class="timeline-year">2015</div>
                            <h3 class="timeline-title">@lang('main.company_founded')</h3>
                            <p class="timeline-description">
                                @lang('main.company_founded_desc')
                            </p>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <!-- 2016 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-card">
                            <div class="timeline-year">2016</div>
                            <h3 class="timeline-title">@lang('main.suspended_ceilings_factory')</h3>
                            <p class="timeline-description">
                                @lang('main.suspended_ceilings_factory_desc')
                            </p>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <!-- 2017 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-card">
                            <div class="timeline-year">2017</div>
                            <h3 class="timeline-title">@lang('main.production_capacity_expansion')</h3>
                            <p class="timeline-description">
                                @lang('main.production_capacity_expansion_desc')
                            </p>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <!-- 2018 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-card">
                            <div class="timeline-year">2018</div>
                            <h3 class="timeline-title">@lang('main.new_production_line')</h3>
                            <p class="timeline-description">
                                @lang('main.new_production_line_desc')
                            </p>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <!-- 2019 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-card">
                            <div class="timeline-year">2019</div>
                            <h3 class="timeline-title">@lang('main.international_expansion')</h3>
                            <p class="timeline-description">
                                @lang('main.international_expansion_desc')
                            </p>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <!-- 2020 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-card">
                            <div class="timeline-year">2020</div>
                            <h3 class="timeline-title">@lang('main.export_covid')</h3>
                            <p class="timeline-description">
                                @lang('main.export_covid_desc')
                            </p>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <!-- 2023 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-card">
                            <div class="timeline-year">2023</div>
                            <h3 class="timeline-title">@lang('main.new_factory_plasterboard')</h3>
                            <p class="timeline-description">
                                @lang('main.new_factory_plasterboard_desc')
                            </p>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <!-- 2024 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-card">
                            <div class="timeline-year">2024</div>
                            <h3 class="timeline-title">@lang('main.new_export_countries')</h3>
                            <p class="timeline-description">
                                @lang('main.new_export_countries_desc')
                            </p>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <!-- 2025 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-card">
                            <div class="timeline-year">2025</div>
                            <h3 class="timeline-title">@lang('main.anniversary_milestone')</h3>
                            <p class="timeline-description">
                                @lang('main.anniversary_milestone_desc')
                            </p>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

            </div>
        </div>
    </section>
</div>

@include('inc.footer')
@endsection

@section('js')
<script>
    // Counter Animation
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                element.textContent = target + '+';
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    }

    // Intersection Observer for Timeline Items
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe timeline items
    document.querySelectorAll('.timeline-item').forEach(item => {
        observer.observe(item);
    });

    // Animate counters when stats section is visible
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                document.querySelectorAll('.counter').forEach(counter => {
                    animateCounter(counter);
                });
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }

    // Parallax effect for hero section
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const heroContent = document.querySelector('.hero-content');
        if (heroContent) {
            heroContent.style.transform = `translateY(${scrolled * 0.5}px)`;
            heroContent.style.opacity = 1 - (scrolled / 500);
        }
    });
</script>
@endsection
