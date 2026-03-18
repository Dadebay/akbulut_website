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

    <link rel="shortcut icon" href="{{ asset('images/mini_logo_rounded.png') }}" type="image/png">





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

@include('inc.calculator')
</body>
<script src="{{ asset('js/app.js')}}"></script>
<script src="{{ asset('js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('js/owl.carousel.min.js')}}"></script>

<script>

    // (Bootstrap carousel replaced by custom hero slider — no .carousel() init needed)

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

        // ── Modal open/close ──────────────────────────────────────
        function openCalcModal() {
            var overlay = document.getElementById('calcModalOverlay');
            if (!overlay) {
                // On pages where calculator is not included, redirect to welcome#calculator
                window.location.href = '{{ route("web.welcome") }}#calculator';
                return;
            }
            overlay.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeCalcModal() {
            var overlay = document.getElementById('calcModalOverlay');
            if (overlay) {
                overlay.classList.remove('is-open');
                document.body.style.overflow = '';
                // Reset inputs and results
                $('.ini, .uzynlygy').val('').css({'border-color':'', 'box-shadow':''});
                $('#calcResults').html(`<div class="calc-empty">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="16" y2="10"/><line x1="8" y1="14" x2="12" y2="14"/></svg>
                    <p>{{ trans('main.width') }} × {{ trans('main.height') }} giriziň we hasaplaň</p>
                </div>`);
                $('#calcDivider').hide();
                // Scroll modal back to top
                var modal = document.getElementById('calcModal');
                if (modal) modal.scrollTop = 0;
            }
        }

        // Navbar calculator button (present on every page via navbar)
        $(document).on('click', '[data-calc-trigger]', function(e) {
            e.preventDefault();
            openCalcModal();
        });

        // Hash-based open (clicking #calculator anchor link)
        if (window.location.hash === '#calculator') {
            $(document).ready(function() { openCalcModal(); });
        }

        // Close button
        $(document).on('click', '#calcModalClose', function() { closeCalcModal(); });

        // Overlay click closes modal
        $(document).on('click', '#calcModalOverlay', function(e) {
            if (e.target === this) closeCalcModal();
        });

        // ESC key
        $(document).on('keyup', function(e) {
            if (e.key === 'Escape') closeCalcModal();
        });

        // ── Calculate button ──────────────────────────────────────
        function showCalcResults(html) {
            var area = $('.calc-area-badge, .calc-empty', '#calcResults');
            $('#calcResults').html(html);
            $('#calcDivider').show();
            // Smooth scroll inside modal
            var modal = document.getElementById('calcModal');
            if (modal) {
                setTimeout(function() {
                    modal.scrollTo({ top: modal.scrollHeight, behavior: 'smooth' });
                }, 50);
            }
        }

        $('.calculate_btn').on('click', function (params) {

            params.preventDefault();

            var ini = $('.ini').val();
            var uzynlygy = $('.uzynlygy').val();

            if(ini == null || ini == '' ||  uzynlygy == '' || uzynlygy == null){
                // Highlight empty fields instead of alert
                if (!ini || ini == '') $('.ini').css({'border-color':'#e53e3e','box-shadow':'0 0 0 4px rgba(229,62,62,0.12)'});
                if (!uzynlygy || uzynlygy == '') $('.uzynlygy').css({'border-color':'#e53e3e','box-shadow':'0 0 0 4px rgba(229,62,62,0.12)'});
                return;
            }
            $('.ini, .uzynlygy').css({'border-color':'', 'box-shadow':''});

            var area = uzynlygy * ini;
            var select_potolok = $('.select_potolok').val();

            if(select_potolok == 'winil6060' || select_potolok == 'lay-in-6060'){
                renderLayIn6060OrWinil6060(area);
            } else if(select_potolok == 'clip-in-3030' || select_potolok == 'clip-in-6060') {
                renderKlipIn6060(area);
            } else if(select_potolok == 'winil60120') {
                renderWinil60120(area);
            }

        })





        function renderLayIn6060OrWinil6060(sum)
        {
            var html = `<div class="calc-area-badge"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/></svg> ${sum.toFixed(2)} m²</div>
            <div class="calc-results-heading">{{trans('main.calc')}}</div>
            <div class="calc-result-row"><img src="{{asset('images/8.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('main.vinil')}} 60x60</span><span class="calc-result-qty">${Math.ceil(sum / 0.36)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/3600mm.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.main-runner')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.22)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/13.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">T15/24 {{trans('products.kenar')}} 1200 mm</span><span class="calc-result-qty">${Math.ceil(sum * 1.25)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/13.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">T15/24 {{trans('products.kenar')}} 600 mm</span><span class="calc-result-qty">${Math.ceil(sum * 1.25)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/le_profil.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.le-profil')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.22)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/gosha_yay.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.gosha')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.88)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/metal_dyubel.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.metal_dubel')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.88)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/asgy_sim.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.asgy_sim')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.88)}</span></div>`;
            showCalcResults(html);
        }

        function renderKlipIn6060(sum)
        {
            var html = `<div class="calc-area-badge"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/></svg> ${sum.toFixed(2)} m²</div>
            <div class="calc-results-heading">{{trans('main.calc')}}</div>
            <div class="calc-result-row"><img src="{{asset('images/17.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('main.clip-in')}} 60x60</span><span class="calc-result-qty">${Math.ceil(sum * 3)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/15.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.omega')}}</span><span class="calc-result-qty">${Math.ceil(sum * 1)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/c_profil.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.kenar')}}</span><span class="calc-result-qty">${Math.ceil(sum * 1)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/12.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.clip-in-connection-piece')}}</span><span class="calc-result-qty">${Math.ceil(sum * 1)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/le_profil.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.le-profil')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.22)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/klip-in_klips.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.clip-in-clips')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.22)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/4.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.clip-in-asgy-masa')}}</span><span class="calc-result-qty">${Math.ceil(sum * 1)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/6.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.basys-takoz')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.88)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/metal_dyubel.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.metal_dubel')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.88)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/asgy_sim.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.asgy_sim')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.88)}</span></div>`;
            showCalcResults(html);
        }


        function renderWinil60120(sum)
        {
            var html = `<div class="calc-area-badge"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/></svg> ${sum.toFixed(2)} m²</div>
            <div class="calc-results-heading">{{trans('main.calc')}}</div>
            <div class="calc-result-row"><img src="{{asset('images/8.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('main.vinil')}} 60x120</span><span class="calc-result-qty">${Math.ceil(sum / 3)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/3600mm.png')}}" class="calc-result-thumb"><span class="calc-result-name">T15/24 {{trans('products.main-runner')}} 3600 mm</span><span class="calc-result-qty">${Math.ceil(sum * 0.22)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/13.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">T15/24 {{trans('products.kenar')}} 1200 mm</span><span class="calc-result-qty">${Math.ceil(sum * 1.25)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/13.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">T15/24 {{trans('products.kenar')}} 600 mm</span><span class="calc-result-qty">${Math.ceil(sum * 1.25)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/le_profil.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.le-profil')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.22)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/gosha_yay.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.gosha')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.88)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/metal_dyubel.jpg')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.metal_dubel')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.88)}</span></div>
            <div class="calc-result-row"><img src="{{asset('images/asgy_sim.png')}}" class="calc-result-thumb"><span class="calc-result-name">{{trans('products.asgy_sim')}}</span><span class="calc-result-qty">${Math.ceil(sum * 0.88)}</span></div>`;
            showCalcResults(html);
        }




    });

</script>



</html>
