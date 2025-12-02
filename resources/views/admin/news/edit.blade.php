@extends('layouts.app')

@section('content')
<section class="content-header">

  </section>
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-12">
                  <h4>create news</h4>
                </div>
                <div class="col-sm-12">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Esasy Sahypa</a></li>
                    <li class="breadcrumb-item active">create news</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>


          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">edit news</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('patch')
                <div class="card-body">

                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group">
                        <label for="name-{{ $localeCode }}">{{ $properties['native'] }} title</label>
                        <input type="text" id="name-{{ $localeCode }}"
                               class="form-control {{ $errors->has('title.' . $localeCode) ? ' is-invalid' : '' }}"
                               name="name_{{ $localeCode }}" value="{{ $news->getTitleTranslationAttr($localeCode) }}" required autocomplete="off">

                               <span class="invalid-feedback" role="alert"><strong>Adyny hökman girizmeli</strong></span>
                    </div>
                    @endforeach

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                        <div class="form-group">
                            <label for="name-{{ $localeCode }}">{{ $properties['native'] }} body</label>
                            <textarea type="text" id="bodypart-{{$localeCode}}" class="form-control {{ $errors->has('body_.' . $localeCode) ? ' is-invalid' : '' }}" name="body_{{ $localeCode }}" value="{{ old('body_.' . $localeCode) }}" required autocomplete="off">{!! $news->getBodyTranslationAttr($localeCode) !!}</textarea>
                                <span class="invalid-feedback" role="alert"><strong>Adyny hökman girizmeli</strong></span>
                        </div>

                    @endforeach

                    <div class="form-group">
                        <label for="images">News Images:</label>
                        <div  id="image_picker" class="row">
                            @if ($news->getMedia('news')->count() > 0)

                                @foreach($news->getMedia('news') as  $photo)

                                    <div class="col-md-4 col-sm-4 col-xs-6 spartan_item_wrapper" data-spartanindexrow="{{-$loop->iteration}}" style="margin-bottom : 20px; ">
                                        <div style="position: relative;">
                                            <div class="spartan_item_loader" data-spartanindexloader="{{-$loop->iteration}}" style=" position: absolute; width: 100%; height: 200px; background: rgba(255,255,255, 0.7); z-index: 22; text-align: center; align-items: center; margin: auto; justify-content: center; flex-direction: column; display : none; font-size : 1.7em; color: #CECECE">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                </svg>
                                            </div>
                                            <input type="hidden" name="old_photos[]" value={{ $photo->id }}>

                                            <label class="file_upload" style="width: 100%; height: 200px; border: 2px dashed #ddd; border-radius: 3px; cursor: pointer; text-align: center; overflow: hidden; padding: 5px; margin-top: 5px; margin-bottom : 5px; position : relative; display: flex; align-items: center; margin: auto; justify-content: center; flex-direction: column;">

                                                <a href="javascript:void(0)"
                                                data-spartanindexremove="{{-$loop->iteration}}"
                                                style="position: absolute !important; right : 3px; top: 3px; display : block; background : #ED3C20; border-radius: 3px; width: 30px; height: 30px; line-height : 30px; text-align: center; text-decoration : none; color : #FFF;" class="spartan_remove_row">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </a>

                                                <img style="width: 100%; margin: 0 auto; vertical-align: middle;" data-spartanindexi="{{-$loop->iteration}}" src="{{$photo->getUrl()}}" class="spartan_image_placeholder">
                                                <p data-spartanlbldropfile="{{-$loop->iteration}}" style="color : #5FAAE1; display: none; width : auto; ">Drop Here</p>
                                                <img style="width: 100%; vertical-align: middle; display:block;" class="img_" data-spartanindeximage="{{-$loop->iteration}}">
                                                <input class="form-control spartan_image_input" accept="image/*"
                                                data-spartanindexinput="{{-$loop->iteration}}" style="display : block" name="old_photoss[]" type="file">
                                            </label>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Main News:</label>

                        <div class="col-sm-9 my-2 d-flex">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="main" id="inlineRadio1" value="1" required="" {{$news->main ? 'checked' : ''}}>
                                <label class="form-check-label" for="inlineRadio1">True</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="main" id="inlineRadio2" value="0"  {{!$news->main ? 'checked' : ''}}>
                                <label class="form-check-label" for="inlineRadio2">False</label>
                            </div>
                        </div>
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

@section('third_party_scripts')

<script  type="text/javascript"  src="{{asset('js/image_picker.min.js')}}"></script>

<script src="{{asset('js/ckeditor.js')}}"></script>

<script type="text/javascript">

$("#image_picker").spartanMultiImagePicker({
    fieldName     : 'images[]',
    dropFileLabel : "Drop Here",

});

class MyUploadAdapter {
    // ...

    constructor( loader ) {
        // The file loader instance to use during the upload. It sounds scary but do not
        // worry — the loader will be passed into the adapter later on in this guide.
        this.loader = loader;
    }

    // Starts the upload process.
    upload() {
        return this.loader.file
            .then( file => new Promise( ( resolve, reject ) => {
                this._initRequest();
                this._initListeners( resolve, reject, file );
                this._sendRequest( file );
            } ) );
    }

    // Aborts the upload process.
    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }

    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        // Note that your request may look different. It is up to you and your editor
        // integration to choose the right communication channel. This example uses
        // a POST request with JSON as a data structure but your configuration
        // could be different.
        xhr.open( 'POST', '{{ route('ckeditor.upload') }}', true );

        xhr.setRequestHeader('x-csrf-token',  '{{ csrf_token() }}');

        xhr.responseType = 'json';
    }

    // Initializes XMLHttpRequest listeners.
    _initListeners( resolve, reject, file ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;

            // This example assumes the XHR server's "response" object will come with
            // an "error" which has its own "message" that can be passed to reject()
            // in the upload promise.
            //
            // Your integration may handle upload errors in a different way so make sure
            // it is done properly. The reject() function must be called when the upload fails.
            if ( !response || response.error ) {
                return reject( response && response.error ? response.error.message : genericErrorText );
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            // This URL will be used to display the image in the content. Learn more in the
            // UploadAdapter#upload documentation.
            resolve( {
                default: response.url
            } );
        } );

        // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
        // properties which are used e.g. to display the upload progress bar in the editor
        // user interface.
        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }

    _sendRequest( file ) {
        // Prepare the form data.
        const data = new FormData();

        data.append( 'upload', file );

        // Important note: This is the right place to implement security mechanisms
        // like authentication and CSRF protection. For instance, you can use
        // XMLHttpRequest.setRequestHeader() to set the request headers containing
        // the CSRF token generated earlier by your application.

        // Send the request.
        this.xhr.send( data );
    }

}


function MyCustomUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}


ClassicEditor
        .create( document.querySelector( '#bodypart-tk' ), {
        extraPlugins: [ MyCustomUploadAdapterPlugin ],

        // ...
    }  )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#bodypart-ru' ), {
        extraPlugins: [ MyCustomUploadAdapterPlugin ],

        // ...
    }  )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#bodypart-en' ), {
        extraPlugins: [ MyCustomUploadAdapterPlugin ],

        // ...
    }  )
        .catch( error => {
            console.error( error );
        } );

</script>

@endsection
