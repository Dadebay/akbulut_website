<div class="container-fluid carousel">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
                @foreach ($sliders ?? [] as $slider)
                @php
                    $slider = is_array($slider) ? (object)$slider : $slider;
                @endphp
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$loop->index}}"
                class="{{ $loop->first ? 'active' : '' }}"
                    aria-current="true" aria-label="Slide {{$loop->index + 1}}"></button>
                @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($sliders ?? [] as $slider)
            @php
                $slider = is_array($slider) ? (object)$slider : $slider;
                $backendPhoto = $slider->photo ?? '';
                $isStaticImage = false;
                
                // Check if this is the specific banner that needs language variants (ID 770)
                // Only this banner uses static images for EN/RU, others use backend photos
                if (str_contains($backendPhoto, 'home_sliders/770')) {
                    // This is the main banner - use language-specific static images
                    if (LaravelLocalization::getCurrentLocale() == 'ru') {
                        $sliderPhoto = asset('images/akbulut_ru.png');
                        $isStaticImage = true;
                    } elseif (LaravelLocalization::getCurrentLocale() == 'en') {
                        $sliderPhoto = asset('images/akbulut_en.png');
                        $isStaticImage = true;
                    } else {
                        // For Turkmen, use the backend photo
                        $sliderPhoto = $backendPhoto ?: asset('images/akbulut_tk.png');
                    }
                } else {
                    // For all other banners, always use the backend photo regardless of language
                    $sliderPhoto = $backendPhoto ?: asset('images/placeholder.jpg');
                }
                
                $sliderCaption = $slider->caption ?? '';
            @endphp
            @if($sliderPhoto)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ $sliderPhoto }}" class="d-block w-100 {{ $isStaticImage ? 'static-banner-padding' : '' }}" alt="{{ $sliderCaption }}">
                    @if($sliderCaption)
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $sliderCaption }}</h5>
                    </div>
                    @endif
                </div>
            @endif
            @endforeach


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
