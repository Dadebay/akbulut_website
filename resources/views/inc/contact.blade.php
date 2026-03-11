


<div id="contact" class='container-fluid p-lg-5 p-3 mt-5 contact'>
    
    <div class="container mx-auto">
        <h2 class='text-center text-white mb-5 contact-text'>@lang('main.contact_us_header')</h2>
        <form class='contact_form row'>

              <div class="form-floating col-md-6 col-xs-12 col-lg-6 mb-3">
                <input type="email" style="background: none;color: #fff;" class="form-control" id="floatingInput" name="contact_name" autocomplete="off" placeholder="name@example.com">
                <label for="floatingInput" style="left: 10px;">@lang('main.name')</label>
              </div>
              
              <div class="form-floating col-md-6 col-xs-12 col-lg-6">
                <input type="tel" style="background: none;color: #fff;" class="form-control" id="floatingTel" name="contact_phone" autocomplete="off" placeholder="Telefon">
                <label for="floatingPassword" style="left: 10px;">@lang('main.phone')</label>
              </div>

              <div class="form-floating mt-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="text_body" style="height: 100px;background: none;color: #fff;"></textarea>
                <label for="floatingTextarea2" style="left: 10px;">@lang('main.type_message')</label>
              </div>

              <div class="justify-content-center d-flex col-md-12 col-xs-12 col-lg-12 col-xl-12 my-3">
                <button class="btn btn-lg btn-primary contact-btn" style="background: #0a529e;width:20%;min-width:max-content;">@lang('main.send')</button>
              </div>
            {{-- <div class="info  my-4">

                <input type="text" placeholder='FIO' class="input-contact fio" name="fio">
                <div class="number-input d-flex justidy-content-center align-items-center">

                    <label>+993</label>
                    <input type="number" placeholder='Phone' class="ms-2 p-0 w-100 phone" name="phone">
                </div>
            </div>

            <div class="info-text my-2 w-100">

                <input type="text" placeholder='Message' class='input-contact w-100' name="text_body" />
            </div>

            <div class="contact-btn col-lg-2 col-8 mx-auto mt-4 p-3 mb-2" id="liveToastBtn">@lang('main.send')</div> --}}
        </form>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        {{-- <img src="..." class="rounded me-2" alt="..."> --}}
        <strong class="me-auto">Uns berin</strong>
        <small>Suwagt</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
            Sizin habarynyz ugradyldy
      </div>
    </div>
  </div>