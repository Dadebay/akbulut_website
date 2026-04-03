@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="py-3 row align-items-center">
        <div class="col">
            <h4>Atlar</h4>
        </div>
        <div class="col-auto">
            <a href="{{ route('horses.create') }}" class="btn btn-primary">+ Täze at goş</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th width="50">#</th>
                        <th width="80">Surat</th>
                        <th>Ady</th>
                        <th>Tohumy</th>
                        <th>Ýaşy</th>
                        <th>Reňki</th>
                        <th>Jynsy</th>
                        <th>Video</th>
                        <th>Suratlary</th>
                        <th width="120"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($horses as $horse)
                    <tr>
                        <td>{{ $horse->sort_order ?: $loop->iteration }}</td>
                        <td>
                            @if($horse->getFirstMedia('horse_images'))
                                <img src="{{ $horse->getFirstMedia('horse_images')->hasGeneratedConversion('thumb') ? $horse->getFirstMedia('horse_images')->getUrl('thumb') : $horse->getFirstMedia('horse_images')->getUrl() }}"
                                     style="width:56px;height:42px;object-fit:cover;border-radius:6px;">
                            @else
                                <div style="width:56px;height:42px;background:#e9ecef;border-radius:6px;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-horse" style="color:#aaa;font-size:18px;"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $horse->name }}</strong>
                        </td>
                        <td>{{ $horse->breed }}</td>
                        <td>{{ $horse->age ? $horse->age . ' ýaş' : '—' }}</td>
                        <td>{{ $horse->color ?? '—' }}</td>
                        <td>{{ $horse->gender ?? '—' }}</td>
                        <td>
                            @if($horse->getFirstMedia('horse_video'))
                                <span class="badge badge-success"><i class="fas fa-video"></i> Bar</span>
                            @else
                                <span class="badge badge-secondary">Ýok</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $horse->getMedia('horse_images')->count() }} / 5</span>
                        </td>
                        <td class="text-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('horses.edit', $horse->id) }}">
                                        <i class="fas fa-edit fa-fw"></i> Üýtget
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('horses.destroy', $horse->id) }}" method="POST"
                                          onsubmit="return confirm('{{ $horse->name }} atyny pozmak isleýärsiňizmi?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-trash fa-fw"></i> Poz
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-5 text-muted">
                            <i class="fas fa-horse fa-2x mb-2 d-block"></i>
                            Heniz at goşulmady
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $horses->links() }}
    </div>
</div>
@endsection
