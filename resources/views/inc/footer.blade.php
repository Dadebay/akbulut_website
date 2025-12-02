<div class="main_footer">
<div class="container pt-5">

    <footer>
      <div class="row">
        <div class="col-6 col-md-2 mb-3 d-none d-lg-block">
          <h5 class="text-uppercase mb-3">@lang('main.pages')</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="{{route('web.home')}}" class="text-decoration-none p-0 ">@lang('main.main_page')</a></li>
            <li class="nav-item mb-2"><a href="{{route('about_us')}}" class="text-decoration-none p-0 ">@lang('main.about_us')</a></li>
            <li class="nav-item mb-2"><a href="{{route('category.products')}}" class="text-decoration-none p-0">@lang('main.products')</a></li>
            <li class="nav-item mb-2"><a href="{{route('web.allnews')}}" class="text-decoration-none p-0 ">@lang('main.news')</a></li>
            <li class="nav-item mb-2"><a href="{{route('web.welcome')}}#calculator" class="text-decoration-none calculator_nav p-0">@lang('main.calculator')</a></li>
          </ul>
        </div>
  
        <div class="col-md-4 col-xs-12 mb-3 text-center text-lg-start">
          <h5 class="text-uppercase mb-3">@lang('main.contact_us')</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a class="text-decoration-none text-white p-0 ">@lang('main.head_office')</a></li>
            <li class="nav-item mb-2"><a href="https://www.google.com/maps/place/Ak+bulut+%22HJ%22/@37.9563887,58.421966,17z/data=!3m1!4b1!4m5!3m4!1s0x3f6fffea54fa4265:0x9e8711703cd46699!8m2!3d37.9563845!4d58.4241547" target="_blank" class="text-decoration-none p-0">G. Kuliyev st. 29, Ashgabat city, Turkmenistan</a></li>
            <li class="nav-item mb-2">
                <span class="nav-link p-0 text-white d-block">
                  
                    <div class="d-flex justify-content-center justify-content-lg-start"><a class="text-decoration-none" href="tel:+99312754244">+99312754244,</a> &nbsp;&nbsp;<a class="text-decoration-none" href="tel:+99362140044"> +99362140044,</a></div>
                </span>
                
            </li>
            
             <li class="nav-item mb-2">
                <span href="#" class="nav-link p-0 text-white d-block">
                    <div class="d-flex justify-content-center justify-content-lg-start"><a class="text-decoration-none" href="tel:+99312754137">+99312754137,</a> &nbsp;&nbsp;<a class="text-decoration-none" href="tel:+99362240044"> +99362240044,</a></div>
                    
                </span>
                
            </li>
            <li class="nav-item mb-2"><a href="mailto:info.akbulut.es@gmail.com" class="text-decoration-none p-0">info.akbulut.es@gmail.com</a></li>
          </ul>
        </div>
  
        <div class="col-md-5 offset-md-1 mb-3 text-center text-lg-end">
          <form>
            <h5 class="text-uppercase mb-3">@lang('main.mobile_app')</h5>
            <p>@lang('main.mobile_app_text')</p>

            <p class="privacy">
              <a href="{{route('web.privacy')}}" class="text-decoration-none p-0 mb-1"> @lang('main.privacy')
              </a>
            </p>


            <div class="md-d-flex flex-column flex-sm-row w-100 gap-2">
         
                <a target="_blank" class="text-decoration-none" href="https://apps.apple.com/us/app/ak-bulut/id1639050009">
                    <img src="{{asset('images/app_store.svg')}}"/>
                </a>
                <a target="_blank" class="text-decoration-none" href="https://play.google.com/store/apps/details?id=tm.com.akbulut_app">
                    <img src="{{asset('images/play_market.svg')}}"/>
                </a>

            </div>
          </form>
        </div>
      </div>
  
      <div class="container-fluid d-flex flex-column flex-sm-row justify-content-center mt-4">
          @if(app()->getLocale() == 'tk')
             <p class="text-center">© 2022 “Ak Bulut” Hojalyk Jemgyýeti. Ähli hukuklar goralan.</p>
          @elseif(app()->getLocale() == 'ru')
             <p class="text-center">© 2022 ХО “Ak Bulut”. Все права защищены.</p>
          @else
             <p class="text-center">© 2022 “Ak Bulut” Economic Society. All rights reserved.</p>
          @endif 
             
      </div>
    </footer>
  </div>

</div>