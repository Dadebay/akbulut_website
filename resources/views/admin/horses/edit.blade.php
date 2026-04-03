@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-3 align-items-center">
        <div class="col">
            <h4>Aty düzelt</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Esasy Sahypa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('horses.index') }}">Atlar</a></li>
                <li class="breadcrumb-item active">Düzelt: {{ $horse->name }}</li>
            </ol>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('horses.update', $horse) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">

            {{-- Left column: Info --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Atyň maglumatlary</h5></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Atyň ady <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $horse->name) }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Mysal: Garagum" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tohumy</label>
                                <input type="text" name="breed" value="{{ old('breed', $horse->breed) }}"
                                       class="form-control" placeholder="Ahalteke Bedewi">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Jynsy</label>
                                <select name="gender" class="form-control">
                                    <option value="">Sayla...</option>
                                    <option value="Erkek" {{ old('gender', $horse->gender) == 'Erkek' ? 'selected' : '' }}>Erkek</option>
                                    <option value="Dişi"  {{ old('gender', $horse->gender) == 'Dişi'  ? 'selected' : '' }}>Dişi</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tertip belgisi</label>
                                <input type="number" name="sort_order" value="{{ old('sort_order', $horse->sort_order) }}"
                                       class="form-control" min="0">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Ýaşy (ýyl)</label>
                                <input type="number" name="age" value="{{ old('age', $horse->age) }}"
                                       class="form-control" min="0" max="50" placeholder="5">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Boýy (sm)</label>
                                <input type="number" name="height" value="{{ old('height', $horse->height) }}"
                                       class="form-control" min="100" max="220" placeholder="165">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Reňki</label>
                                <input type="text" name="color" value="{{ old('color', $horse->color) }}"
                                       class="form-control" placeholder="Altyn, Gara, Ak...">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Atyň taryhy / açyklamasy</label>
                            <textarea name="description" rows="5"
                                      class="form-control"
                                      placeholder="Atyň ýetişiş taryhy, häsiýeti...">{{ old('description', $horse->description) }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Right column: Media --}}
            <div class="col-md-4">

                {{-- Existing Images --}}
                @php $existingImages = $horse->getMedia('horse_images'); @endphp
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Suratlar</h5>
                        <span class="badge badge-{{ $existingImages->count() >= 5 ? 'danger' : 'secondary' }}">
                            {{ $existingImages->count() }} / 5
                        </span>
                    </div>
                    <div class="card-body">

                        {{-- Current images grid with delete buttons --}}
                        @if($existingImages->count() > 0)
                        <div class="row mb-3">
                            @foreach($existingImages as $media)
                            <div class="col-4 mb-2 px-1 position-relative" style="text-align:center;">
                                <img src="{{ $media->hasGeneratedConversion('thumb') ? $media->getUrl('thumb') : $media->getUrl() }}" alt=""
                                     style="width:100%;height:70px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
                                {{-- button links to standalone form placed outside the main form --}}
                                <button type="submit" form="del-img-{{ $media->id }}"
                                        class="btn btn-danger btn-sm"
                                        style="position:absolute;top:2px;right:4px;padding:1px 6px;font-size:12px;line-height:1.5;border-radius:4px;"
                                        onclick="return confirm('Suraty pozmak isleýärsiňizmi?')">×</button>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        {{-- Add more images --}}
                        @if($existingImages->count() < 5)
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" id="imagesInput"
                                   name="images[]" accept="image/jpeg,image/png,image/webp"
                                   multiple onchange="previewImages(this)">
                            <label class="custom-file-label" for="imagesInput">
                                Täze surat goş (iň köp {{ 5 - $existingImages->count() }} sany)
                            </label>
                        </div>
                        <small class="text-muted">JPG, PNG, WEBP · iň köp 10MB her biri</small>
                        <div id="imagePreviewGrid" class="mt-3" style="display:flex;flex-wrap:wrap;gap:8px;"></div>
                        @else
                        <div class="alert alert-warning py-2 mb-0">
                            <i class="fas fa-exclamation-triangle"></i>
                            5 surat dolduryldy. Goşmak üçin öňki suratlary pozuň.
                        </div>
                        @endif

                    </div>
                </div>

                {{-- Video --}}
                @php $currentVideo = $horse->getFirstMedia('horse_video'); @endphp
                <div class="card mt-3">
                    <div class="card-header"><h5 class="mb-0">Wideo <small class="text-muted">(1 sany)</small></h5></div>
                    <div class="card-body">
                        @if($currentVideo)
                        <div class="alert alert-info py-2 mb-2">
                            <i class="fas fa-video"></i> <strong>{{ $currentVideo->file_name }}</strong>
                            <small class="d-block text-muted mt-1">Täze wideo ýükleseňiz, bar bolan çalyşar.</small>
                        </div>
                        @endif
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" id="videoInput"
                                   name="video" accept="video/mp4,video/quicktime,video/webm"
                                   onchange="previewVideo(this)">
                            <label class="custom-file-label" for="videoInput">
                                {{ $currentVideo ? 'Täze wideo sayla...' : 'Wideosy sayla...' }}
                            </label>
                        </div>
                        <small class="text-muted">MP4, MOV, WEBM · iň köp 5MB</small>
                        <div id="videoPreview" class="mt-2"></div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-save"></i> Üýtgetmeleri sakla
                    </button>
                    <a href="{{ route('horses.index') }}" class="btn btn-secondary btn-block mt-2">Yzyna</a>
                </div>

            </div>
        </div>
    </form>

{{-- Standalone delete-image forms (outside main form to avoid nested-form bug) --}}
@foreach($existingImages as $media)
<form id="del-img-{{ $media->id }}" method="POST"
      action="{{ route('horses.deleteImage', [$horse->id, $media->id]) }}"
      style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endforeach

</div>

<script>
function previewImages(input) {
    var grid = document.getElementById('imagePreviewGrid');
    grid.innerHTML = '';
    var maxNew = {{ 5 - $existingImages->count() }};
    var files = Array.from(input.files).slice(0, maxNew);
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
