@extends('layouts.site')

@section('css')

    <link rel="stylesheet" href="{{asset('css/jquery.fancybox.css')}}">

@endsection
@section('content')


    <!-- CATEGORY PRODUCTS-->
    <div class="container" style="min-height: 100vh;">

        <div class="brad">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a class="text-primary-color" href="{{route('web.home')}}">{{ trans('main.main_page') }}</a></li>
                <li class="breadcrumb-item"><a class="text-primary-color" href="{{route('category.products')}}">{{ trans('main.products') }}</a></li>
                @if ($category_id)
                    @php
                        $currentCategory = $categories->firstWhere('id', $category_id);
                        $currentCategory = is_array($currentCategory) ? (object)$currentCategory : $currentCategory;
                    @endphp
                    <li class="breadcrumb-item active" aria-current="page">{{ $currentCategory->name ?? '' }}</li>
                @endif

            </ol>
        </div>
        <div class="row">



            <div class='col-3 d-none d-lg-block d-md-block col-md-3 col-sm-5 mt-lg-0 mt-0 pt-0 m-0 p-0 list-groups '>
                <div class='list  p-0 m-0'>

                    <ul class="list-group p-0 mt-sm-5">

                        @if($category_id)
                            @php
                                $currentCategory = $categories->firstWhere('id', $category_id);
                                $currentCategory = is_array($currentCategory) ? (object)$currentCategory : $currentCategory;
                            @endphp
                            <li class="list-group-item active" aria-current="true">{{ $currentCategory->name ?? 'Category' }}</li>
                        @endif

                        @if ($category_id == null)
                            @foreach ($categories as $categori)
                                @php
                                    $categori = is_array($categori) ? (object)$categori : $categori;
                                @endphp
                                <li class="list-group-item grey">
                                    <a href="{{route('category.products',['category_id'=>$categori->id])}}" class="nav-link">
                                        {{ $categori->name }}
                                    </a>
                                </li>
                            @endforeach

                        @else

                            <li class="list-group-item grey">
                                <a href="{{route('category.products') }}" class="nav-link">
                                    <  @lang('main.back')
                                </a>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>

            <div class='col-12 col-lg-9 p-4 p t-0  col-md-9 col-sm-7  mt-0 '>
                <div class="row mt-2 row-cols-lg-3 row-cols-2 row-cols-md-2 row-cols-sm-2 g-3  mb-5">
                    @foreach ($products as $item)
                        @php
                            $item = is_array($item) ? (object)$item : $item;
                            $productName = $item->name ?? 'Product';
                            $productPhotos = is_array($item->photos ?? null) ? (object)$item->photos : $item->photos;
                            $productImage = $productPhotos->thumb ?? $productPhotos->original ?? asset('images/placeholder.png');
                        @endphp

                        <div class="col">
                            <div class="col bg-light g-0 p-0 border-0 d-flex flex-column product">

                                <h3 class='inner-text'>
                                    <a class="fancybox" href="{{ $productImage }}">{{ $productName }}</a>
                                </h3>

                                <a class='inner-img fancybox' href="{{ $productImage }}"
                                   data-caption="{{ $productName }}">
                                    <img src='{{ $productImage }}' alt="{{ $productName }}" class='' />
                                </a>
                            </div>
                        </div>

                    @endforeach

                </div>

                <div class="row justify-content-center">
                    {{$products->appends(['category_id'=>$category_id])->links()}}
                </div>


            </div>


        </div>
    </div>
    <!-- CATEGORY PRODUCTS-->
    @include('inc.footer')
@endsection

@section('js')

    <script src="{{asset('js/jquery.fancybox.js')}}"></script>

    <script>

        $(document).ready(function() {
            console.log('here');
            $('.fancybox').fancybox({
                openEffect  : 'fade',
                closeEffect : 'fade',
                beforeShow: function () {
                    this.title = $(this.element).data("caption");
                }
            });
        });


    </script>

@endsection

