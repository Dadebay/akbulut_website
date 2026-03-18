<footer class="ft-root">
  <div class="ft-inner">

    @php $loc = app()->getLocale(); @endphp

    {{-- Top grid --}}
    <div class="ft-grid">

      {{-- Brand column --}}
      <div class="ft-brand">
        <a href="{{ route('web.home') }}" class="ft-logo-wrap">
          @if($loc == 'ru')
            <img src="{{ asset('images/akbulut_ru.png') }}" alt="Akbulut" class="ft-logo">
          @elseif($loc == 'en')
            <img src="{{ asset('images/akbulut_en.png') }}" alt="Akbulut" class="ft-logo">
          @else
            <img src="{{ asset('images/akbulut_tk.png') }}" alt="Akbulut" class="ft-logo">
          @endif
        </a>
        <p class="ft-tagline">@lang('main.mobile_app_text')</p>
        <div class="ft-apps">
          <a href="https://apps.apple.com/us/app/ak-bulut/id1639050009" target="_blank" class="ft-app-btn">
            <img src="{{ asset('images/app_store.svg') }}" alt="App Store">
          </a>
          <a href="https://play.google.com/store/apps/details?id=com.gurbanov.akbulut" target="_blank" class="ft-app-btn">
            <img src="{{ asset('images/play_market.svg') }}" alt="Google Play">
          </a>
        </div>
      </div>

      {{-- Pages column --}}
      <div class="ft-col">
        <h6 class="ft-heading">@lang('main.pages')</h6>
        <ul class="ft-list">
          <li><a href="{{ route('web.home') }}">@lang('main.main_page')</a></li>
          <li><a href="{{ route('about_us') }}">@lang('main.about_us')</a></li>
          <li><a href="{{ route('web.privacy') }}">@lang('main.privacy')</a></li>
          <li><a href="{{ route('category.products') }}">@lang('main.products')</a></li>
          <li><a href="{{ route('web.allnews') }}">@lang('main.news')</a></li>
          <li><a href="#" data-calc-trigger="1">@lang('main.calculator')</a></li>
        </ul>
      </div>

      {{-- Contact column --}}
      <div class="ft-col">
        <h6 class="ft-heading">@lang('main.contact_us')</h6>
        <ul class="ft-list ft-contact">
          <li>
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1C4.79 1 3 2.79 3 5c0 3 4 8 4 8s4-5 4-8c0-2.21-1.79-4-4-4zm0 5.5A1.5 1.5 0 117 3a1.5 1.5 0 010 3z" fill="rgba(255,255,255,0.65)"/></svg>
            <a href="https://www.google.com/maps/place/Ak+bulut+%22HJ%22/@37.9565135,58.4239424,448m/data=!3m1!1e3!4m6!3m5!1s0x3f6fffea54fa4265:0x9e8711703cd46699!8m2!3d37.9563845!4d58.4241547!16s%2Fg%2F11h0bhhg48?entry=ttu" target="_blank">G. Kuliyev st. 29, Ashgabat, Turkmenistan</a>
          </li>
          <li>
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2.5 2h2.1l1 2.5-1.2 1.2c.9 1.8 2.4 3.3 4.2 4.2L9.8 8.7l2.5 1V11.5a1 1 0 01-1 1C4.38 12.5 1.5 5.62 1.5 3.5a1 1 0 011-1z" fill="rgba(255,255,255,0.65)"/></svg>
            <span><a href="tel:+99312754244">+993 12 754244</a>&nbsp; <a href="tel:+99362140044">+993 62 140044</a></span>
          </li>
          <li>
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2.5 2h2.1l1 2.5-1.2 1.2c.9 1.8 2.4 3.3 4.2 4.2L9.8 8.7l2.5 1V11.5a1 1 0 01-1 1C4.38 12.5 1.5 5.62 1.5 3.5a1 1 0 011-1z" fill="rgba(255,255,255,0.65)"/></svg>
            <span><a href="tel:+99312754137">+993 12 754137</a>&nbsp; <a href="tel:+99362240044">+993 62 240044</a></span>
          </li>
          <li>
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="rgba(255,255,255,0.65)" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="12" height="8" rx="1"/><path d="M1 4l6 4.5L13 4"/></svg>
            <a href="mailto:info.akbulut.es@gmail.com">info.akbulut.es@gmail.com</a>
          </li>
        </ul>
      </div>

    </div>

    {{-- Divider --}}
    <div class="ft-divider"></div>

    {{-- Bottom bar --}}
    <div class="ft-bottom">
      <span class="ft-copy">
        @if($loc == 'tk')
          © {{ date('Y') }} "Ak Bulut" Hojalyk Jemgyýeti. Ähli hukuklar goralan.
        @elseif($loc == 'ru')
          © {{ date('Y') }} ХО "Ak Bulut". Все права защищены.
        @else
          © {{ date('Y') }} "Ak Bulut" Economic Society. All rights reserved.
        @endif
      </span>
      <a href="{{ route('web.privacy') }}" class="ft-privacy-link">@lang('main.privacy')</a>
    </div>

  </div>
</footer>
