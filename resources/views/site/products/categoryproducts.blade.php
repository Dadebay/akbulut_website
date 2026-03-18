@extends('layouts.site')

@section('css')
<link rel="stylesheet" href="{{asset('css/jquery.fancybox.css')}}">
<style>
    /* ─── Page Variables ─── */
    :root {
        --brand:       #0a529e;
        --brand-light: #1271cc;
        --brand-bg:    #e8f0fb;
        --text-dark:   #1a2340;
        --text-muted:  #6b7a9a;
        --border:      #e2e8f0;
        --card-shadow: 0 2px 12px rgba(10,82,158,.08);
        --card-hover:  0 8px 30px rgba(10,82,158,.18);
        --radius:      12px;
    }

    /* ─── Page wrapper ─── */
    .products-page {
        background: #f7f9fc;
        min-height: 100vh;
        padding-bottom: 60px;
    }

    /* ─── Top banner ─── */
    .products-banner {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
        padding: 36px 0 28px;
        color: #fff;
        margin-bottom: 36px;
    }
    .products-banner h1 {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: -.5px;
        margin-bottom: 8px;
    }
    .products-banner .breadcrumb {
        background: transparent;
        margin: 0;
        padding: 0;
    }
    .products-banner .breadcrumb-item a,
    .products-banner .breadcrumb-item {
        color: rgba(255,255,255,.75);
        font-size: .875rem;
    }
    .products-banner .breadcrumb-item.active { color: #fff; }
    .products-banner .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,.5); }

    /* ─── Sidebar ─── */
    .products-sidebar {
        position: sticky;
        top: 20px;
    }
    .sidebar-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }
    .sidebar-header {
        background: var(--brand);
        color: #fff;
        padding: 14px 20px;
        font-weight: 600;
        font-size: .875rem;
        letter-spacing: .5px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sidebar-header svg { flex-shrink: 0; }
    .cat-list { list-style: none; margin: 0; padding: 8px 0; }
    .cat-list li { border-bottom: 1px solid var(--border); }
    .cat-list li:last-child { border-bottom: none; }
    .cat-list a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 20px;
        color: var(--text-dark);
        text-decoration: none;
        font-size: .9rem;
        font-weight: 500;
        transition: background .18s, color .18s, padding-left .18s;
    }
    .cat-list a:hover {
        background: var(--brand-bg);
        color: var(--brand);
        padding-left: 26px;
    }
    .cat-list a .arrow {
        font-size: .7rem;
        opacity: .4;
        transition: opacity .18s;
    }
    .cat-list a:hover .arrow { opacity: 1; }
    .cat-list li.active a {
        background: var(--brand-bg);
        color: var(--brand);
        font-weight: 700;
        border-left: 3px solid var(--brand);
        padding-left: 17px;
    }
    .cat-back-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 14px 20px;
        color: var(--brand);
        font-weight: 600;
        font-size: .875rem;
        text-decoration: none;
        border-bottom: 1px solid var(--border);
        transition: background .18s;
    }
    .cat-back-btn:hover { background: var(--brand-bg); color: var(--brand); }

    /* ─── Mobile category strip ─── */
    .mobile-cat-strip {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        padding: 0 0 12px;
        scrollbar-width: none;
    }
    .mobile-cat-strip::-webkit-scrollbar { display: none; }
    .mobile-cat-chip {
        white-space: nowrap;
        padding: 7px 16px;
        border-radius: 50px;
        border: 1.5px solid var(--border);
        background: #fff;
        color: var(--text-dark);
        font-size: .8rem;
        font-weight: 500;
        text-decoration: none;
        transition: all .18s;
        flex-shrink: 0;
    }
    .mobile-cat-chip:hover,
    .mobile-cat-chip.active {
        background: var(--brand);
        border-color: var(--brand);
        color: #fff;
    }

    /* ─── Products grid ─── */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    @media (max-width: 991px) { .products-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px)  { .products-grid { grid-template-columns: 1fr 1fr; gap: 12px; } }

    /* ─── Product card ─── */
    .product-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--card-shadow);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform .22s, box-shadow .22s;
        cursor: pointer;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-hover);
    }
    .product-card__img-wrap {
        position: relative;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: #f0f4f8;
    }
    .product-card__img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .35s;
    }
    .product-card:hover .product-card__img-wrap img { transform: scale(1.07); }
    .product-card__overlay {
        position: absolute;
        inset: 0;
        background: rgba(10,82,158,.45);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity .25s;
    }
    .product-card:hover .product-card__overlay { opacity: 1; }
    .product-card__overlay-icon {
        width: 48px;
        height: 48px;
        background: rgba(255,255,255,.85);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand);
    }
    .product-card__body {
        padding: 14px 16px 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .product-card__name {
        font-size: .9rem;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .product-card__view {
        margin-top: auto;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .78rem;
        font-weight: 600;
        color: var(--brand);
        text-decoration: none;
        transition: gap .18s;
    }
    .product-card__view:hover { gap: 10px; color: var(--brand); }

    /* ─── Empty state ─── */
    .no-products {
        text-align: center;
        padding: 80px 20px;
        color: var(--text-muted);
    }
    .no-products svg { opacity: .25; margin-bottom: 20px; }
    .no-products h5 { font-weight: 600; color: var(--text-dark); margin-bottom: 8px; }

    /* ─── Pagination ─── */
    .pagination-wrap { margin-top: 36px; display: flex; justify-content: center; }
    .pagination-wrap .page-link { color: var(--brand); border-radius: 8px !important; margin: 0 2px; border: 1px solid var(--border); }
    .pagination-wrap .page-item.active .page-link { background: var(--brand); border-color: var(--brand); }

    /* ─── Section title ─── */
    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--border);
    }
    .section-title span.accent {
        display: inline-block;
        width: 4px;
        height: 22px;
        background: var(--brand);
        border-radius: 3px;
    }
</style>
@endsection

@section('content')
    @php
        $currentCategory = null;
        if ($category_id) {
            $currentCategory = $categories->firstWhere('id', $category_id);
            $currentCategory = is_array($currentCategory) ? (object)$currentCategory : $currentCategory;
        }
    @endphp

    <!-- ── Top Banner ── -->
    <div class="products-banner">
        <div class="container">
            <h1>{{ $currentCategory ? ($currentCategory->name ?? trans('main.products')) : trans('main.products') }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('web.home') }}">{{ trans('main.main_page') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.products') }}">{{ trans('main.products') }}</a></li>
                    @if ($currentCategory)
                        <li class="breadcrumb-item active">{{ $currentCategory->name ?? '' }}</li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>

    <div class="products-page">
        <div class="container">

            <!-- ── Mobile category chips (visible < lg) ── -->
            <div class="d-lg-none mb-4">
                <div class="mobile-cat-strip">
                    <a href="{{ route('category.products') }}"
                       class="mobile-cat-chip {{ !$category_id ? 'active' : '' }}">
                        {{ trans('main.categories') }}
                    </a>
                    @foreach ($categories as $cat)
                        @php $cat = is_array($cat) ? (object)$cat : $cat; @endphp
                        <a href="{{ route('category.products', ['category_id' => $cat->id]) }}"
                           class="mobile-cat-chip {{ $category_id == $cat->id ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="row g-4">
                <!-- ── Sidebar (desktop) ── -->
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="products-sidebar">
                        <div class="sidebar-card">
                            <div class="sidebar-header">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                                {{ trans('main.categories') }}
                            </div>

                            @if ($category_id)
                                <a href="{{ route('category.products') }}" class="cat-back-btn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                                    {{ trans('main.back') }}
                                </a>
                            @endif

                            <ul class="cat-list">
                                @foreach ($categories as $cat)
                                    @php $cat = is_array($cat) ? (object)$cat : $cat; @endphp
                                    <li class="{{ $category_id == $cat->id ? 'active' : '' }}">
                                        <a href="{{ route('category.products', ['category_id' => $cat->id]) }}">
                                            <span>{{ $cat->name }}</span>
                                            <span class="arrow">›</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ── Products area ── -->
                <div class="col-12 col-lg-9">

                    @if ($currentCategory)
                        <div class="section-title">
                            <span class="accent"></span>
                            {{ $currentCategory->name }}
                            <span style="font-size:.85rem;font-weight:400;color:var(--text-muted);margin-left:auto;">
                                {{ $products->total() }} {{ trans('main.products') }}
                            </span>
                        </div>
                    @endif

                    @if ($products->isEmpty())
                        <div class="no-products">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                            <h5>{{ trans('main.products') }}</h5>
                            <p>—</p>
                        </div>
                    @else
                        <div class="products-grid">
                            @foreach ($products as $item)
                                @php
                                    $item       = is_array($item) ? (object)$item : $item;
                                    $name       = $item->name ?? 'Product';
                                    $photos     = is_array($item->photos ?? null) ? (object)$item->photos : ($item->photos ?? null);
                                    $image      = $photos->thumb ?? $photos->original ?? asset('images/placeholder.png');
                                @endphp
                                <div class="product-card">
                                    <a class="product-card__img-wrap fancybox"
                                       href="{{ $image }}"
                                       data-caption="{{ $name }}">
                                        <img src="{{ $image }}" alt="{{ $name }}" loading="lazy">
                                        <div class="product-card__overlay">
                                            <div class="product-card__overlay-icon">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="product-card__body">
                                        <p class="product-card__name">{{ $name }}</p>
                                        <a class="product-card__view fancybox"
                                           href="{{ $image }}"
                                           data-caption="{{ $name }}">
                                            {{ trans('main.read_more') }}
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pagination-wrap">
                            {{ $products->appends(['category_id' => $category_id])->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @include('inc.footer')
@endsection

@section('js')
<script src="{{asset('js/jquery.fancybox.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.fancybox').fancybox({
            openEffect : 'fade',
            closeEffect: 'fade',
            beforeShow : function () {
                this.title = $(this.element).data('caption');
            }
        });
    });
</script>
@endsection

