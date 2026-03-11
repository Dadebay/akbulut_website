<header>
    <nav class="navbar navbar-expand-lg header-nav mx-auto">
        <div class="container-fluid container-lg">

          <a class="navbar-brand" href="{{route('web.home')}}">
            @if (LaravelLocalization::getCurrentLocale() == 'ru')
              <img class="logo" src="{{asset('images/akbulut_ru.png')}}" alt="Akbulut">
            @elseif(LaravelLocalization::getCurrentLocale() == 'en')
              <img class="logo" src="{{asset('images/akbulut_en.png')}}" alt="Akbulut">
            @else
              <img class="logo" src="{{asset('images/akbulut_tk.png')}}" alt="Akbulut">
            @endif
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link {{ request()->is('turkmen-gips*') ? 'navbar_active' : '' }} mx-2 px-3" href="{{route('turkmen.gips')}}">@lang('main.turkmen_gips')</a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ request()->is('welcome*') ? 'navbar_active' : '' }} mx-2 px-3" href="{{route('web.welcome')}}">@lang('main.main_page')</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('about_us*') ? 'navbar_active' : '' }}  mx-2 px-3" aria-current="page" href="{{route('about_us')}}">@lang('main.about_us')</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('products*') ? 'navbar_active' : '' }}  mx-2 px-3" href="{{route('category.products')}}">@lang('main.products')</a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ request()->is('news*') ? 'navbar_active' : '' }} mx-2 px-3" href="{{route('web.allnews')}}">@lang('main.news')</a>
              </li>

              <li class="nav-item">
                <a class="nav-link mx-2 px-3 calculator_nav" href="{{route('web.welcome')}}#calculator">@lang('main.calculator')</a>
              </li>

              <li class="nav-item" style="margin-right: 1rem;">
                <a class="nav-link mx-2 px-3 contact_btn_nav" href="{{route('web.welcome')}}#contact">@lang('main.contact_us')</a>
              </li>
            </ul>
          
            <ul class="navbar-nav ml-auto" style="border-left: 2px solid #0a529e;">
                <div class="dropdown">
                    <a class="link-dark text-decoration-none d-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      @if (LaravelLocalization::getCurrentLocale() == 'ru')
                      <img src="{{asset('images/ru.svg')}}" width="32" alt="Russian">
                          
                      @elseif(LaravelLocalization::getCurrentLocale() == 'tk')
                      <img src="{{asset('images/tm.svg')}}" width="32" alt="Turkmen">
                      @else
                      <img src="{{asset('images/us.svg')}}" width="32" alt="English">
                      
                      @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a rel="alternate" class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                          {{ $properties['native'] }}
                        </a>
                      @endforeach
            
                    </div>
                  </div>
                
            </ul>
          </div>
        </div>
      </nav>
</header>