@extends('layouts.site')

@section('css')
<style>
    /* ── News List Page ── */
    .nl-hero {
        background: linear-gradient(135deg, #0a529e 0%, #1976d2 100%);
        padding: 52px 0 44px;
        margin-bottom: 52px;
    }
    .nl-hero__label {
        display: inline-block;
        background: rgba(255,255,255,0.15);
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 20px;
        margin-bottom: 14px;
    }
    .nl-hero__title {
        color: #fff;
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
    }
    .nl-hero__breadcrumb {
        margin-top: 14px;
        font-size: 0.88rem;
        color: rgba(255,255,255,0.7);
    }
    .nl-hero__breadcrumb a {
        color: rgba(255,255,255,0.85);
        text-decoration: none;
    }
    .nl-hero__breadcrumb a:hover { color: #fff; }
    .nl-hero__breadcrumb .sep { margin: 0 8px; }

    /* Grid */
    .nl-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        margin-bottom: 52px;
    }
    @media (max-width: 991px) { .nl-grid { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 575px) { .nl-grid { grid-template-columns: 1fr; } }

    /* Card */
    .nl-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(10,82,158,0.08);
        display: flex;
        flex-direction: column;
        transition: transform 0.28s ease, box-shadow 0.28s ease;
        text-decoration: none;
        color: inherit;
    }
    .nl-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 52px rgba(10,82,158,0.16);
        color: inherit;
    }
    .nl-card__thumb {
        position: relative;
        overflow: hidden;
        aspect-ratio: 16/10;
    }
    .nl-card__thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.42s ease;
    }
    .nl-card:hover .nl-card__thumb img { transform: scale(1.06); }
    .nl-card__date {
        position: absolute;
        bottom: 12px;
        left: 14px;
        background: rgba(10,82,158,0.88);
        color: #fff;
        font-size: 0.74rem;
        font-weight: 600;
        padding: 4px 11px;
        border-radius: 20px;
        backdrop-filter: blur(4px);
    }
    .nl-card__body {
        padding: 22px 22px 18px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .nl-card__title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1a2340;
        line-height: 1.45;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .nl-card__excerpt {
        font-size: 0.88rem;
        color: #6b7a9a;
        line-height: 1.6;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 18px;
    }
    .nl-card__footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #f0f3fa;
        padding-top: 14px;
    }
    .nl-card__read {
        font-size: 0.82rem;
        font-weight: 700;
        color: #0a529e;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .nl-card__read svg { transition: transform 0.2s; }
    .nl-card:hover .nl-card__read svg { transform: translateX(3px); }

    /* Pagination */
    .nl-pagination { display: flex; justify-content: center; padding-bottom: 60px; }
    .nl-pagination .pagination { gap: 6px; }
    .nl-pagination .page-link {
        border-radius: 10px !important;
        border: none;
        color: #0a529e;
        padding: 8px 15px;
        font-weight: 600;
        background: #f0f5ff;
        transition: all 0.2s;
    }
    .nl-pagination .page-link:hover,
    .nl-pagination .page-item.active .page-link {
        background: #0a529e;
        color: #fff;
    }
</style>
@endsection

@section('content')

<div class="nl-hero">
    <div class="container">
        <div class="nl-hero__label">@lang('main.news')</div>
        <h1 class="nl-hero__title">@lang('main.news')</h1>
        <div class="nl-hero__breadcrumb">
            <a href="{{ url('/') }}">{{ trans('main.main_page') }}</a>
            <span class="sep">›</span>
            <span>{{ trans('main.news') }}</span>
        </div>
    </div>
</div>

<div class="container" style="min-height: 60vh;">
    <div class="nl-grid">
        @foreach ($news as $item)
            @php
                $item       = is_array($item) ? (object)$item : $item;
                $newsPhotos = is_array($item->photos ?? null) ? (object)$item->photos : $item->photos;
                $newsImage  = $newsPhotos->thumb ?? $newsPhotos->original ?? asset('images/placeholder.png');
                $newsTitle  = $item->title ?? '';
                $newsBody   = $item->body ?? '';
                $newsDate   = $item->posted_date ?? $item->created_at ?? date('Y-m-d');
            @endphp
            <a class="nl-card" href="{{ route('web.news', $item->id) }}">
                <div class="nl-card__thumb">
                    <img src="{{ $newsImage }}" alt="{{ e($newsTitle) }}">
                    <span class="nl-card__date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="margin-right:4px;vertical-align:-1px"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ date('d.m.Y', strtotime($newsDate)) }}
                    </span>
                </div>
                <div class="nl-card__body">
                    <div class="nl-card__title">{{ \Illuminate\Support\Str::limit($newsTitle, 70, '…') }}</div>
                    <div class="nl-card__excerpt">{!! strip_tags(\Illuminate\Support\Str::limit($newsBody, 140, '…')) !!}</div>
                    <div class="nl-card__footer">
                        <span class="nl-card__read">
                            @lang('main.read_more')
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="nl-pagination">
        {{ $news->links() }}
    </div>
</div>

@include('inc.footer')

@endsection

