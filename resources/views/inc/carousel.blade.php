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
                $sliderPhoto = $slider->photo ?? asset('images/placeholder.jpg');
                $sliderCaption = $slider->caption ?? '';
            @endphp
            @if($sliderPhoto)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ $sliderPhoto }}" class="d-block w-100" alt="{{ $sliderCaption }}">
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
