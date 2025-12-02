@extends('layouts.app')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('content')
<section class="content-header">

  </section>
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
               
                <div class="col-sm-12">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Esasy Sahypa</a></li>
                    <li class="breadcrumb-item active">file manager</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <div class="col-md-12">
            <h4>akbulut file manager</h4>
            <div class="row">
                <div class="col-md-12" id="fm-main-block">
                    <div id="fm"></div>
                </div>
            </div>
          </div>
    </div>
@endsection

@section('third_party_scripts')

 <!-- File manager -->
 <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
 <script>
   document.addEventListener('DOMContentLoaded', function() {
     document.getElementById('fm-main-block').setAttribute('style', 'height:' + window.innerHeight + 'px');

     fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
       window.opener.fmSetLink(fileUrl);
       window.close();
     });
   });
 </script>
    
@endsection
