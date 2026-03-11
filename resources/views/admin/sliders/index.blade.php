
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
                        sliders
                    </h4>
                </div>

                <div class="col-auto">
                    <a href="{{ route('sliders.create') }}" class="btn btn-primary">
                        New sliders
                    </a>
                </div>

            </div>
        </div>

        <table class="table table-hover w-100" id="stores_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>caption tk</th>
                     <th>caption ru</th>
                      <th>caption en</th>
                    <th>Image</th>
                    <th></th>
                </tr>

            </thead>
            <tbody>
                @foreach ($home_sliders as $slider)
                    <tr>
                        <th>{{ (request('page', 1) - 1) * 10 + $loop->iteration }}</th>
                        <th>{{ $slider->caption_tk ? $slider->caption_tk : '' }}</th>
                        <th>{{ $slider->caption_ru ? $slider->caption_ru : '' }}</th>
                         <th>{{ $slider->caption_en ? $slider->caption_en : '' }}</th>
                        
                        <td>
                            <img src="{{$slider->getSliderCardImage()}}" class="img-thumbnail" width="100px" height="100px" alt="">
                        </td>

                        <td><a class="dropdown-toggle btn btn-primary three-dots" type="button" data-toggle="dropdown"
                                style="color: #fff;"></a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-item">

                                    <form method="post" action="{{ route('sliders.destroy', $slider->id) }}"
                                        class="edit-delete" id="em-{{ $slider->id }}">
                                        @csrf
                                        @method('delete')

                                        <a href="#" class="btn btn-danger btn-sm btn-block" title="remove"
                                            onclick="if(confirm('Вы уверены, что хотите удалить эту категорию?'))
                                                               { document.getElementById('em-{{ $slider->id }}').submit() }"><i data-icon="remove"></i> Poz </a>
                                    </form>
                                </div>

                                <div class="dropdown-item">
                                    <a href="{{ route('sliders.edit', $slider->id) }}"
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

            {{ $home_sliders->links() }}

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
