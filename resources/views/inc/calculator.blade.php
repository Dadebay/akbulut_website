<div id="calculator" style="overflow-x: hidden;" class="mb-4 container calculator_area">
    <div class="div after mb-5 pb-1">
        <h2 class='text-start line '>@lang('main.calculator')</h2>
    </div>

    <div class="row mt-2 ">

        <div class="col-lg-4 col-md-5 col-12 mt-4 hasaplamak d-flex justify-content-flex-start flex-column">
          <div class="row">
            <div class="col-lg-12 col-12 mx-auto">
          

              <select class="form-select form-select-lg btn-primary-color mb-3 flex-wrap d-flex select_potolok" aria-label=".form-select-lg example">
                <option value="clip-in-6060">@lang('main.clip-in') 60x60</option>
                <option value="clip-in-3030">@lang('main.clip-in') 30x30</option>
                <option value="lay-in-6060">@lang('main.lay-in') 60x60</option>
                <option value="winil6060">@lang('main.vinil') 60x60</option>
                <option value="winil60120">@lang('main.vinil') 60x120</option>
              </select>
            </div>

          </div>
          <div class=" d-flex mt-2 justify-content-center mx-0 p-0">

            <input type="number" min='1' style="height: 3rem;border-radius:3rem;"  class='form-control mx-0 calc-input ini'  placeholder='{{trans('main.width')}}' />
            <input type="number" min='1' style="height: 3rem;border-radius:3rem;"  class='form-control ms-4 mx-0 calc-input uzynlygy' placeholder='{{trans('main.height')}}' />

          </div>

          <button type='button' class='btn btn-primary btn-primary-color mx-auto btn-lg col-5 col-xl-4 mt-3 mb-5 calculate_btn' style="width:max-content;">@lang('main.calc')</button>
        </div>
        <div class="tab-content calculator_area_inner col-lg-8 text-center" id="nav-tabContent">

          {{-- <div class="col-lg-10 col-md-10 col-12   mb-2 mx-auto tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            <div class="col-12 mx-auto">
    
              <div class=' calc-text text-start d-flex align-items-center row '>
                <img src="{{asset('images/6.jpg')}}" alt="" class='w-20' /> 
                <p class='col-6 m-0 text-center text-center  '>Potolok 60x60:</p>
                <span class='m-0 col-2 fw-bold'>{Math.ceil(sum / 0.36)}</span>
              </div>

              <div class=' calc-text text-start d-flex align-items-center  row'> 
                <img src="{{asset('images/6.jpg')}}" class='w-20' alt="" /> 
                <p class='col-6 m-0 text-center'>T-24 3.60 esasy profil:</p> 
                <span class='col-2 fw-bold'>{Math.ceil(sum * 0.22)}</span> 
              </div>
              <div class=' calc-text text-start d-flex align-items-center  row'> <img src="{{asset('images/6.jpg')}}" class='w-20' alt="" /> <p class='col-6 m-0 text-center'>T-24 1.20 profil:</p> <span class='col-2 fw-bold'>{Math.ceil(sum * 1.25)}</span> </div>
              <div class=' calc-text text-start d-flex align-items-center  row'> <img src="{{asset('images/6.jpg')}}" class='w-20' alt="" /> <p class='col-6 m-0 text-center'>T-24 0.60  profil:</p> <span class='col-2 fw-bold'>{Math.ceil(sum * 1.25)}</span> </div>
              <div class=' calc-text text-start d-flex align-items-center  row'> <img src="{{asset('images/6.jpg')}}" class='w-20' alt="" /> <p class='col-6 m-0 text-center'>3.00m Le profil:</p> <span class='col-2 fw-bold'>{Math.ceil(sum * 0.22)}</span> </div>
              <div class=' calc-text text-start d-flex align-items-center  row'> <img src="{{asset('images/6.jpg')}}" class='w-20' alt="" /> <p class='col-6 m-0 text-center'>Gosha yay:</p> <span class='col-2 fw-bold'>{Math.ceil(sum * 0.88)}</span> </div>
              <div class=' calc-text text-start d-flex align-items-center  row'> <img src="{{asset('images/6.jpg')}}" class='w-20' alt="" /> <p class='col-6 m-0 text-center'>Demir dubel:</p> <span class='col-2 fw-bold'>{Math.ceil(sum * 0.88)}</span> </div>
              <div class=' calc-text text-start d-flex align-items-center  row'> <img src="{{asset('images/6.jpg')}}" class='w-20' alt="" /> <p class='col-6 m-0 text-center'>Asma sim:</p> <span class='col-2 fw-bold'>{Math.ceil(sum * 0.88)}</span> </div>
       
    
            </div>
          </div> --}}
          
        </div>
      </div>
</div>


