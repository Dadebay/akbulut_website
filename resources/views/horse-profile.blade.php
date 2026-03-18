<!DOCTYPE html>
<html lang="tk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $horse['name'] }} - Horse Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        :root {
            --bg: #000;
            --panel: #0a0a0a;
            --gold: #d4af37;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
            background: radial-gradient(circle at top right, #131313 0%, #050505 45%, #000 100%);
            color: #fff;
            overflow: hidden;
        }

        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 50;
            text-decoration: none;
            background: rgba(212, 175, 55, 0.95);
            color: #000;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.4);
        }

        .profile-layout {
            height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .left-pane {
            padding: 80px 42px 36px;
            overflow-y: auto;
            border-right: 1px solid rgba(212, 175, 55, 0.15);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0));
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .left-pane::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }

        .horse-photo {
            width: 100%;
            aspect-ratio: 16/10;
            border-radius: 20px;
            object-fit: cover;
            cursor: pointer;
            border: 1px solid rgba(212, 175, 55, 0.32);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.74), 0 0 50px rgba(212, 175, 55, 0.2);
        }

        .photo-caption {
            margin-top: 10px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.72);
        }

        .title {
            margin-top: 24px;
            font-size: clamp(34px, 5vw, 58px);
            color: var(--gold);
            line-height: 1.05;
            font-weight: 900;
            letter-spacing: 0.6px;
        }

        .subtitle {
            margin-top: 8px;
            font-size: 20px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
        }

        .meta {
            margin-top: 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .meta-item {
            border: 1px solid rgba(212, 175, 55, 0.32);
            background: rgba(212, 175, 55, 0.09);
            color: rgba(255, 255, 255, 0.92);
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .story-title {
            margin-top: 26px;
            font-size: 15px;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 700;
        }

        .story-text {
            margin-top: 12px;
            font-size: clamp(17px, 2.1vw, 22px);
            line-height: 1.85;
            color: rgba(255, 255, 255, 0.93);
            max-width: 95%;
            padding-bottom: 30px;
        }

        .right-pane {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
        }

        .video-circle {
            width: min(70vh, 680px);
            height: min(70vh, 680px);
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            border: 3px solid rgba(212, 175, 55, 0.45);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.85), 0 0 90px rgba(212, 175, 55, 0.3);
        }

        .video-circle video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .play-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.28);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .play-btn {
            width: 86px;
            height: 86px;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.95);
            position: relative;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.45);
        }

        .play-btn::before {
            content: "";
            position: absolute;
            left: 34px;
            top: 26px;
            border-left: 25px solid #000;
            border-top: 16px solid transparent;
            border-bottom: 16px solid transparent;
        }

        .carousel-modal,
        .video-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 999;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.95);
        }

        .carousel-modal.active,
        .video-modal.active {
            display: flex;
        }

        .close-btn {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 1001;
            width: 52px;
            height: 52px;
            border: none;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.95);
            color: #000;
            font-size: 28px;
            font-weight: 700;
            cursor: pointer;
        }

        .carousel-wrap {
            width: min(92vw, 1280px);
            position: relative;
        }

        .carousel-image {
            width: 100%;
            max-height: 82vh;
            object-fit: contain;
            border-radius: 14px;
            border: 1px solid rgba(212, 175, 55, 0.35);
        }

        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 54px;
            height: 54px;
            border: none;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.95);
            color: #000;
            font-size: 26px;
            font-weight: 700;
            cursor: pointer;
        }

        .nav-prev { left: 12px; }
        .nav-next { right: 12px; }

        .video-modal .video-circle {
            width: min(78vh, 820px);
            height: min(78vh, 820px);
        }

        @media (max-width: 1100px) {
            body {
                overflow: auto;
            }

            .profile-layout {
                height: auto;
                min-height: 100vh;
                grid-template-columns: 1fr;
            }

            .left-pane {
                border-right: none;
                padding: 78px 20px 20px;
            }

            .right-pane {
                padding: 10px 0 28px;
            }

            .video-circle {
                width: min(80vw, 420px);
                height: min(80vw, 420px);
            }

            .story-text {
                max-width: 100%;
                font-size: 17px;
            }
        }
    </style>
</head>
<body>
    <a href="{{ route('horses.all') }}" class="back-button">← Yza</a>

    <div class="profile-layout">
        <section class="left-pane">
            <img class="horse-photo" src="{{ asset('images/all_horses/' . $horse['image']) }}" alt="{{ $horse['name'] }}" onclick="openCarousel()">
            <p class="photo-caption">Surata bas: galereya acylýar</p>

            <h1 class="title">{{ $horse['name'] }}</h1>
            <p class="subtitle">{{ $horse['breed'] }}</p>

            <div class="meta">
                <span class="meta-item">Boy: {{ $horse['height'] }} sm</span>
                <span class="meta-item">Yas: {{ $horse['age'] }}</span>
                <span class="meta-item">Renk: {{ $horse['color'] }}</span>
                <span class="meta-item">Cinsiyet: {{ $horse['gender'] }}</span>
            </div>

            <h2 class="story-title">Dusundiris</h2>
            <p class="story-text">{{ $horse['description'] }}</p>
        </section>

        <section class="right-pane">
            <div class="video-circle" onclick="openVideoModal()">
                <video autoplay muted loop playsinline>
                    <source src="{{ asset('images/horses/1.mp4') }}" type="video/mp4">
                </video>
                <div class="play-overlay">
                    <div class="play-btn"></div>
                </div>
            </div>
        </section>
    </div>

    <div class="carousel-modal" id="carouselModal" onclick="closeCarouselByBackdrop(event)">
        <button class="close-btn" type="button" onclick="closeCarousel()">×</button>
        <div class="carousel-wrap">
            <img id="carouselImage" class="carousel-image" src="" alt="Horse image">
            <button class="nav-btn nav-prev" type="button" onclick="prevImage()">‹</button>
            <button class="nav-btn nav-next" type="button" onclick="nextImage()">›</button>
        </div>
    </div>

    <div class="video-modal" id="videoModal" onclick="closeVideoByBackdrop(event)">
        <button class="close-btn" type="button" onclick="closeVideoModal()">×</button>
        <div class="video-circle" onclick="event.stopPropagation()">
            <video id="fullscreenVideo" controls>
                <source src="{{ asset('images/horses/1.mp4') }}" type="video/mp4">
            </video>
        </div>
    </div>

    <script>
        const images = @json(array_map(fn($img) => asset('images/all_horses/' . $img), $horse['images']));
        let currentImageIndex = 0;

        function openCarousel() {
            currentImageIndex = 0;
            document.getElementById('carouselImage').src = images[currentImageIndex];
            document.getElementById('carouselModal').classList.add('active');
        }

        function closeCarousel() {
            document.getElementById('carouselModal').classList.remove('active');
        }

        function closeCarouselByBackdrop(e) {
            if (e.target.id === 'carouselModal') {
                closeCarousel();
            }
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            document.getElementById('carouselImage').src = images[currentImageIndex];
        }

        function prevImage() {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            document.getElementById('carouselImage').src = images[currentImageIndex];
        }

        function openVideoModal() {
            const modal = document.getElementById('videoModal');
            const player = document.getElementById('fullscreenVideo');
            modal.classList.add('active');
            player.play();
        }

        function closeVideoModal() {
            const modal = document.getElementById('videoModal');
            const player = document.getElementById('fullscreenVideo');
            player.pause();
            player.currentTime = 0;
            modal.classList.remove('active');
        }

        function closeVideoByBackdrop(e) {
            if (e.target.id === 'videoModal') {
                closeVideoModal();
            }
        }

        document.addEventListener('keydown', function(e) {
            const isCarouselOpen = document.getElementById('carouselModal').classList.contains('active');
            const isVideoOpen = document.getElementById('videoModal').classList.contains('active');

            if (e.key === 'Escape') {
                if (isCarouselOpen) closeCarousel();
                if (isVideoOpen) closeVideoModal();
            }

            if (isCarouselOpen && e.key === 'ArrowRight') nextImage();
            if (isCarouselOpen && e.key === 'ArrowLeft') prevImage();
        });
    </script>
</body>
</html>
