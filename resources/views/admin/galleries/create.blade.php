@extends('layouts.app')

@section('content')
<section class="content-header">

  </section>
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h4>Gallery goş</h4>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Esasy Sahypa</a></li>
                    <li class="breadcrumb-item active">Gallery goş</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>


          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">täze gallery</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ route('galleries.store') }}" 
                enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach   
                        
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="form-group">
                            <label for="name-{{ $localeCode }}">{{ $properties['native'] }} caption</label>
                            <input type="text" id="name-{{ $localeCode }}"
                                class="form-control 
                                {{ $errors->has('caption_.' . $localeCode) ? ' is-invalid' : '' }}"

                                name="caption_{{ $localeCode }}"
                                 value="{{ old('caption_.' . $localeCode) }}"
                                   autocomplete="off">

                                <span class="invalid-feedback" role="alert"><strong>Adyny hökman girizmeli</strong></span>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label for="parent_id">Image</label>
                        <input type="file" name="gallery_image" class="form-control" id="" accept="image/png, image/gif, image/jpeg" required>
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
