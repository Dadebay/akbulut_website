@extends('layouts.site')

@section('css')
<style>
    .prv-shell {
        min-height: 100vh;
        padding: 40px 0 80px;
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
    .breadcrumb-modern a:hover { text-decoration: underline; }
    .breadcrumb-sep { opacity: 0.4; }
    .prv-hero {
        background: linear-gradient(135deg, #f0f5ff 0%, #e8f0fb 100%);
        border-radius: 32px;
        padding: 48px 48px 40px;
        position: relative;
        overflow: hidden;
        margin-bottom: 36px;
    }
    .prv-hero::before {
        content: "";
        position: absolute;
        top: -60px;
        right: -60px;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(10,82,158,0.12), transparent 70%);
        pointer-events: none;
    }
    .prv-hero h1 {
        font-size: clamp(28px, 4vw, 44px);
        font-weight: 700;
        color: #0a529e;
        margin: 0 0 10px;
    }
    .prv-hero p {
        font-size: 16px;
        color: rgba(0,0,0,0.6);
        margin: 0;
    }
    .prv-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(10,82,158,0.1);
        color: #0a529e;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 100px;
        margin-bottom: 20px;
    }
    .prv-badge svg { flex-shrink: 0; }
    .prv-body {
        background: #fff;
        border-radius: 28px;
        padding: 48px 52px;
        border: 1px solid rgba(0,0,0,0.07);
        box-shadow: 0 30px 70px rgba(10,82,158,0.08);
        line-height: 1.9;
        color: rgba(0,0,0,0.78);
        font-size: 16px;
    }
    .prv-body h1, .prv-body h2, .prv-body h3 {
        color: #0a529e;
        font-weight: 700;
        margin-top: 2em;
        margin-bottom: 0.6em;
    }
    .prv-body h1 { font-size: 1.7em; }
    .prv-body h2 { font-size: 1.35em; }
    .prv-body h3 { font-size: 1.1em; }
    .prv-body p { margin-bottom: 1em; }
    .prv-body ul, .prv-body ol {
        margin: 1rem 0 1rem 1.4rem;
    }
    .prv-body li { margin-bottom: 0.5em; }
    .prv-body strong { color: rgba(0,0,0,0.88); }
    .prv-body a { color: #0a529e; }
    .prv-empty {
        text-align: center;
        padding: 80px 0;
        color: rgba(0,0,0,0.4);
        font-size: 16px;
    }
    @media (max-width: 768px) {
        .prv-hero { padding: 32px 24px 28px; border-radius: 22px; }
        .prv-body { padding: 32px 24px; border-radius: 22px; }
    }
</style>
@endsection

@section('content')
<div class="prv-shell">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav class="breadcrumb-modern" aria-label="breadcrumb">
            <a href="{{ route('web.home') }}">{{ trans('main.main_page') }}</a>
            <span class="breadcrumb-sep">/</span>
            <span>{{ trans('main.privacy') }}</span>
        </nav>

        {{-- Hero --}}
        <div class="prv-hero">
            <div class="prv-badge">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M7 1l1.8 3.6L13 5.3l-3 2.9.7 4.1L7 10.4l-3.7 1.9.7-4.1-3-2.9 4.2-.7z"
                          fill="#0a529e"/>
                </svg>
                {{ trans('main.privacy') }}
            </div>
            <h1>{{ trans('main.privacy') }}</h1>
        </div>

        {{-- Content body --}}
        @php
            $aboutUs = is_array($aboutUs) ? (object)$aboutUs : $aboutUs;
            $privacyBody = $aboutUs->body ?? '';
        @endphp

        @if($privacyBody)
            <div class="prv-body">
                {!! $privacyBody !!}
            </div>
        @else
            <div class="prv-empty">{{ trans('main.privacy') }}</div>
        @endif

    </div>
</div>
@include('inc.footer')
@endsection

@section('js')
@endsection

