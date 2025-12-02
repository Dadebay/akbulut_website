@extends('layouts.site')
@section('content')
    @include('inc.carousel')
    <!-- Categories -->

    <div class="container">
        <div class="row mb-4 row-cols-2 row-cols-lg-3 g-3 row-cols-md-3  mx-auto  border-0   ">
            @foreach ($categories as $item)
                @php
                    $item = is_array($item) ? (object)$item : $item;
                    $categoryName = $item->name ?? 'Category';
                    $categoryImage = $item->image ?? asset('images/placeholder_category_1x05.png');
                @endphp
                <div>
                    <div class="col bg-light g-0 p-0 border-0 mt-4 d-flex flex-column product">
                        <h3 class='inner-text '><a href="{{route('category.products',['category_id'=>$item->id])}}">{{ $categoryName }}</a></h3>
                        <a href="{{route('category.products',['category_id'=>$item->id])}}" class='inner-img'>
                            <img src='{{ $categoryImage }}' alt="{{ $categoryName }}" class='' />
                        </a>
                    </div>
                </div>

            @endforeach

        </div>
    </div>

    <!-- Categories -->

    @include('inc.video')


    <div class="viewed my-5">
        <div class="container  mt-5">
            <div class="row">
                <div class="col">
                    <div class="bbb_viewed_title_container">
                        <div class="after py-2 mb-3">
                            <h3 class=" line">@lang('main.news')</h3>

                        </div>

                        <div class="owl-carousel">

                            @foreach ($news as $news_item)
                                @php
                                    $news_item = is_array($news_item) ? (object)$news_item : $news_item;
                                    $newsTitle = $news_item->title ?? $news_item->name ?? 'News';
                                    $newsPhotos = is_array($news_item->photos ?? null) ? (object)$news_item->photos : $news_item->photos;
                                    $newsImage = $newsPhotos->thumb ?? $newsPhotos->original ?? asset('images/placeholder.png');
                                    $newsDate = $news_item->posted_date ?? $news_item->created_at ?? date('Y-m-d');
                                @endphp

                                <div class='item'>
                                    <a href="{{route('web.news', $news_item->id)}}">
                                        <img src='{{ $newsImage }}' class="owl-img" alt="" />
                                    </a>
                                    <div class="owl-text inner-text cart-text p-1 m-0">

                                        <a href="{{route('web.news', $news_item->id)}}" class="d-flex flex-column text-start  justidy-content-flex-start">

                                            <h3 class='text-start  cart-title  p-0'>{{ \Illuminate\Support\Str::limit($newsTitle, 15, $end='...') }}</h3>
                                            <p class='p-0 mb-0 text-start text-white'>{{ date('d-m-Y', strtotime($newsDate)) }} </p>
                                        </a>
                                    </div>

                                </div>

                            @endforeach



                        </div>  
                    </div>


                </div>
            </div>
        </div>
    </div>
    @include('inc.calculator')
    @include('inc.contact')
    @include('inc.footer')



@endsection
@section('js')
    <script>
        var loadingText = '{{trans("main.loading")}}';
        var sendText = '{{trans("main.send")}}';
        var button = `<a class="text-decoration-none text-white" disabled>
  <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
  `+loadingText+`...
</a>`;

        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast')

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
                url:"https://akbulut.com.tm/api/feedback",
                data:{
                    name:fio,
                    phone:phone,
                    body:text_body
                },
                success:function(data){
                    $('.contact-btn').html(sendText);
                    $('.toast-body').html('feedback created successfully');
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show();
                    $("input[name=contact_name]").val('');
                    $("input[name=contact_phone]").val('');
                    $("textarea[name=text_body]").val('');

                },
                error: function (params) {

                    if(params.responseJSON.error.phone){
                        $('.toast-body').html(params.responseJSON.error.phone[0])
                    }
                    if(params.responseJSON.error.name){
                        $('.toast-body').html(params.responseJSON.error.name[0])
                    }
                    if(params.responseJSON.error.body){
                        $('.toast-body').html(params.responseJSON.error.body[0])
                    }
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show();

                    $('.contact-btn').html(sendText);
                    return;
                }
            });

        });

    </script>

@endsection
