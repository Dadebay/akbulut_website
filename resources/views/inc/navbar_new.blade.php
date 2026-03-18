@php use Illuminate\Support\Str; @endphp
@php
  $navLinks = [
    [
      'label' => trans('main.turkmen_gips'),
      'href' => route('turkmen.gips'),
      'pattern' => '*/turkmen-gips*',
    ],
    [
      'label' => trans('main.main_page'),
      'href' => route('web.welcome'),
      'pattern' => '*/welcome*',
    ],
    [
      'label' => trans('main.products'),
      'href' => route('category.products'),
      'pattern' => '*/products*',
    ],
    [
      'label' => trans('main.news'),
      'href' => route('web.allnews'),
      'pattern' => '*/news*',
    ],
    [
      'label' => trans('main.calculator'),
      'href' => '#',
      'pattern' => null,
      'variant' => 'ghost',
      'attrs' => 'id="calcNavBtn" data-calc-trigger="1"',
    ],
    [
      'label' => trans('main.about_us'),
      'href' => route('about_us'),
      'pattern' => '*/about_us*',
    ],
    [
      'label' => trans('main.privacy'),
      'href' => route('web.privacy'),
      'pattern' => '*/privacy*',
    ],
    [
      'label' => trans('main.contact_us'),
      'href' => route('web.welcome') . '#contact',
      'pattern' => null,
      'variant' => 'cta',
    ],
  ];

  $supportedLocales = LaravelLocalization::getSupportedLocales();
  $currentLocale = LaravelLocalization::getCurrentLocale();
  $flagMap = [
    'ru' => asset('images/ru.svg'),
    'en' => asset('images/us.svg'),
    'tk' => asset('images/tm.svg'),
  ];
  $currentFlag = $flagMap[$currentLocale] ?? $flagMap['en'];
  $currentLanguage = Str::ucfirst($supportedLocales[$currentLocale]['native'] ?? strtoupper($currentLocale));
@endphp

<header class="sn-header">
  <nav class="navbar navbar-expand-lg sn-nav">
    <div class="container-fluid sn-inner">

      {{-- Logo --}}
      <a class="navbar-brand sn-logo" href="{{ route('web.home') }}">
        @if ($currentLocale == 'ru')
          <img src="{{ asset('images/akbulut_ru.png') }}" alt="Akbulut">
        @elseif($currentLocale == 'en')
          <img src="{{ asset('images/akbulut_en.png') }}" alt="Akbulut">
        @else
          <img src="{{ asset('images/akbulut_tk.png') }}" alt="Akbulut">
        @endif
      </a>

      {{-- Mobile toggle --}}
      <button class="navbar-toggler sn-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#snMenu" aria-controls="snMenu" aria-expanded="false"
              aria-label="Toggle navigation">
        <span></span><span></span><span></span>
      </button>

      {{-- Collapsible area --}}
      <div class="collapse navbar-collapse" id="snMenu">
        <div class="sn-collapse">

          {{-- Nav links --}}
          <div class="sn-links">
            @foreach($navLinks as $link)
              @php
                $isActive = $link['pattern'] ? request()->is($link['pattern']) : false;
                $variant  = $link['variant'] ?? 'default';
                $extraAttrs = $link['attrs'] ?? '';
              @endphp
              <a href="{{ $link['href'] }}"
                 class="sn-link sn-link--{{ $variant }}{{ $isActive ? ' sn-link--active' : '' }}"
                 {!! $extraAttrs !!}>
                {{ $link['label'] }}
                @if ($isActive && $variant === 'default')<span class="sn-active-dot"></span>@endif
              </a>
            @endforeach
          </div>

          {{-- Language picker --}}
          <details class="sn-lang">
            <summary>
              <span class="sn-lang-pill">
                <img src="{{ $currentFlag }}" alt="{{ $currentLanguage }}" width="24" height="17">
                <span class="sn-lang-name">{{ $currentLanguage }}</span>
                <svg class="sn-lang-caret" width="12" height="8" viewBox="0 0 12 8" fill="none">
                  <path d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
            </summary>
            <div class="sn-lang-panel">
              <p class="sn-lang-heading">{{ __('Select language') }}</p>
              @foreach($supportedLocales as $localeCode => $properties)
                @php $panelFlag = $flagMap[$localeCode] ?? $flagMap['en']; @endphp
                <a rel="alternate" hreflang="{{ $localeCode }}"
                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                   class="sn-lang-option{{ $localeCode === $currentLocale ? ' sn-lang-option--active' : '' }}">
                  <span class="sn-lang-opt-left">
                    <img src="{{ $panelFlag }}" alt="{{ Str::ucfirst($properties['native']) }}" width="22" height="16">
                    <span>{{ Str::ucfirst($properties['native']) }}</span>
                  </span>
                  <span class="sn-lang-code">{{ strtoupper($localeCode) }}</span>
                </a>
              @endforeach
            </div>
          </details>

        </div>{{-- /.sn-collapse --}}
      </div>{{-- /.collapse.navbar-collapse --}}

    </div>
  </nav>
</header>