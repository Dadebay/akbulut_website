<!DOCTYPE html>
<html lang="tk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Garagum - Türkmen Aty</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Segoe UI', 'Arial', sans-serif;
            background: #000;
            color: #fff;
            overflow-x: hidden;
        }

        /* App Container */
        .app-container {
            max-width: 500px;
            margin: 0 auto;
            background: #000;
            position: relative;
        }

        /* Top Bar */
        .top-bar {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            max-width: 500px;
            width: 100%;
            z-index: 1000;
            background: linear-gradient(180deg, rgba(0,0,0,0.7) 0%, transparent 100%);
            padding: 20px 20px 40px;
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 3px;
            text-align: center;
            background: linear-gradient(135deg, #d4af37, #f0d478);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Video Section - Full Screen */
        .video-section {
            width: 100%;
            height: 100vh;
            position: relative;
            background: #000;
        }

        .video-container {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Info Overlay */
        .info-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(0deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 50%, transparent 100%);
            padding: 80px 25px 30px;
        }

        .horse-name {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 8px;
            color: #d4af37;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
            transition: opacity 0.3s ease;
        }

        .horse-breed {
            font-size: 18px;
            color: rgba(255,255,255,0.8);
            margin-bottom: 20px;
            font-weight: 500;
            transition: opacity 0.3s ease;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .info-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .info-label {
            font-size: 11px;
            color: #d4af37;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            transition: opacity 0.3s ease;
        }

        .description {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border-left: 3px solid #d4af37;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            line-height: 1.6;
            color: rgba(255,255,255,0.9);
            transition: opacity 0.3s ease;
        }

        /* Video Controls */
        .video-indicator {
            position: absolute;
            top: 90px;
            left: 20px;
            right: 20px;
            display: flex;
            gap: 8px;
            z-index: 999;
        }

        .indicator-bar {
            flex: 1;
            height: 3px;
            background: rgba(255,255,255,0.3);
            border-radius: 2px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: height 0.2s ease;
        }

        .indicator-bar:active {
            height: 4px;
        }

        .indicator-progress {
            height: 100%;
            background: #d4af37;
            width: 0%;
            transition: width 0.1s linear;
        }

        .indicator-bar.active .indicator-progress {
            animation: progress linear;
        }

        @keyframes progress {
            from { width: 0%; }
            to { width: 100%; }
        }

        /* Gallery Section */
        .gallery-section {
            padding: 30px 20px;
            background: #0a0a0a;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #d4af37;
            margin-bottom: 20px;
            text-align: center;
            letter-spacing: 2px;
        }

        .gallery-grid {
            column-count: 2;
            column-gap: 12px;
        }

        .gallery-item {
            break-inside: avoid;
            margin-bottom: 12px;
            overflow: hidden;
            border-radius: 12px;
            cursor: pointer;
            position: relative;
            background: #1a1a1a;
            display: inline-block;
            width: 100%;
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease;
        }

        .gallery-item:active {
            transform: scale(0.98);
        }

        .gallery-item:active img {
            transform: scale(1.1);
        }

        /* Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.98);
            justify-content: center;
            align-items: center;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox img {
            max-width: 95%;
            max-height: 95%;
            border-radius: 10px;
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
            border: none;
        }

        /* Additional Info Section */
        .info-section {
            padding: 30px 20px;
            background: #000;
        }

        .info-card-large {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .info-card-header {
            font-size: 18px;
            font-weight: 700;
            color: #d4af37;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-card-header::before {
            content: '◆';
            font-size: 12px;
        }

        .info-card-content {
            font-size: 15px;
            line-height: 1.7;
            color: rgba(255,255,255,0.85);
            transition: opacity 0.3s ease;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            transition: opacity 0.3s ease;
        }

        .feature-list li {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-list li::before {
            content: '✓';
            color: #d4af37;
            font-weight: bold;
            font-size: 16px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .stat-item {
            text-align: center;
            padding: 15px 10px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 10px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #d4af37;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        .stat-label {
            font-size: 11px;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Responsive */
        @media (min-width: 501px) {
            .app-container {
                box-shadow: 0 0 50px rgba(0,0,0,0.5);
            }
        }

        @media (max-width: 400px) {
            .horse-name {
                font-size: 28px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                column-count: 1;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="logo">TÜRKMEN ATY</div>
        </div>

        <!-- Video Section with Story Indicators -->
        <div class="video-section">
            <!-- Story-style indicators -->
            <div class="video-indicator">
                <div class="indicator-bar" id="indicator-1">
                    <div class="indicator-progress"></div>
                </div>
                <div class="indicator-bar" id="indicator-2">
                    <div class="indicator-progress"></div>
                </div>
                <div class="indicator-bar" id="indicator-3">
                    <div class="indicator-progress"></div>
                </div>
            </div>

            <!-- Video Container -->
            <div class="video-container">
                <video id="video-player" playsinline muted>
                    <source src="/images/horses/1.mp4" type="video/mp4">
                </video>
            </div>

            <!-- Info Overlay -->
            <div class="info-overlay">
                <div class="horse-name" id="horse-name">GARAGUM</div>
                <div class="horse-breed" id="horse-breed">Türkmen Bedewi</div>

                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-label">Doglan Senesi</div>
                        <div class="info-value" id="horse-birth">15.08.2018</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Boýy</div>
                        <div class="info-value" id="horse-height">165 SM</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Reňki</div>
                        <div class="info-value" id="horse-color">Gyzyl</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Statusy</div>
                        <div class="info-value" id="horse-status">Häsiýetli</div>
                    </div>
                </div>

                <div class="description" id="horse-description">
                    Garagum özboluşly daşky görnüşi we milli aýratynlyklary bilen tapawutlanýar. Ol Türkmen bedewleriniň arzuw atyçylyk häsiýetlerini özünde jemleýär.
                </div>
            </div>
        </div>

        <!-- Gallery Section -->
        <div class="gallery-section">
            <h2 class="section-title">SURAT GALEREÝASY</h2>
            <div class="gallery-grid">
                <div class="gallery-item" onclick="openLightbox('/images/horses/1.jpg')">
                    <img src="/images/horses/1.jpg" alt="Garagum 1">
                </div>
                <div class="gallery-item" onclick="openLightbox('/images/horses/2.jpg')">
                    <img src="/images/horses/2.jpg" alt="Garagum 2">
                </div>
                <div class="gallery-item" onclick="openLightbox('/images/horses/3.jpg')">
                    <img src="/images/horses/3.jpg" alt="Garagum 3">
                </div>
                <div class="gallery-item" onclick="openLightbox('/images/horses/4.jpg')">
                    <img src="/images/horses/4.jpg" alt="Garagum 4">
                </div>
                <div class="gallery-item" onclick="openLightbox('/images/horses/5.jpg')">
                    <img src="/images/horses/5.jpg" alt="Garagum 5">
                </div>
            </div>
        </div>

        <!-- Additional Info Section -->
        <div class="info-section">
            <div class="info-card-large">
                <div class="info-card-header">Häsiýetnama</div>
                <div class="info-card-content" id="horse-character">
                    Garagum asuda we dostlukly häsiýete eýe. Ol çalt öwrenýär we mugallymyna gowy gulak asýar. Ýokary derejeli tälim aldy we ýaryşlara taýýar.
                </div>
            </div>

            <div class="info-card-large">
                <div class="info-card-header">Başarnyklarý</div>
                <ul class="feature-list" id="horse-achievements">
                    <li>Milli ýaryşda 1-nji orun</li>
                    <li>200m aralygy 11.2 sekuntda geçýär</li>
                    <li>Ýokary tizlik we çydamlylyk</li>
                    <li>Professional türkmen bedewi</li>
                </ul>
            </div>

            <div class="info-card-large">
                <div class="info-card-header">Statistika</div>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-value" id="stat-speed">72</div>
                        <div class="stat-label">Tizlik km/s</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="stat-competitions">12</div>
                        <div class="stat-label">Ýaryşlar</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="stat-wins">8</div>
                        <div class="stat-label">Ýeňişler</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close">×</button>
        <img id="lightbox-img" src="" alt="">
    </div>

    <script>
        // Horse profiles data
        const horseProfiles = [
            {
                name: 'GARAGUM',
                breed: 'Türkmen Bedewi',
                birth: '15.08.2018',
                height: '165 SM',
                color: 'Gyzyl',
                status: 'Häsiýetli',
                description: 'Garagum özboluşly daşky görnüşi we milli aýratynlyklary bilen tapawutlanýar. Ol Türkmen bedewleriniň arzuw atyçylyk häsiýetlerini özünde jemleýär.',
                character: 'Garagum asuda we dostlukly häsiýete eýe. Ol çalt öwrenýär we mugallymyna gowy gulak asýar. Ýokary derejeli tälim aldy we ýaryşlara taýýar.',
                achievements: [
                    'Milli ýaryşda 1-nji orun',
                    '200m aralygy 11.2 sekuntda geçýär',
                    'Ýokary tizlik we çydamlylyk',
                    'Professional türkmen bedewi'
                ],
                stats: { speed: '72', competitions: '12', wins: '8' }
            },
            {
                name: 'ALTYN TARPAN',
                breed: 'Türkmen Bedewi',
                birth: '22.04.2019',
                height: '168 SM',
                color: 'Ak',
                status: 'Çempion',
                description: 'Altyn Tarpan ýiti zehinli we güýçli at. Onuň genetiki nesilnamasy iň gowy türkmen atlaryndan gelýär. Ýokary sypat we häsiýet.',
                character: 'Altyn Tarpan batyr we çyn häsiýetli at. Ol ýaryşlarda ajaýyp görkeziş görkezýär we hemişe ýeňiş gazanmaga çalyşýar.',
                achievements: [
                    'Halkara ýaryşda altyn medal',
                    '500m aralygy 27.8 sekuntda geçýär',
                    'Ýylyň iň gowy aty 2023',
                    'Çempionlyk derejesine eýe'
                ],
                stats: { speed: '78', competitions: '18', wins: '14' }
            },
            {
                name: 'ÝAŞYL GÖZÜM',
                breed: 'Türkmen Bedewi',
                birth: '10.11.2017',
                height: '162 SM',
                color: 'Gara',
                status: 'Tejribeli',
                description: 'Ýaşyl Gözüm tejribeli we akylly at. Köp ýyllaryň dowamynda ýaryşlarda şöhrat gazandy. Uly hormat we sarpa mynasyp at.',
                character: 'Sabyrsyzlyk we çydamlylyk onuň esasy häsiýeti. Ýaşyl Gözüm ähli şertlere çalt uýgunlaşýar we özboluşly şahsyýete eýe.',
                achievements: [
                    '5 ýyldan gowrak ýaryş tejribesi',
                    'Köp sanly ýeňiş we rekordlar',
                    'Döwlet baýraklary bilen sylaglanan',
                    'Nesil ýörediji hökmünde tanalýar'
                ],
                stats: { speed: '68', competitions: '24', wins: '16' }
            }
        ];

        // Video playlist
        const videos = [
            '/images/horses/1.mp4',
            '/images/horses/2.mp4',
            '/images/horses/3.mp4'
        ];

        let currentVideoIndex = 0;
        const videoPlayer = document.getElementById('video-player');
        const indicators = [
            document.getElementById('indicator-1'),
            document.getElementById('indicator-2'),
            document.getElementById('indicator-3')
        ];

        // Update UI with horse profile
        function updateHorseInfo(index) {
            const profile = horseProfiles[index];
            
            document.getElementById('horse-name').textContent = profile.name;
            document.getElementById('horse-breed').textContent = profile.breed;
            document.getElementById('horse-birth').textContent = profile.birth;
            document.getElementById('horse-height').textContent = profile.height;
            document.getElementById('horse-color').textContent = profile.color;
            document.getElementById('horse-status').textContent = profile.status;
            document.getElementById('horse-description').textContent = profile.description;
            document.getElementById('horse-character').textContent = profile.character;
            
            // Update achievements list
            const achievementsList = document.getElementById('horse-achievements');
            achievementsList.innerHTML = profile.achievements.map(a => `<li>${a}</li>`).join('');
            
            // Update stats
            document.getElementById('stat-speed').textContent = profile.stats.speed;
            document.getElementById('stat-competitions').textContent = profile.stats.competitions;
            document.getElementById('stat-wins').textContent = profile.stats.wins;
        }

        // Play video function
        function playVideo(index) {
            currentVideoIndex = index;
            videoPlayer.src = videos[index];
            
            // Update horse info
            updateHorseInfo(index);
            
            // Reset all indicators
            indicators.forEach((ind, i) => {
                ind.classList.remove('active');
                const progress = ind.querySelector('.indicator-progress');
                progress.style.width = '0%';
                progress.style.animation = 'none';
                if (i < index) {
                    progress.style.width = '100%';
                }
            });

            // Activate current indicator
            indicators[index].classList.add('active');
            const currentProgress = indicators[index].querySelector('.indicator-progress');
            
            // Load and play
            videoPlayer.load();
            videoPlayer.play().catch(err => {
                console.log('Autoplay prevented:', err);
            });

            // Animate progress bar
            videoPlayer.addEventListener('loadedmetadata', function() {
                const duration = videoPlayer.duration * 1000; // Convert to ms
                currentProgress.style.animation = `progress ${duration}ms linear`;
            }, { once: true });
        }

        // When video ends, play next
        videoPlayer.addEventListener('ended', function() {
            const nextIndex = (currentVideoIndex + 1) % videos.length;
            playVideo(nextIndex);
        });

        // Start playing first video when page loads
        window.addEventListener('load', function() {
            playVideo(0);
        });

        // Handle user interaction to enable unmuted playback
        document.addEventListener('click', function() {
            if (videoPlayer.muted) {
                videoPlayer.muted = false;
            }
        }, { once: true });

        // Swipe to change video
        let touchStartX = 0;
        let touchEndX = 0;
        const videoSection = document.querySelector('.video-section');

        videoSection.addEventListener('touchstart', function(e) {
            touchStartX = e.touches[0].clientX;
        }, { passive: true });

        videoSection.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].clientX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const swipeThreshold = 50; // Minimum distance for swipe
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swiped left - next video
                    const nextIndex = (currentVideoIndex + 1) % videos.length;
                    playVideo(nextIndex);
                } else {
                    // Swiped right - previous video
                    const prevIndex = (currentVideoIndex - 1 + videos.length) % videos.length;
                    playVideo(prevIndex);
                }
            }
        }

        // Click on indicator bars to jump to video
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', function() {
                playVideo(index);
            });
        });

        // Lightbox functions
        function openLightbox(src) {
            document.getElementById('lightbox').classList.add('active');
            document.getElementById('lightbox-img').src = src;
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
        }

        // Close lightbox with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
</body>
</html>
