@extends('layouts.site')
@section('content')
    @include('inc.carousel')

    <!-- ═══════════════ CATEGORIES SECTION ═══════════════ -->
    <section class="wlc-categories-section">
        <div class="container">
            <div class="wlc-section-header">
                <div class="wlc-section-badge">@lang('main.products')</div>
                <h2 class="wlc-section-title">@lang('main.categories')</h2>
                <p class="wlc-section-sub">@lang('main.categories_subtitle')</p>
            </div>

            <div class="wlc-cat-grid">
                @foreach ($categories as $item)
                    @php
                        $item = is_array($item) ? (object)$item : $item;
                        $categoryName = $item->name ?? 'Category';
                        $categoryImage = $item->image ?? asset('images/placeholder_category_1x05.png');
                    @endphp
                    <a href="{{ route('category.products', ['category_id' => $item->id]) }}" class="wlc-cat-card">
                        <div class="wlc-cat-img-wrap">
                            <img src="{{ $categoryImage }}" alt="{{ $categoryName }}" class="wlc-cat-img" onerror="catImgFallback(this)" />
                            <div class="wlc-cat-overlay"></div>
                        </div>
                        <div class="wlc-cat-footer">
                            <span class="wlc-cat-name">{{ $categoryName }}</span>
                            <span class="wlc-cat-arrow">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ═══════════════ END CATEGORIES ═══════════════ -->

    @include('inc.video')


    <!-- ═══════════════ NEWS SECTION ═══════════════ -->
    <section class="wlc-news-section">
        <div class="container">
            <div class="wlc-section-header wlc-section-header--light">
                <div class="wlc-section-badge wlc-section-badge--dark">@lang('main.news')</div>
                <h2 class="wlc-section-title">@lang('main.latest_news')</h2>
            </div>

            <div class="owl-carousel wlc-news-carousel">
                @foreach ($news as $news_item)
                    @php
                        $news_item = is_array($news_item) ? (object)$news_item : $news_item;
                        $newsTitle = $news_item->title ?? $news_item->name ?? 'News';
                        $newsPhotos = is_array($news_item->photos ?? null) ? (object)$news_item->photos : $news_item->photos;
                        $newsImage = $newsPhotos->thumb ?? $newsPhotos->original ?? asset('images/placeholder.png');
                        $newsDate = $news_item->posted_date ?? $news_item->created_at ?? date('Y-m-d');
                    @endphp
                    <div class="wlc-news-item">
                        <a href="{{ route('web.news', $news_item->id) }}" class="wlc-news-card">
                            <div class="wlc-news-img-wrap">
                                <img src="{{ $newsImage }}" alt="{{ $newsTitle }}" class="wlc-news-img" />
                                <div class="wlc-news-overlay"></div>
                            </div>
                            <div class="wlc-news-body">
                                <span class="wlc-news-date">
                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><rect x="1" y="2" width="11" height="10" rx="2" stroke="currentColor" stroke-width="1.2"/><path d="M4 1v2M9 1v2M1 5h11" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                                    {{ date('d.m.Y', strtotime($newsDate)) }}
                                </span>
                                <h3 class="wlc-news-title">{{ \Illuminate\Support\Str::limit($newsTitle, 55, '...') }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="wlc-news-all-wrap">
                <a href="{{ route('web.allnews') }}" class="wlc-news-all-btn">
                    @lang('main.all_news')
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
    </section>
    <!-- ═══════════════ END NEWS ═══════════════ -->
    @include('inc.contact')
    @include('inc.footer')


@endsection
@section('js')
    <script>
        // ── Category image fallback (maps broken API images to local files) ──
        var catFallbackMap = [
            { keywords: ['acoustic', 'akustik', 'wooden ceiling', 'wall cladding', 'tahta', 'agaç', 'дерев'], src: '{{ asset('storage/categories/661/akustik-22.jpg') }}' },
            { keywords: ['accessor', 'aksesu', 'аксессуар', 'agraf', 'klip'], src: '{{ asset('storage/products/567/Agraf.jpg') }}' },
            { keywords: ['gips', 'гипс', 'plaster', 'drywall'], src: '{{ asset('storage/products/628/GIPS-11.jpg') }}' },
            { keywords: ['lay-in', 'layin', 'лэй'], src: '{{ asset('images/layin.png') }}' },
            { keywords: ['clip', 'клип', 'klip-in'], src: '{{ asset('storage/products/556/klipinnn.png') }}' },
            { keywords: ['profil', 'profile', 'профил', 't-bar'], src: '{{ asset('storage/products/569/T-profil.jpg') }}' },
        ];
        function catImgFallback(img) {
            img.onerror = null; // prevent infinite loop
            var name = (img.alt || '').toLowerCase();
            var found = false;
            for (var i = 0; i < catFallbackMap.length; i++) {
                var entry = catFallbackMap[i];
                for (var j = 0; j < entry.keywords.length; j++) {
                    if (name.indexOf(entry.keywords[j]) !== -1) {
                        img.src = entry.src;
                        found = true;
                        break;
                    }
                }
                if (found) break;
            }
            if (!found) {
                img.src = '{{ asset('images/placeholder_category_1x05.png') }}';
            }
        }

        var loadingText = '{{trans("main.loading")}}';
        var sendText = '{{trans("main.send")}}';
        var button = `<a class="text-decoration-none text-white" disabled>
  <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
  `+loadingText+`...
</a>`;

        const toastTrigger = document.getElementById('liveToastBtn')

        // Smooth scroll to anchor on page load (only if hash exists)
        $(document).ready(function() {
            var hash = window.location.hash;
            if (hash && hash.length > 1) {
                var target = $(hash);
                if (target.length) {
                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: target.offset().top - 100
                        }, 800);
                    }, 100);
                }
            }
        });

        $(".contact-btn").click(function(e){

            e.preventDefault();

            var fio = $("input[name=contact_name]").val();
            var phone = $("input[name=contact_phone]").val();
            var text_body = $("textarea[name=text_body]").val();

            $('.contact-btn').html(button);

            $.ajax({
                type:'POST',
                url:"/api/feedback",
                data:{
                    name:fio,
                    phone:phone,
                    body:text_body
                },
                success:function(data){
                    $('.contact-btn').html(sendText);
                    $("input[name=contact_name]").val('');
                    $("input[name=contact_phone]").val('');
                    $("textarea[name=text_body]").val('');
                    document.getElementById('contactSuccessOverlay').classList.add('show');
                },
                error: function (params) {
                    var errMsg = '';
                    if(params.responseJSON && params.responseJSON.error){
                        if(params.responseJSON.error.phone) errMsg = params.responseJSON.error.phone[0];
                        else if(params.responseJSON.error.name) errMsg = params.responseJSON.error.name[0];
                        else if(params.responseJSON.error.body) errMsg = params.responseJSON.error.body[0];
                    }
                    if(errMsg) alert(errMsg);
                    $('.contact-btn').html(sendText);
                    return;
                }
            });

        });

    </script>

@endsection
