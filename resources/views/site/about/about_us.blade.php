@extends('layouts.site')


@section('content')

    <div class="container" style="min-height: 100vh;">
      
            <div class="brad">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-primary-color" href="{{route('web.home')}}">{{ trans('main.main_page') }}</a></li>
                    <li class="breadcrumb-item">@lang('main.about_us')</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-md-4">
                @if(app()->getLocale() == 'en')
                    <a href="{{asset('files/akbulut_barada_en.pdf')}}" target="_blank" class="pdf-link">
                        <img src="{{asset('images/pdf.png')}}" alt="PDF Icon" class="pdf-icon" style="width: 50px; height: 50px;">
                        @lang('main.aboutAkbulut')
                    </a>
                @endif
                @if(app()->getLocale() == 'ru')
                    <a href="{{asset('files/akbulut_barada_ru.pdf')}}" target="_blank" class="pdf-link">
                        <img src="{{asset('images/pdf.png')}}" alt="PDF Icon" class="pdf-icon" style="width: 50px; height: 50px;">
                        @lang('main.aboutAkbulut')
                    </a>
                @endif  
                @if(app()->getLocale() == 'tk')
                    <a href="{{asset('files/akbulut_barada_tm.pdf')}}" target="_blank" class="pdf-link">
                        <img src="{{asset('images/pdf.png')}}" alt="PDF Icon" class="pdf-icon" style="width: 50px; height: 50px;">
                        @lang('main.aboutAkbulut')
                    </a>
                @endif  
                
                </div>
                

                <div class="col-md-4">
                <a href="{{asset('files/iso.pdf')}}" target="_blank" class="pdf-link">
                    <img src="{{asset('images/pdf.png')}}" alt="PDF Icon" class="pdf-icon" style="width: 50px; height: 50px;">
                    @lang('main.iso_certificate')
                </a>
                </div> 

                <div class="col-md-4">
                <a href="{{asset('files/appendix.pdf')}}" target="_blank" class="pdf-link">
                    <img src="{{asset('images/pdf.png')}}" alt="PDF Icon" class="pdf-icon" style="width: 50px; height: 50px;">
                    @lang('main.appendix')
                </a>
                </div> 
            </div>



            <h1 class="text-center mt-5">@lang('main.about_us')</h1>

            <div class="row mt-5">
                @php
                    $aboutUs = is_array($aboutUs) ? (object)$aboutUs : $aboutUs;
                    $aboutBody = $aboutUs->body ?? '';
                @endphp

                {!! $aboutBody !!}

            </div>
       
    </div>
        @include('inc.footer')
@endsection

@section('js')


    
@endsection

