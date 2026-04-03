@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-3 align-items-center">
        <div class="col">
            <h4>Täze at goş</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Esasy Sahypa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('horses.index') }}">Atlar</a></li>
                <li class="breadcrumb-item active">Goş</li>
            </ol>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('horses.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">

            {{-- Left column: Info --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Atyň maglumatlary</h5></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Atyň ady <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Mysal: Garagum" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tohumy</label>
                                <input type="text" name="breed" value="{{ old('breed', 'Ahalteke Bedewi') }}"
                                       class="form-control" placeholder="Ahalteke Bedewi">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Jynsy</label>
                                <select name="gender" class="form-control">
                                    <option value="">Sayla...</option>
                                    <option value="Erkek" {{ old('gender')=='Erkek'?'selected':'' }}>Erkek</option>
                                    <option value="Dişi" {{ old('gender')=='Dişi'?'selected':'' }}>Dişi</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tertip belgisi</label>
                                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                       class="form-control" min="0">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Ýaşy (ýyl)</label>
                                <input type="number" name="age" value="{{ old('age') }}"
                                       class="form-control" min="0" max="50" placeholder="5">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Boýy (sm)</label>
                                <input type="number" name="height" value="{{ old('height') }}"
                                       class="form-control" min="100" max="220" placeholder="165">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Reňki</label>
                                <input type="text" name="color" value="{{ old('color') }}"
                                       class="form-control" placeholder="Altyn, Gara, Ak...">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Atyň taryhy / açyklamasy</label>
                            <textarea name="description" rows="5"
                                      class="form-control"
                                      placeholder="Atyň ýetişiş taryhy, häsiýeti...">{{ old('description') }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Right column: Media --}}
            <div class="col-md-4">

                {{-- Images --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Suratlar <small class="text-muted">(iň köp 5 sany)</small></h5>
                    </div>
                    <div class="card-body">
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" id="imagesInput"
                                   name="images[]" accept="image/jpeg,image/png,image/webp"
                                   multiple onchange="previewImages(this)">
                            <label class="custom-file-label" for="imagesInput">Suratlary sayla...</label>
                        </div>
                        <small class="text-muted">JPG, PNG, WEBP · iň köp 10MB her biri</small>

                        <div id="imagePreviewGrid" class="row mt-3 g-2" style="gap:8px;display:flex;flex-wrap:wrap;"></div>
                    </div>
                </div>

                {{-- Video --}}
                <div class="card mt-3">
                    <div class="card-header"><h5 class="mb-0">Wideo <small class="text-muted">(1 sany)</small></h5></div>
                    <div class="card-body">
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" id="videoInput"
                                   name="video" accept="video/mp4,video/quicktime,video/webm"
                                   onchange="previewVideo(this)">
                            <label class="custom-file-label" for="videoInput">Wideosy sayla...</label>
                        </div>
                        <small class="text-muted">MP4, MOV, WEBM · iň köp 5MB</small>
                        <div id="videoPreview" class="mt-2"></div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-save"></i> Ýatda sakla
                    </button>
                    <a href="{{ route('horses.index') }}" class="btn btn-secondary btn-block mt-2">Yzyna</a>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
function previewImages(input) {
    var grid = document.getElementById('imagePreviewGrid');
    grid.innerHTML = '';
    var files = Array.from(input.files).slice(0, 5);
    files.forEach(function(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var div = document.createElement('div');
            div.style = 'width:80px;height:60px;border-radius:8px;overflow:hidden;flex-shrink:0;';
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style = 'width:100%;height:100%;object-fit:cover;';
            div.appendChild(img);
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
    document.querySelector('label[for="imagesInput"]').textContent = files.length + ' surat saýlandy';
}

function previewVideo(input) {
    var preview = document.getElementById('videoPreview');
    preview.innerHTML = '';
    if (input.files && input.files[0]) {
        var name = input.files[0].name;
        preview.innerHTML = '<div class="alert alert-info py-2 mb-0"><i class="fas fa-video"></i> ' + name + '</div>';
        document.querySelector('label[for="videoInput"]').textContent = name;
    }
}
</script>
@endsection
