<!DOCTYPE html>
<html lang="tk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Garagum - Türkmen Atynyň Profili</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Arial', sans-serif;
            background: #000;
            color: #fff;
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* App Container */
        .app-container {
            max-width: 480px;
            margin: 0 auto;
            background: #000;
            min-height: 100vh;
            position: relative;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, transparent 100%);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 2px;
            background: linear-gradient(135deg, #d4af37, #f0d478);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin: 40px 0;
        }

        .left-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .hero-image {
            width: 100%;
            height: 600px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(212, 175, 55, 0.3);
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .hero-image:hover img {
            transform: scale(1.05);
        }

        /* Right Section - Horse Info */
        .right-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .horse-title {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #d4af37;
            letter-spacing: 2px;
        }

        .horse-subtitle {
            font-size: 24px;
            color: #999;
            margin-bottom: 30px;
        }

        .info-box {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 20px;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .info-label {
            color: #d4af37;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-value {
            color: #fff;
        }

        .description {
            background: rgba(255, 255, 255, 0.05);
            border-left: 3px solid #d4af37;
            padding: 25px;
            margin-top: 30px;
            border-radius: 5px;
            line-height: 1.8;
            font-size: 16px;
            color: #ccc;
        }

        .quote {
            font-style: italic;
            color: #d4af37;
            font-size: 18px;
            margin-top: 20px;
            padding: 20px;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        /* Gallery Section */
        .gallery-section {
            margin: 60px 0;
        }

        .section-title {
            font-size: 32px;
            color: #d4af37;
            margin-bottom: 30px;
            text-align: center;
            letter-spacing: 2px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            height: 300px;
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
            position: relative;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 40px rgba(212, 175, 55, 0.4);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* Video Section */
        .video-section {
            margin: 60px 0;
            text-align: center;
        }

        .video-container {
            max-width: 500px;
            margin: 0 auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 50px rgba(212, 175, 55, 0.3);
        }

        .video-container video {
            width: 100%;
            height: 700px;
            display: block;
            object-fit: cover;
        }

        /* Mobile Responsive */
        @media (max-width: 968px) {
            .main-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .hero-image {
                height: 400px;
            }

            .horse-title {
                font-size: 36px;
            }

            .horse-subtitle {
                font-size: 20px;
            }

            .info-row {
                grid-template-columns: 100px 1fr;
                font-size: 16px;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 15px;
            }

            .gallery-item {
                height: 250px;
            }

            .logo {
                font-size: 36px;
            }

            .video-container video {
                height: 600px;
            }
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .header {
                padding: 20px 10px;
            }

            .logo {
                font-size: 28px;
            }

            .horse-title {
                font-size: 28px;
            }

            .horse-subtitle {
                font-size: 18px;
            }

            .info-box {
                padding: 20px;
            }

            .info-row {
                grid-template-columns: 1fr;
                gap: 5px;
                margin-bottom: 15px;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .gallery-item {
                height: 300px;
            }

            .section-title {
                font-size: 24px;
            }

            .video-container {
                max-width: 100%;
            }

            .video-container video {
                height: 500px;
            }
        }

        /* Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            justify-content: center;
            align-items: center;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }

        .lightbox-close {
            position: absolute;
            top: 30px;
            right: 50px;
            font-size: 40px;
            color: #fff;
            cursor: pointer;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">TÜRKMEN ATY</div>
    </div>

    <div class="container">
        <div class="main-content">
            <!-- Left Section - Hero Image -->
            <div class="left-section">
                <div class="hero-image">
                    <img src="/images/horses/1.jpg" alt="Garagum">
                </div>
            </div>

            <!-- Right Section - Horse Information -->
            <div class="right-section">
                <h1 class="horse-title">GARAGUM</h1>
                <p class="horse-subtitle">Türkmen Bedewi</p>

                <div class="info-box">
                    <div class="info-row">
                        <span class="info-label">Ady</span>
                        <span class="info-value">Garagum</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Doglan senesi</span>
                        <span class="info-value">15.08.2018</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Boýy</span>
                        <span class="info-value">165 SM</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Reňki</span>
                        <span class="info-value">Gyzyl</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Statusy</span>
                        <span class="info-value">Häsiýetli Bedew</span>
                    </div>
                </div>

                <div class="description">
                    Garagum özboluşly daşky görnüşi we milli aýratynlyklary bilen tapawutlanýar. Ol Türkmen bedewleriniň arzuw atyçylyk häsiýetlerini özünde jemleýär. Onuň nesli meşhur türkmen bedewlerinden gelip çykýar we ajaýyp tizligi, çydamlylygy bilen tanalýar.
                    
                    <div class="quote">
                        "Garagum millî baýramçylyklarda we ýaryşlarda ajaýyp netijeler görkezdi. Ol türkmen bedewiniň gözelligini we güýjüni görkezýär!"
                    </div>
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

        <!-- Video Section -->
        <div class="video-section">
            <h2 class="section-title">WIDEO GÖRKEZIŞ</h2>
            <div class="video-container">
                <video controls>
                    <source src="/images/akbulut.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <span class="lightbox-close">&times;</span>
        <img id="lightbox-img" src="" alt="">
    </div>

    <script>
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
