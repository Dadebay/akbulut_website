@extends('layouts.app')

@section('content')
<section class="content-header">

  </section>
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h4>Kategoriýa goş</h4>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Esasy Sahypa</a></li>
                    <li class="breadcrumb-item active">Kategoriýa goş</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>


          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">täze kategoriýa</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                <div class="card-body">

                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach   
                        
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="form-group">
                            <label for="name-{{ $localeCode }}">{{ $properties['native'] }} ady</label>
                            <input type="text" id="name-{{ $localeCode }}"
                                class="form-control {{ $errors->has('name.' . $localeCode) ? ' is-invalid' : '' }}"
                                name="name_{{ $localeCode }}" value="{{ $category->getNameTranslationAttr($localeCode) }}" required autocomplete="off">

                                <span class="invalid-feedback" role="alert"><strong>Adyny hökman girizmeli</strong></span>
                        </div>
                    @endforeach

                <div class="form-group">
                  <label for="parent_id">Parent Category</label>
                  <select name="parent_id" id="parent_id" class="form-control">
                    <option disabled selected>Select parent Category</option>
                    @foreach ($parent_categories as $item)
                        <option value="{{$item->id}}" 
                            {{$category->parent &&  $category->parent->id == $item->id ? 'selected' : ''}}>{{$item->name_tk}}</option>
                        
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="parent_id">Image</label>
                  <input type="file" name="category_image" class="form-control" id="">
                </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>





    </div>
@endsection
