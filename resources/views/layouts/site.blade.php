<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <link rel="stylesheet" href="{{asset('dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/assets/owl.theme.default.min.css')}}">

    <title>Akbulut</title>

    @if (LaravelLocalization::getCurrentLocale() == 'ru')

        <link rel="shortcut icon" href="{{asset('images/akbulut_ru.png')}}" type="image/x-icon">

    @elseif(LaravelLocalization::getCurrentLocale() == 'tk')

        <link rel="shortcut icon" href="{{asset('images/akbulut_tk.png')}}" type="image/x-icon">

    @else

        <link rel="shortcut icon" href="{{asset('images/akbulut_en.png')}}" type="image/x-icon">

    @endif





    <style>

        .carousel-item{
            aspect-ratio: 16/7;
        }

        .static-banner-padding {
            width: 80% !important;
            height:80%;
            object-fit: contain !important;
            margin: 0 auto;
            display: block;
        }

    </style>

    @yield('css')


</head>
<body>
@include('inc.navbar_new')
@yield('content')

{{-- //@include('inc.constant_about') --}}

</body>
<script src="{{ asset('js/app.js')}}"></script>
<script src="{{ asset('js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('js/owl.carousel.min.js')}}"></script>

<script>

    $(function(){
        $('.carousel').carousel({
            interval: 5000
        });
    });
</script>

@yield('js')

<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            // navText: [<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"/></svg>, <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"/></svg>],
            responsive: {
                0: {
                    items: 1.5
                },
                600: {
                    items: 2.2
                },
                1000: {
                    items: 4
                }
            }
        })


        const sum = 29;

        $('.calculate_btn').on('click', function (params) {

            params.preventDefault();

            var ini = $('.ini').val();

            var uzynlygy = $('.uzynlygy').val();

            var potolok_type = $(this).val();

            if(ini == null || ini == '' ||  uzynlygy == '' || uzynlygy == null){

                alert('ini ya-da uzynlygyny girin');

                return;
            }

            // winil6060

            var area = uzynlygy * ini;

            var select_potolok = $('.select_potolok').val();

            if(select_potolok == 'winil6060' || select_potolok == 'lay-in-6060'){
                renderLayIn6060OrWinil6060(area);

            } else if(select_potolok == 'clip-in-3030' || select_potolok == 'clip-in-6060')
            {
                renderKlipIn6060(area);

            } else if(select_potolok == 'winil60120')
            {
                renderWinil60120(area);
            }
            console.log(select_potolok);

        })





        function renderLayIn6060OrWinil6060(sum)
        {
            $('.calculator_area_inner').html('').html(`<div class="col-lg-10 col-md-10 col-12 mb-2 mx-auto tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            <div class="col-12 mx-auto">

              <div class=' calc-text text-start d-flex align-items-center row '>
                <img src="{{asset('images/8.jpg')}}" alt="" class='w-20' />
                <p class='col-6 m-0 text-center text-center  '>{{trans('main.vinil')}} 60x60</p>
                <span class='m-0 col-2 fw-bold text-center'>${Math.ceil(sum / 0.36)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/3600mm.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.main-runner')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.22)}</span>
            </div>
              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/13.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>T15/24 {{trans('products.kenar')}} 1200 mm</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 1.25)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/13.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>T15/24 {{trans('products.kenar')}} 600 mm</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 1.25)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/le_profil.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.le-profil')}}:</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.22)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/gosha_yay.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.gosha')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.88)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/metal_dyubel.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.metal_dubel')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.88)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/asgy_sim.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.asgy_sim')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.88)}</span>
              </div>
            </div>
          </div>`);

        }

        function renderKlipIn6060(sum)
        {
            $('.calculator_area_inner').html('').html(`<div class="col-lg-10 col-md-10 col-12 mb-2 mx-auto tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            <div class="col-12 mx-auto">

              <div class=' calc-text text-start d-flex align-items-center row'>
                <img src="{{asset('images/17.jpg')}}" alt="" class='w-20' />
                <p class='col-6 m-0 text-center text-center'>{{trans('main.clip-in')}} 60x60</p>
                <span class='m-0 col-2 fw-bold text-center'>${Math.ceil(sum * 3)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center row'>
                <img src="{{asset('images/15.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.omega')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 1)}</span>
              </div>
              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/c_profil.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.kenar')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 1)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center row'>
                <img src="{{asset('images/12.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.clip-in-connection-piece')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 1)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/le_profil.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.le-profil')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.22)}</span>
              </div>


              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/klip-in_klips.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.clip-in-clips')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.22)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center row'>
                <img src="{{asset('images/4.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.clip-in-asgy-masa')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 1)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center row'>
                <img src="{{asset('images/6.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.basys-takoz')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.88)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/metal_dyubel.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.metal_dubel')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.88)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/asgy_sim.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.asgy_sim')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.88)}</span>
              </div>
            </div>
          </div>`);

        }


        function renderWinil60120(sum)
        {
            $('.calculator_area_inner').html('').html(`<div class="col-lg-10 col-md-10 col-12 mb-2 mx-auto tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            <div class="col-12 mx-auto">

              <div class=' calc-text text-start d-flex align-items-center row '>
                <img src="{{asset('images/8.jpg')}}" alt="" class='w-20' />
                <p class='col-6 m-0 text-center text-center  '>{{trans('main.vinil')}} 60x120:</p>
                <span class='m-0 col-2 fw-bold text-center'>${Math.ceil(sum / 3)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/3600mm.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>T15/24 {{trans('products.main-runner')}} 3600 mm</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.22)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/13.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>T15/24 {{trans('products.kenar')}} 1200 mm </p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 1.25)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/13.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>T15/24 {{trans('products.kenar')}} 600 mm </p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 1.25)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/le_profil.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.le-profil')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.22)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/gosha_yay.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.gosha')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.88)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/metal_dyubel.jpg')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.metal_dubel')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.88)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'>
                <img src="{{asset('images/asgy_sim.png')}}" class='w-20' alt="" />
                <p class='col-6 m-0 text-center'>{{trans('products.asgy_sim')}}</p>
                <span class='col-2 fw-bold text-center'>${Math.ceil(sum * 0.88)}</span>
              </div>

            </div>
          </div>`);

        }




    });

</script>



</html>
