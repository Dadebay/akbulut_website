@extends('layouts.app')

@section('content')
<section class="content-header">
    
  </section>
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h4>Slider goş</h4>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Esasy Sahypa</a></li>
                    <li class="breadcrumb-item active">Gallery edit</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">edit slider</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ route('sliders.update', $slider->id) }}" 
                enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                <div class="card-body">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach  
                        
                      <div class="form-group">
                  <label for="caption">Caption tk:</label>
                  <input type="text" name="caption_tk" id="caption" class="form-control" value="{{$slider->caption_tk}}" placeholder="enter caption.." required>
                </div>
                
                  <div class="form-group">
                  <label for="caption">description text tk:</label>
                  <input type="text" name="desc_tk" id="caption" value="{{$slider->desc_tk}}" class="form-control" placeholder="enter description for slider.." required>
                </div>
                
                <hr>
                
                    <div class="form-group">
                  <label for="caption">Caption ru:</label>
                  <input type="text" name="caption_ru" id="caption" value="{{$slider->caption_ru}}" class="form-control" placeholder="caption gir turkmence.." required>
                </div>
                
                  <div class="form-group">
                  <label for="caption">description text ru:</label>
                  <input type="text" name="desc_ru" id="caption" value="{{$slider->desc_ru}}" class="form-control" placeholder="enter description for slider in russian.." required>
                </div>
                
                <hr>
                
                    <div class="form-group">
                  <label for="caption">Caption en:</label>
                  <input type="text" name="caption_en" id="caption" value="{{$slider->caption_en}}" class="form-control" placeholder="enter caption english.." required>
                </div>
                
                  <div class="form-group">
                  <label for="caption">description text en:</label>
                  <input type="text" name="desc_en" id="caption" value="{{$slider->desc_en}}" class="form-control" placeholder="enter description for slider in english.." required>
                </div>
                
                <hr>

                    <div class="form-group">
                        <label for="parent_id">Image</label>
                        <a href="{{ !is_null($slider->getFirstMedia('home_sliders')) ? $slider->getFirstMedia('home_sliders')->getUrl('card') : asset('images/profile.png') }}">{{!is_null($slider->getFirstMedia('home_sliders')) ? $slider->getFirstMedia('home_sliders')->getUrl('thumb') : asset('images/profile.png')}}</a>
                        <input type="file" name="slider_image" class="form-control" id="">
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>





    </div>
@endsection
