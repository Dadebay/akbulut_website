{{-- <div class="container-fluid navbar p-3">
  <div class="container d-flex  justify-content-between align-items-center">
      <div class="logo">
        <a class="nav-link" href="{{url('/')}}">
          <img src="{{asset('images/logo.png')}}" alt="Akbulut">
        </a>
      </div>
      <ul class="links gap-4 d-flex justify-content-between align-items-center">
          <li>
              <a href="">Biz barada</a>
          </li>
          <li>
              <a href="">Onumler</a>
          </li>
          <li>
              <a href="">Habarlar</a>
          </li>
          <li>
              <a href="">Kalkulyator</a>
          </li>
          <li>
              <a href="">Habarlasmak</a>
          </li>
      </ul>
      <div class="search d-flex justify-content-between align-items-center">

        

          <select class="form-select me-4 "> 

              <option selected>TM</option>
              <option value="2">RU</option>
              <option value="3">EN</option>




          </select>

          <i class="fa-solid fa-magnifying-glass">asd</i>
      </div>


  </div>
</div> --}}







<div class="outer" style="border-bottom: 1px solid #eee;width: 100%;">
<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
    <a href="{{route('web.home')}}" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
      <img class="logo" style="height: 6vw;" src="{{asset('images/logo.png')}}" alt="Akbulut">
    </a>  

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="{{route('web.welcome')}}" class="nav-link px-2">@lang('main.main_page')</a></li>
      <li><a href="{{route('about_us')}}" class="nav-link px-2">@lang('main.about_us')</a></li>
      <li><a href="{{route('category.products')}}" class="nav-link px-2">@lang('main.products')</a></li>
      <li><a href="{{route('web.allnews')}}" class="nav-link px-2">@lang('main.news')</a></li>
    </ul>

    <div class="col-md-3 text-end">
      {{-- <div class="dropdown">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
          <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>

        <ul class="dropdown-menu text-small" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(122px, 34px);">
          <li><a class="dropdown-item" href="#">New project...</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
      </div> --}}
      <div class="dropdown">
        <a class="link-dark text-decoration-none d-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          {{-- <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle"> --}}
          {{-- {{LaravelLocalization::getCurrentLocale()}} --}}
          @if (LaravelLocalization::getCurrentLocale() == 'ru')
          <img src="{{asset('images/ru.svg')}}" width="32" height="32" alt="Russian">
              
          @elseif(LaravelLocalization::getCurrentLocale() == 'tk')
          <img src="{{asset('images/tm.svg')}}" width="32" height="32" alt="Turkmen">
          @else
          <img src="{{asset('images/us.svg')}}" width="32" height="32" alt="Usa">
          
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a rel="alternate" class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
              {{ $properties['native'] }}
            </a>
          {{-- <a class="dropdown-item" type="button">Action</button> --}}
      @endforeach


          {{-- <button class="dropdown-item" type="button">Action</button>
          <button class="dropdown-item" type="button">Another action</button>
          <button class="dropdown-item" type="button">Something else here</button> --}}
        </div>
      </div>
    </div>
  </header>
</div>
</div>