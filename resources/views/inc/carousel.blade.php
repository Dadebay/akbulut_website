{{-- ═══════════════ MODERN HERO BANNER ═══════════════ --}}
<section class="hero-root" id="heroRoot">

    {{-- slides wrapper --}}
    <div class="hero-track" id="heroTrack">
        @foreach ($sliders ?? [] as $slider)
        @php
            $slider = is_array($slider) ? (object)$slider : $slider;
            $backendPhoto = $slider->photo ?? '';
            $isStaticImage = false;

            if (str_contains($backendPhoto, 'home_sliders/770')) {
                if (LaravelLocalization::getCurrentLocale() == 'ru') {
                    $sliderPhoto = asset('images/akbulut_ru.png');
                    $isStaticImage = true;
                } elseif (LaravelLocalization::getCurrentLocale() == 'en') {
                    $sliderPhoto = asset('images/akbulut_en.png');
                    $isStaticImage = true;
                } else {
                    $sliderPhoto = $backendPhoto ?: asset('images/akbulut_tk.png');
                }
            } else {
                $sliderPhoto = $backendPhoto ?: asset('images/placeholder.jpg');
            }

            $sliderCaption = $slider->caption ?? '';
        @endphp
        @if($sliderPhoto)
        <div class="hero-slide {{ $loop->first ? 'is-active' : '' }}" data-index="{{ $loop->index }}">
            @if($isStaticImage)
                <div class="hero-slide__bg hero-slide__bg--contain" style="background-image:url('{{ $sliderPhoto }}')"></div>
            @else
                <div class="hero-slide__bg" style="background-image:url('{{ $sliderPhoto }}')"></div>
            @endif
            <div class="hero-slide__overlay"></div>
            @if($sliderCaption)
            <div class="hero-slide__caption">
                <span>{{ $sliderCaption }}</span>
            </div>
            @endif
        </div>
        @endif
        @endforeach
    </div>

    {{-- bottom controls bar --}}
    <div class="hero-bar">
        {{-- dots --}}
        <div class="hero-dots" id="heroDots">
            @foreach ($sliders ?? [] as $slider)
            @php $slider = is_array($slider) ? (object)$slider : $slider; $photo = $slider->photo ?? ''; @endphp
            @if($photo || true)
            <button class="hero-dot {{ $loop->first ? 'is-active' : '' }}" data-dot="{{ $loop->index }}" aria-label="Slide {{ $loop->index + 1 }}"></button>
            @endif
            @endforeach
        </div>

        {{-- counter --}}
        <div class="hero-counter">
            <span id="heroCurrent">01</span>
            <span class="hero-counter__sep"></span>
            <span id="heroTotal">0{{ count($sliders ?? []) }}</span>
        </div>

        {{-- arrows --}}
        <div class="hero-arrows">
            <button class="hero-arrow hero-arrow--prev" id="heroPrev" aria-label="Previous">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M12 5l-5 5 5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button class="hero-arrow hero-arrow--next" id="heroNext" aria-label="Next">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M8 5l5 5-5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
    </div>

    {{-- progress bar --}}
    <div class="hero-progress"><div class="hero-progress__fill" id="heroProgress"></div></div>

</section>

<style>
/* ══════════ HERO BANNER ══════════ */
.hero-root {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #0d1f3c;
    /* aspect ratio kept via padding trick for all screens */
    aspect-ratio: 16 / 7.2;
}

@media (max-width: 991px)  { .hero-root { aspect-ratio: 16 / 9;  } }
@media (max-width: 640px)  { .hero-root { aspect-ratio: 4 / 3;   } }

/* track */
.hero-track {
    position: absolute;
    inset: 0;
}

/* single slide */
.hero-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
}
.hero-slide.is-active {
    opacity: 1;
    pointer-events: auto;
}

/* background image */
.hero-slide__bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    transform: scale(1.04);
    transition: transform 6s ease;
}
.hero-slide.is-active .hero-slide__bg {
    transform: scale(1);
}

/* static/logo slide — contained, white bg */
.hero-slide__bg--contain {
    background-size: contain;
    background-repeat: no-repeat;
    background-color: #fff;
}

/* dark gradient overlay (only for full photo slides) */
.hero-slide__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        rgba(5,20,55,0.08) 0%,
        rgba(5,20,55,0.32) 60%,
        rgba(5,20,55,0.68) 100%
    );
}
.hero-slide__bg--contain ~ .hero-slide__overlay {
    opacity: 0; /* no dark overlay on logo/white slides */
}

/* caption */
.hero-slide__caption {
    position: absolute;
    bottom: 72px;
    left: 48px;
    right: 48px;
    z-index: 2;
}
.hero-slide__caption span {
    display: inline-block;
    background: rgba(10,82,158,0.80);
    backdrop-filter: blur(6px);
    color: #fff;
    font-size: clamp(0.85rem, 2vw, 1.15rem);
    font-weight: 700;
    padding: 10px 22px;
    border-radius: 10px;
    max-width: 600px;
    line-height: 1.4;
}

/* ── Bottom controls bar ── */
.hero-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 24px 18px;
    gap: 16px;
}

/* dots */
.hero-dots {
    display: flex;
    align-items: center;
    gap: 7px;
    flex: 1;
}
.hero-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,0.40);
    border: none;
    padding: 0;
    cursor: pointer;
    transition: width 0.3s ease, background 0.3s ease, border-radius 0.3s ease;
}
.hero-dot.is-active {
    width: 26px;
    border-radius: 4px;
    background: #fff;
}

/* counter */
.hero-counter {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.82rem;
    font-weight: 700;
    color: rgba(255,255,255,0.85);
    letter-spacing: 0.04em;
    white-space: nowrap;
}
.hero-counter__sep {
    width: 28px;
    height: 1.5px;
    background: rgba(255,255,255,0.45);
    border-radius: 2px;
    display: inline-block;
}

/* arrows */
.hero-arrows {
    display: flex;
    align-items: center;
    gap: 8px;
}
.hero-arrow {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1.5px solid rgba(255,255,255,0.35);
    background: rgba(255,255,255,0.10);
    backdrop-filter: blur(6px);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
}
.hero-arrow:hover {
    background: rgba(255,255,255,0.25);
    border-color: rgba(255,255,255,0.70);
    transform: scale(1.08);
}
.hero-arrow:active { transform: scale(0.95); }

/* on white/logo slides make controls dark */
.hero-root.hero-root--light .hero-dot        { background: rgba(10,40,100,0.25); }
.hero-root.hero-root--light .hero-dot.is-active { background: #0a529e; }
.hero-root.hero-root--light .hero-counter    { color: rgba(10,40,100,0.75); }
.hero-root.hero-root--light .hero-counter__sep { background: rgba(10,40,100,0.30); }
.hero-root.hero-root--light .hero-arrow {
    border-color: rgba(10,40,100,0.25);
    background: rgba(10,40,100,0.07);
    color: #0a529e;
}
.hero-root.hero-root--light .hero-arrow:hover {
    background: rgba(10,40,100,0.14);
    border-color: rgba(10,40,100,0.50);
}
.hero-root.hero-root--light .hero-progress__fill { background: #0a529e; }

/* progress bar */
.hero-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: rgba(255,255,255,0.15);
    z-index: 11;
}
.hero-progress__fill {
    height: 100%;
    width: 0%;
    background: #fff;
    transition: width linear;
}

/* responsive */
@media (max-width: 575px) {
    .hero-slide__caption { left: 16px; right: 16px; bottom: 64px; }
    .hero-bar { padding: 0 12px 14px; gap: 10px; }
    .hero-arrow { width: 34px; height: 34px; }
    .hero-counter { display: none; }
}
</style>

<script>
(function () {
    var INTERVAL = 5000;
    var timer, progressAnim;
    var root     = document.getElementById('heroRoot');
    var slides   = root ? root.querySelectorAll('.hero-slide') : [];
    var dots     = root ? root.querySelectorAll('.hero-dot')   : [];
    var fill     = document.getElementById('heroProgress');
    var cur      = document.getElementById('heroCurrent');
    var total    = document.getElementById('heroTotal');
    var current  = 0;

    if (!slides.length) return;

    // pad zeros
    function pad(n) { return n < 10 ? '0' + n : '' + n; }

    function isLight(index) {
        var slide = slides[index];
        if (!slide) return false;
        var bg = slide.querySelector('.hero-slide__bg');
        return bg && bg.classList.contains('hero-slide__bg--contain');
    }

    function goTo(index) {
        slides[current].classList.remove('is-active');
        dots[current] && dots[current].classList.remove('is-active');

        current = (index + slides.length) % slides.length;

        slides[current].classList.add('is-active');
        dots[current]  && dots[current].classList.add('is-active');

        if (cur) cur.textContent = pad(current + 1);

        // light/dark mode for controls
        if (isLight(current)) {
            root.classList.add('hero-root--light');
        } else {
            root.classList.remove('hero-root--light');
        }

        startProgress();
    }

    function startProgress() {
        if (fill) {
            fill.style.transition = 'none';
            fill.style.width = '0%';
            // force reflow
            fill.getBoundingClientRect();
            fill.style.transition = 'width ' + INTERVAL + 'ms linear';
            fill.style.width = '100%';
        }
        clearInterval(timer);
        timer = setInterval(function () { goTo(current + 1); }, INTERVAL);
    }

    // dots
    dots.forEach(function(dot, idx) {
        dot.addEventListener('click', function() { goTo(idx); });
    });

    // arrows
    var prev = document.getElementById('heroPrev');
    var next = document.getElementById('heroNext');
    if (prev) prev.addEventListener('click', function() { goTo(current - 1); });
    if (next) next.addEventListener('click', function() { goTo(current + 1); });

    // total count
    if (total) total.textContent = pad(slides.length);

    // initial
    if (isLight(0)) root.classList.add('hero-root--light');
    startProgress();

    // pause on hover
    root.addEventListener('mouseenter', function() {
        clearInterval(timer);
        if (fill) { fill.style.transition = 'none'; }
    });
    root.addEventListener('mouseleave', function() { startProgress(); });
})();
</script>
