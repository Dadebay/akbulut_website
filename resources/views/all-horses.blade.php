<!DOCTYPE html>
<html lang="tk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Garagum - All Horses</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        :root {
            --bg: #030303;
            --gold: #d4af37;
            --gold-soft: rgba(212, 175, 55, 0.35);
            --gold-glow: rgba(212, 175, 55, 0.22);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
            background: radial-gradient(circle at top, #0d0d0d 0%, #030303 45%, #000 100%);
            color: #fff;
            min-height: 100vh;
            padding: 34px 28px;
        }

        .app-container {
            max-width: 1680px;
            margin: 0 auto;
        }

        .horses-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 28px;
        }

        .horse-link {
            text-decoration: none;
            color: inherit;
        }

        .horse-card {
            position: relative;
            overflow: hidden;
            border-radius: 22px;
            aspect-ratio: 1 / 1;
            border: 2px solid var(--gold-soft);
            box-shadow:
                0 16px 36px rgba(0, 0, 0, 0.8),
                0 0 56px var(--gold-glow),
                inset 0 0 0 1px rgba(255, 255, 255, 0.06);
            isolation: isolate;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .horse-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.82) 85%);
            z-index: 1;
        }

        .horse-card:hover {
            transform: translateY(-6px);
            border-color: rgba(212, 175, 55, 0.7);
            box-shadow:
                0 24px 44px rgba(0, 0, 0, 0.92),
                0 0 76px rgba(212, 175, 55, 0.36),
                inset 0 0 0 1px rgba(212, 175, 55, 0.4);
        }

        .horse-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .horse-info {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
            padding: 22px;
        }

        .horse-name {
            font-size: 24px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: 0.3px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.9);
            margin-bottom: 6px;
        }

        .horse-breed {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.88);
            font-weight: 500;
        }

        @media (max-width: 1280px) {
            .horses-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 820px) {
            body {
                padding: 20px 14px;
            }

            .horses-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }

            .horse-info {
                padding: 14px;
            }

            .horse-name {
                font-size: 18px;
            }

            .horse-breed {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
<div class="app-container">
    <div class="horses-grid">
        @foreach($horses as $horse)
        <a href="{{ route('horse.desktop', $horse['id']) }}" class="horse-link">
            <article class="horse-card">
                <img src="{{ asset('images/all_horses/' . $horse['image']) }}" alt="{{ $horse['name'] }}" class="horse-image">
                <div class="horse-info">
                    <h2 class="horse-name">{{ $horse['name'] }}</h2>
                    <p class="horse-breed">{{ $horse['breed'] }}</p>
                </div>
            </article>
        </a>
        @endforeach
    </div>
</div>
</body>
</html>
