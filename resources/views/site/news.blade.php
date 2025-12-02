@extends('layouts.site')

@section('css')

    <style>
        .focus-section {
            -webkit-transition: all 0.3s linear 0s;
            transition: all 0.3s linear 0s;
        }

        .focus-section .card {
            font-size: 1rem;
            border: #eee;
        }

        .focus-section .card .card-image {
            position: relative;
        }

        .focus-section .card .hover-text {
            position: relative;
            text-align: center;
            color: blue;
        }

        .focus-section .card .card-image .image-overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: 0.5s ease;
            background: rgba(0, 89, 179, 0.5);
        }

        .focus-section .card .card-image:hover .image-overlay {
            opacity: 1;
        }


        .focus-section .card .card-title {
            font-weight: 600;
            font-size: 1.3rem;
            height: 73px;
            overflow: hidden;
        }

        .focus-section .card .card-footer {
            background: #0059b3;;
            color: #fff;
        }

        .focus-section .card .card-footer .card-footer__info {
            font-size: 1rem;
            font-weight: 300;
            position: relative;
        }

        .focus-section .card .card-footer .card-footer__info {
            font-size: 1rem;
            font-weight: 300;
        }

        .focus-section .card .read-more {
            position: absolute;
            right: 0;
            font-weight: 600;
        }

        .focus-section .card .read-more-1 {
            text-decoration: none;
            position: relative;
            color: #fff;
        }


    </style>

@endsection
@section('content')


    <div class='container' style="min-height: 100vh;">
        <div class="brad">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-primary-color" href="{{url('/')}}">{{ trans('main.main_page') }}</a></li>
                <li class="breadcrumb-item">{{ trans('main.news') }}</li>


            </ol>
        </div>
        <div class="row">

            <section id="focus" class="focus-section">
                <div class="container-lg py-5">

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($news as $item)
                            @php
                                $item = is_array($item) ? (object)$item : $item;
                                $newsPhotos = is_array($item->photos ?? null) ? (object)$item->photos : $item->photos;
                                $newsImage = $newsPhotos->thumb ?? $newsPhotos->original ?? asset('images/placeholder.png');
                                $newsTitle = $item->title ?? '';
                                $newsBody = $item->body ?? '';
                                $newsDate = $item->posted_date ?? $item->created_at ?? date('Y-m-d');
                            @endphp

                            <div class="col">

                                <div class="card shadow-sm h-100">

                                    <a class="text-decoration-none" href="{{route('web.news', $item->id)}}">
                                        <div class="card-image">
                                            <div class="hover-text">
                                                <img src="{{ $newsImage }}" class="card-img-top" alt="...">
                                            </div>
                                            <div class="image-overlay"></div>
                                        </div>
                                    </a>



                                    <div class="card-body">

                                        <h3 class="card-title">

                                            <a class="text-decoration-none text-dark" href="{{route('web.news', $item->id)}}">
                                                {{\Illuminate\Support\Str::limit($newsTitle, 60, $end='...') }}
                                            </a>

                                        </h3>
                                        <div class="text-left my-2">

                                        </div>
                                        <p class="card-text"> {!! \Illuminate\Support\Str::limit($newsBody, 120, $end='...') !!}</p>


                                    </div>



                                    <div class="card-footer py-3">
                                        <div class="card-footer__info">
                                            <span><i class="far fa-calendar-alt"></i> {{date('d-m-Y', strtotime($newsDate))}}</span>
                                            <span class="read-more">
                                              <a class="text-uppercase read-more-1" href="{{route('web.news', $item->id)}}">@lang('main.read_more') </a>
                                          </span>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        @endforeach


                    </div>

                    <div class="row mt-4 justify-content-center">
                        {{$news->links()}}
                    </div>
                </div>
            </section>

        </div>




    </div>

    @include('inc.footer')



@endsection

