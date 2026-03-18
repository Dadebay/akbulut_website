@extends('layouts.site')

@section('css')
<style>
    .about-shell {
        min-height: 100vh;
        padding: 40px 0 80px;
    }
    .about-hero {
        background: radial-gradient(circle at top left, rgba(10,82,158,0.15), rgba(10,82,158,0));
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 32px;
        padding: 40px;
        position: relative;
        overflow: hidden;
    }
    .about-hero::after {
        content: "";
        position: absolute;
        inset: 20px;
        border-radius: 28px;
        border: 1px solid rgba(255,255,255,0.06);
        pointer-events: none;
    }
    .about-hero h1 {
        font-size: clamp(32px, 4vw, 52px);
        font-weight: 700;
        color: #0a529e;
    }
    .hero-summary {
        font-size: 18px;
        line-height: 1.7;
        color: rgba(0,0,0,0.72);
        max-width: 640px;
    }
    .breadcrumb-modern {
        display: flex;
        gap: 8px;
        font-size: 13px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: rgba(0,0,0,0.6);
        margin-bottom: 24px;
    }
    .breadcrumb-modern a {
        color: #0a529e;
        text-decoration: none;
        font-weight: 600;
    }
    .doc-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
        margin-top: 32px;
    }
    .doc-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 18px 24px;
        border-radius: 22px;
        background: #fff;
        border: 1px solid rgba(10,82,158,0.12);
        box-shadow: 0 15px 40px rgba(10,82,158,0.08);
        text-decoration: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .doc-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 45px rgba(10,82,158,0.12);
    }
    .doc-file {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }
    .doc-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: linear-gradient(135deg, #ff6a00, #ffa63f);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 18px;
        box-shadow: 0 12px 25px rgba(255,106,0,0.35);
    }
    .doc-download-btn {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #f0f2f5;
        color: #4a5568;
        transition: background 0.22s ease, color 0.22s ease, transform 0.22s ease;
    }
    .doc-download-btn svg {
        flex-shrink: 0;
        transition: transform 0.22s ease;
    }
    .doc-card:hover .doc-download-btn {
        background: #dde1e8;
        color: #1a202c;
    }
    .doc-card:hover .doc-download-btn svg {
        transform: translateY(2px);
    }
    .doc-title {
        font-size: 16px;
        font-weight: 600;
        color: #0a0a0a;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    @media (max-width: 576px) {
        .doc-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
    }
    .about-panels {
        margin-top: 48px;
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(280px, 340px);
        gap: 30px;
        align-items: start;
    }
    .about-body {
        background: #fff;
        border-radius: 28px;
        padding: 36px;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 30px 70px rgba(0,0,0,0.07);
        line-height: 1.9;
        color: rgba(0,0,0,0.78);
    }
    .about-body ul {
        margin: 1.5rem 0 1rem 1.2rem;
    }
    .right-sidebar {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    /* Sidebar timeline (ru/en) */
    .sidebar-timeline {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    /* Full-width timeline below body (tk) */
    .about-timeline-section {
        margin-top: 30px;
        margin-bottom: 20px;
    }
    .about-timeline-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 16px;
    }
    .insight-card {
        border-radius: 22px;
        background: linear-gradient(180deg, #0a529e, #04264c);
        color: #fff;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        box-shadow: 0 20px 50px rgba(10,82,158,0.35);
    }
    .insight-card h3 {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .insight-card > p {
        font-size: 12px;
        line-height: 1.5;
        opacity: 0.85;
        margin: 0;
    }
    .insight-meta {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .meta-pill {
        background: rgba(255,255,255,0.10);
        border-radius: 14px;
        padding: 12px;
    }
    .meta-value {
        font-size: 20px;
        font-weight: 700;
        display: block;
    }
    .meta-pill small {
        font-size: 11px;
        opacity: 0.8;
    }
    .timeline-card {
        border-radius: 16px;
        padding: 16px 18px;
        background: #f7fbff;
        border: 1px solid rgba(10,82,158,0.12);
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .timeline-year {
        font-size: 13px;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #0a529e;
        font-weight: 700;
    }
    .timeline-title {
        font-size: 15px;
        font-weight: 600;
        color: #0a0a0a;
    }
    .timeline-desc {
        font-size: 13px;
        color: rgba(0,0,0,0.65);
        line-height: 1.5;
    }
    @media (max-width: 992px) {
        .about-panels {
            grid-template-columns: 1fr;
        }
        .about-hero {
            padding: 30px;
        }
    }
</style>
@endsection

@section('content')
    @php
        $aboutUs = is_array($aboutUs) ? (object) $aboutUs : $aboutUs;
        $aboutBody = $aboutUs->body ?? '';
        $summary = \Illuminate\Support\Str::limit(strip_tags($aboutBody), 240);
        $yearsOnMarket = 10;
        $docMap = [
            'en' => 'files/akbulut_barada_en.pdf',
            'ru' => 'files/akbulut_barada_ru.pdf',
            'tk' => 'files/akbulut_barada_tm.pdf',
        ];
        $locale = app()->getLocale();
        $primaryDoc = $docMap[$locale] ?? null;
        $documents = [];
        if ($primaryDoc) {
            $documents[] = [
                'title' => trans('main.aboutAkbulut'),
                'href' => asset($primaryDoc),
            ];
        }
        $documents[] = [
            'title' => trans('main.iso_certificate'),
            'href' => asset('files/iso.pdf'),
        ];
        $documents[] = [
            'title' => trans('main.appendix'),
            'href' => asset('files/appendix.pdf'),
        ];
        $timeline = [
            ['year' => '2015', 'title' => trans('main.company_founded'), 'desc' => trans('main.company_founded_desc')],
            ['year' => '2017', 'title' => trans('main.suspended_ceilings_factory'), 'desc' => trans('main.suspended_ceilings_factory_desc')],
            ['year' => '2019', 'title' => trans('main.production_capacity_expansion'), 'desc' => trans('main.production_capacity_expansion_desc')],
            ['year' => '2021', 'title' => trans('main.new_production_line'), 'desc' => trans('main.new_production_line_desc')],
            ['year' => '2023', 'title' => trans('main.new_factory_plasterboard'), 'desc' => trans('main.new_factory_plasterboard_desc')],
            ['year' => '2025', 'title' => trans('main.new_export_countries'), 'desc' => trans('main.new_export_countries_desc')],
            ['year' => '2026', 'title' => trans('main.anniversary_milestone'), 'desc' => trans('main.anniversary_milestone_desc')],
        ];
    @endphp

    <div class="container about-shell">
        <div class="breadcrumb-modern">
            <a href="{{ route('web.home') }}">{{ trans('main.main_page') }}</a>
            <span>/</span>
            <span>@lang('main.about_us')</span>
        </div>

        <section class="about-hero">
            <h1>@lang('main.about_us')</h1>
            <p class="hero-summary">{{ $summary }}</p>

            <div class="doc-grid">
                @foreach($documents as $doc)
                    <a class="doc-card" href="{{ $doc['href'] }}" download>
                        <div class="doc-file">
                            <div class="doc-icon">PDF</div>
                            <p class="doc-title">{{ $doc['title'] }}</p>
                        </div>
                        <span class="doc-download-btn" aria-label="{{ __('Download') }}">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 1v8M4 7l3 3 3-3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 11h10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="about-panels">
            <article class="about-body">
                {!! $aboutBody !!}
            </article>

            <aside class="right-sidebar">
                <!-- Blue insight card -->
                <div class="insight-card">
                    <h3>@lang('main.about_us')</h3>
                    <p>{{ trans('main.turkmen_gips_subtitle') }}</p>
                    <div class="insight-meta">
                        <div class="meta-pill">
                            <span class="meta-value">{{ $yearsOnMarket }}+</span>
                            <small>{{ trans('main.years_of_excellence') }}</small>
                        </div>
                        <div class="meta-pill">
                            <span class="meta-value">4M</span>
                            <small>{{ trans('main.turkmen_gips_capacity_2') }}</small>
                        </div>
                        <div class="meta-pill">
                            <span class="meta-value">7K</span>
                            <small>{{ trans('main.products') }}</small>
                        </div>
                        <div class="meta-pill">
                            <span class="meta-value">10+</span>
                            <small>{{ trans('main.countries') }}</small>
                        </div>
                    </div>
                </div>

                {{-- Timeline in sidebar for ru/en --}}
                @if($locale !== 'tk')
                <div class="sidebar-timeline">
                    @foreach($timeline as $item)
                        <div class="timeline-card">
                            <span class="timeline-year">{{ $item['year'] }}</span>
                            <div class="timeline-title">{{ $item['title'] }}</div>
                            <p class="timeline-desc">{{ $item['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
                @endif
            </aside>
        </section>

        {{-- Timeline full-width below for tk only --}}
        @if($locale === 'tk')
        <section class="about-timeline-section">
            <div class="about-timeline-grid">
                @foreach($timeline as $item)
                    <div class="timeline-card">
                        <span class="timeline-year">{{ $item['year'] }}</span>
                        <div class="timeline-title">{{ $item['title'] }}</div>
                        <p class="timeline-desc">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>

    @include('inc.footer')
@endsection

@section('js')
@endsection

