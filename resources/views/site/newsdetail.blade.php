@extends('layouts.site')

@section('css')
    <style>

        .trending-top .trend-top-img {
            overflow: hidden;
            position: relative;

        }

        a {
            color: #635c5c;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .trending-top .trend-top-img::before {
            background: -moz-linear-gradient(top, rgba(2,26,71,0) 0%, rgba(2,26,71,0.6) 100%);
            background: -webkit-linear-gradient(top, rgba(2,26,71,0) 0%, rgba(2,26,71,0.6) 100%);
            background: linear-gradient(to bottom, rgba(2,26,71,0) 0%, rgba(2,26,71,0.6) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00021a47', endColorstr='#99021a47',GradientType=0 );
        }

        .trending-top .trend-top-img img {
            width: 100%;
            border-radius: 7px;
        }
        .trending-top .trend-top-img .trend-top-cap {
            position: absolute;
            bottom: 25px;
            left: 31px;
        }

        .trending-top .trend-top-img .trend-top-cap h2 {
            font-size: 30px;
        }

        .trending-top .trend-top-img .trend-top-cap h2 a {
            color: #fff;
            font-weight: 700;
            line-height: 1.3;
        }

        .trand-right-single {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .trand-right-single .trand-right-img img {
            border-radius: 6px;
            max-width:200px;
        }

        .trand-right-single .trand-right-cap {
            padding-left: 18px;
        }

        .trand-right-single .trand-right-cap h4 {
            font-size: 18px;
        }

        .trand-right-cap h4 a {

        }


        .trand-right-cap h4 a:hover a{
            color: #0a529e;
        }






    </style>
@endsection
@section('content')

    <div class="container" style="min-height: 100vh;">

        <div class="brad">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-primary-color" href="{{route('web.home')}}">{{ trans('main.main_page') }}</a></li>
                <li class="breadcrumb-item">@lang('main.news')</li>

            </ol>
        </div>
        <div class="row">

            <div class="col-lg-8">
                <!-- Trending Top -->
                <div class="trending-top mb-30">
                    <div class="trend-top-img">
                        @php
                            $news = is_array($news) ? (object)$news : $news;
                            $newsPhotos = is_array($news->photos ?? null) ? (object)$news->photos : $news->photos;
                            $newsImage = $newsPhotos->original ?? $newsPhotos->thumb ?? asset('images/placeholder.png');
                            $newsTitle = $news->title ?? '';
                            $newsBody = $news->body ?? '';
                        @endphp
                        <img src="{{ $newsImage }}" alt="">
                        <div class="trend-top-cap">

                            <!-- <h2><a href="#">Welcome To The Best Model Winner Contest At Look of the year</a></h2> -->
                        </div>
                    </div>
                </div>
                <!-- Trending Bottom -->
                <div class="trending-bottom">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-uppercase my-4" style="color: #144b9d;font-weight:bold;">{{ $newsTitle }}</h4>
                            {!! $newsBody !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Riht content -->
            <div class="col-lg-4">
                @foreach($top_news as $top_new)
                    @php
                        $top_new = is_array($top_new) ? (object)$top_new : $top_new;
                        $topNewsPhotos = is_array($top_new->photos ?? null) ? (object)$top_new->photos : $top_new->photos;
                        $topNewsImage = $topNewsPhotos->thumb ?? $topNewsPhotos->original ?? asset('images/placeholder.png');
                        $topNewsTitle = $top_new->title ?? '';
                        $topNewsDate = $top_new->posted_date ?? $top_new->created_at ?? date('Y-m-d');
                    @endphp
                    <div class="trand-right-single d-flex">
                        <div class="trand-right-img">
                            <a href="{{route('web.news', $top_new->id)}}">
                                <img style="aspect-ratio: 3/2;" src="{{ $topNewsImage }}" alt="news image">
                            </a>
                        </div>
                        <div class="trand-right-cap">
                            <div class="d-flex">
                                <svg style="color:#506cd3;font-size: 10px;padding: 3px;margin-right: 10px;margin-bottom: 9px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>

                                <span class="color1">{{ date('d-m-Y', strtotime($topNewsDate)) }}</span>


                            </div>

                            <h4><a class="text-decoration-none" href="{{ route('web.news', $top_new->id) }}">{{\Illuminate\Support\Str::limit($topNewsTitle, 40, $end='...') }}</a></h4>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>



    @include('inc.footer')



@endsection
