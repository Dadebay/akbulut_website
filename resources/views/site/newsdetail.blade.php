@extends('layouts.site')

@section('css')
<style>
    /* ── News Detail Page ── */

    /* Top bar (breadcrumb + date) */
    .nd-topbar {
        background: #f4f7fd;
        border-bottom: 1px solid rgba(10,82,158,0.08);
        padding: 12px 0;
    }
    .nd-topbar__inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
    }
    .nd-topbar__breadcrumb {
        font-size: 0.84rem;
        color: #6b7a9a;
    }
    .nd-topbar__breadcrumb a {
        color: #0a529e;
        text-decoration: none;
        font-weight: 600;
    }
    .nd-topbar__breadcrumb a:hover { text-decoration: underline; }
    .nd-topbar__breadcrumb .sep { margin: 0 7px; color: #b0bcd4; }
    .nd-topbar__date {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(10,82,158,0.09);
        color: #0a529e;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
    }

    /* Article image */
    .nd-article__img {
        width: 100%;
        max-height: 460px;
        object-fit: contain;
        object-position: center center;
        border-radius: 16px;
        background: #f0f5ff;
        display: block;
        margin-bottom: 28px;
    }

    /* Layout */
    .nd-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 36px;
        max-width: 1200px;
        margin: 48px auto 70px;
        padding: 0 24px;
        align-items: start;
    }
    @media (max-width: 991px) {
        .nd-layout { grid-template-columns: 1fr; }
        .nd-hero__caption { padding: 0 20px; bottom: 20px; }
    }

    /* Article */
    .nd-article {
        background: #fff;
        border-radius: 24px;
        padding: 36px 40px 40px;
        box-shadow: 0 8px 40px rgba(10,82,158,0.07);
    }
    .nd-article__title {
        font-size: 1.7rem;
        font-weight: 800;
        color: #1a2340;
        line-height: 1.35;
        margin-bottom: 22px;
        padding-bottom: 22px;
        border-bottom: 2px solid #f0f5ff;
    }
    .nd-article__body {
        font-size: 1.02rem;
        color: #4a5568;
        line-height: 1.85;
    }
    .nd-article__body p { margin-bottom: 1.2em; }
    .nd-article__body img { max-width: 100%; border-radius: 12px; margin: 12px 0; }
    .nd-article__body h2, .nd-article__body h3 { color: #1a2340; font-weight: 700; margin: 1.4em 0 0.6em; }
    @media (max-width: 575px) {
        .nd-article { padding: 22px 18px 28px; }
        .nd-article__title { font-size: 1.3rem; }
    }

    /* Sidebar */
    .nd-sidebar__heading {
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #0a529e;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e8f0fd;
    }
    .nd-related-card {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 14px 0;
        border-bottom: 1px solid #f0f3fa;
        text-decoration: none;
        color: inherit;
        transition: opacity 0.2s;
    }
    .nd-related-card:last-child { border-bottom: none; }
    .nd-related-card:hover { opacity: 0.8; color: inherit; }
    .nd-related-card__thumb {
        flex-shrink: 0;
        width: 80px;
        height: 60px;
        border-radius: 10px;
        overflow: hidden;
    }
    .nd-related-card__thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .nd-related-card:hover .nd-related-card__thumb img { transform: scale(1.06); }
    .nd-related-card__info { flex: 1; }
    .nd-related-card__date {
        font-size: 0.73rem;
        color: #8898b4;
        font-weight: 600;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .nd-related-card__title {
        font-size: 0.88rem;
        font-weight: 700;
        color: #1a2340;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .nd-sidebar__box {
        background: #fff;
        border-radius: 20px;
        padding: 24px 22px;
        box-shadow: 0 8px 32px rgba(10,82,158,0.07);
        position: sticky;
        top: 100px;
    }

</style>
@endsection

@section('content')

@php
    $news        = is_array($news) ? (object)$news : $news;
    $newsPhotos  = is_array($news->photos ?? null) ? (object)$news->photos : $news->photos;
    $newsImage   = $newsPhotos->original ?? $newsPhotos->thumb ?? asset('images/placeholder.png');
    $newsTitle   = $news->title ?? '';
    $newsBody    = $news->body ?? '';
    $newsDate    = $news->posted_date ?? $news->created_at ?? date('Y-m-d');
@endphp

{{-- Top breadcrumb + date bar --}}
<div class="nd-topbar">
    <div class="nd-topbar__inner">
        <div class="nd-topbar__breadcrumb">
            <a href="{{ route('web.home') }}">{{ trans('main.main_page') }}</a>
            <span class="sep">›</span>
            <span>@lang('main.news')</span>
        </div>
        <div class="nd-topbar__date">
            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            {{ date('d.m.Y', strtotime($newsDate)) }}
        </div>
    </div>
</div>

{{-- Content layout --}}
<div class="nd-layout">

    {{-- Article --}}
    <article class="nd-article">
        <img class="nd-article__img" src="{{ $newsImage }}" alt="{{ e($newsTitle) }}">
        <h1 class="nd-article__title">{{ $newsTitle }}</h1>
        <div class="nd-article__body">{!! $newsBody !!}</div>
    </article>

    {{-- Sidebar --}}
    <aside class="nd-sidebar__box">
        <div class="nd-sidebar__heading">@lang('main.news')</div>
        @foreach($top_news as $top_new)
            @php
                $top_new   = is_array($top_new) ? (object)$top_new : $top_new;
                $topPhotos = is_array($top_new->photos ?? null) ? (object)$top_new->photos : $top_new->photos;
                $topImage  = $topPhotos->thumb ?? $topPhotos->original ?? asset('images/placeholder.png');
                $topTitle  = $top_new->title ?? '';
                $topDate   = $top_new->posted_date ?? $top_new->created_at ?? date('Y-m-d');
            @endphp
            <a class="nd-related-card" href="{{ route('web.news', $top_new->id) }}">
                <div class="nd-related-card__thumb">
                    <img src="{{ $topImage }}" alt="{{ e($topTitle) }}">
                </div>
                <div class="nd-related-card__info">
                    <div class="nd-related-card__date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        {{ date('d.m.Y', strtotime($topDate)) }}
                    </div>
                    <div class="nd-related-card__title">{{ \Illuminate\Support\Str::limit($topTitle, 55, '…') }}</div>
                </div>
            </a>
        @endforeach
    </aside>

</div>

@include('inc.footer')

@endsection
