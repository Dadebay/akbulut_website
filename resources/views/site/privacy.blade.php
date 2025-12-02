@extends('layouts.site')


@section('content')

    <div class="container" style="min-height: 100vh;">
      
            <div class="brad">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-primary-color" href="{{route('web.home')}}">{{ trans('main.main_page') }}</a></li>
                    <li class="breadcrumb-item">@lang('main.privacy')</li>
                </ol>
            </div>


            <div class="row mt-5">
                @php
                    $aboutUs = is_array($aboutUs) ? (object)$aboutUs : $aboutUs;
                    $privacyBody = $aboutUs->body ?? '';
                @endphp

                {!! $privacyBody !!}

            </div>
       
    </div>
        @include('inc.footer')
@endsection

@section('js')


    
@endsection

