@extends('layouts.app')

@section('content')
<section class="content-header">

  </section>
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-12">
                  <h4>create about us text</h4>
                </div>
                <div class="col-sm-12">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Esasy Sahypa</a></li>
                    <li class="breadcrumb-item active">create about us text</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>


          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">täze about us text</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ route('abouts.store') }}" novalidate>
                    @csrf
                <div class="card-body">

                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group">
                        <label for="name-{{ $localeCode }}">{{ $properties['native'] }} body</label>
                        <textarea id="body-{{$localeCode}}" class="form-control {{ $errors->has('body_.' . $localeCode) ? ' is-invalid' : '' }}" name="body_{{ $localeCode }}" value="{{ old('body_.' . $localeCode) }}" required autocomplete="off">{{ old('body_.' . $localeCode) }}</textarea>
                               <span class="invalid-feedback" role="alert"><strong>Adyny hökman girizmeli</strong></span>
                    </div>
                    @endforeach

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


$(document).ready(function (params) {

$("#image_picker").spartanMultiImagePicker({
    fieldName     : 'images[]',
    dropFileLabel : "Drop Here",

});
    
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
        .create( document.querySelector( '#body-tk' ), {
        extraPlugins: [ MyCustomUploadAdapterPlugin ],

        // ...
    }  )
        .catch( error => {
            console.error( error );
        } );                                        

        ClassicEditor
        .create( document.querySelector( '#body-ru' ), {
        extraPlugins: [ MyCustomUploadAdapterPlugin ],

        // ...
    }  )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#body-en' ), {
        extraPlugins: [ MyCustomUploadAdapterPlugin ],

        // ...
    }  )
        .catch( error => {
            console.error( error );
        } );
      
</script>
    
@endsection
