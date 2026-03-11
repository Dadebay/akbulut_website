
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

        <div class="justify-content-between p-3 align-items-center flex-wrap">

            <div class="py-3 row align-items-center flex-wrap text-nowrap float-right">


                <form class="form-inline">

                    <div class="form-group" style="margin-right: 10px;">
                        <select name="category_id" class="form-control category_id_select2" >
                            <option value="" selected>Kategoriya sayla...</option>
                            @foreach (App\Models\Category::whereHas('products')->get() as $cat)
                                <option value="{{ $cat->id }}" {{ $category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->getNameTranslationAttr(app()->getLocale()) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <input name="item_query" id="item_query" type="text"
                         value="{{$item_query}}" placeholder="Haryt Gözleg ..."
                            class="form-control" autocomplete="off">
                    </div>
                </form>


                <div class="col-auto">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        täze önüm goş
                    </a>
                </div>

            </div>

            <div class="col">
                <div class="float-left"> <h4>
                    önümler
                </h4></div>

            </div>


        <table class="table table-hover w-100" id="stores_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kategoriya</th>
                    <th>ady tk</th>
                    <th>surat</th>


                    <th></th>
                </tr>

            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th>{{ (request('page', 1) - 1) * 10 + $loop->iteration }}</th>
                        <td>{{$product->category->name_tk}}</td>
                        <td>
                            {{-- <a class="nav-link" href="{{route('products.edit', $product->id)}}">
                                {!! $product->getTranslation('general_info', 'tk') !!}
                            </a> --}}
                            <b>tk:</b>  {{$product->name_tk}}<br>
                          <b>ru:</b>  {{$product->name_ru}}<br>
                          <b>en:</b>  {{$product->name_en}}<br>


                        </td>
                        {{-- <td>
                            <a class="nav-link" href="{{route('products.edit', $product->id)}}">
                                {!! $product->getTranslation('general_info', 'ru') !!}
                            </a>
                        </td>
                        <td>
                            <a class="nav-link" href="{{route('products.edit', $product->id)}}">
                                {!! $product->getTranslation('general_info', 'en') !!}
                            </a>
                        </td> --}}

                        <td>
                            <img src="{{$product->getProductThumbImage() }}" width="100px" class="img-thumbnail">
                        </td>

                        <td><a class="dropdown-toggle btn btn-primary three-dots" type="button" data-toggle="dropdown"
                                style="color: #fff;"></a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-item">

                                    <form method="post" action="{{ route('products.destroy', $product->id) }}"
                                        class="edit-delete" id="em-{{ $product->id }}">
                                        @csrf
                                        @method('delete')

                                        <a href="#" class="btn btn-danger btn-sm btn-block" title="remove"
                                            onclick="if(confirm('Вы уверены, что хотите удалить эту категорию?'))
                                                               { document.getElementById('em-{{ $product->id }}').submit() }"><i data-icon="remove"></i> Poz </a>
                                    </form>
                                </div>

                                <div class="dropdown-item">
                                    <a href="{{ route('products.edit', $product->id) }}"
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
            {{ $products->appends(['category_id'=>$category_id,'item_query'=>$item_query])->links() }}
        </div>

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
