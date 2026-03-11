@extends('layouts.app')
@section('third_party_stylesheets')
    <link  rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
    <style>

.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate{
  padding: 10px;
}
      </style>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="page-header py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h4>
                        News
                    </h4>
                </div>

                <div class="col-auto">
                    <a href="{{ route('news.create') }}" class="btn btn-primary">
                        add news
                    </a>
                </div>

            </div>
        </div>

        <table class="table table-hover w-100" id="stores_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>main</th>
                    <th>title tk</th>
                    <th>title ru</th>
                    <th>title en</th>
                    <th></th>
                </tr>

            </thead>
            <tbody>

                @foreach ($news as $new)
                    <tr>
                        <td>{{ (request('page', 1) - 1) * 10 + $loop->iteration }}</td>
                        <td>{{ $new->main == true ? 'true': 'false' }}</td>
                        <td>
                            <a class="nav-link" href="{{route('news.edit', $new->id)}}">
                                {{ $new->title_tk }}
                            </a>
                        </td>
                        <td>
                            <a class="nav-link" href="{{route('news.edit', $new->id)}}">
                                {{ $new->title_ru }}
                            </a>
                        </td>
                        <td>
                            <a class="nav-link" href="{{route('news.edit', $new->id)}}">
                                {{ $new->title_en }}
                            </a>
                        </td>

                        <td><a class="dropdown-toggle btn btn-primary three-dots" type="button" data-toggle="dropdown"
                                style="color: #fff;"></a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-item">

                                    <form method="post" action="{{ route('news.destroy', $new->id) }}"
                                        class="edit-delete" id="em-{{ $new->id }}">
                                        @csrf
                                        @method('delete')

                                        <a href="#" class="btn btn-danger btn-sm btn-block" title="remove"
                                            onclick="if(confirm('Вы уверены, что хотите удалить эту категорию?'))
                                                               { document.getElementById('em-{{ $new->id }}').submit() }"><i data-icon="remove"></i> Poz </a>
                                    </form>
                                </div>

                                <div class="dropdown-item">
                                    <a href="{{ route('news.edit', $new->id) }}"
                                        class="btn btn-primary btn-sm btn-block" title="edit"> <i data-icon="edit"></i>
                                        Üýtget </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="d-flex justify-content-center">

            {{ $news->links() }}

        </div>




    </div>
@endsection

@section('third_party_scripts')

    <script src="{{asset('js/jquery.js')}}"></script>

    <script src="{{ asset('js/datatables.min.js') }}"></script>

    <script src="{{ asset('js/flatpickr.js') }}"></script>

    <script src="{{ asset('js/flatpickr-locale-tk.js') }}"></script>

    <script>    

    $(document).ready(function (e) {


    });



     
    </script>
@endsection
