@extends('layout.master')
@section('title', 'Product Index Page')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                @include('layout.admin_sidebar')
            </div>
            <div class="col-md-8">
                @if(App\Classes\Session::has("product_insert_success"))
                    <?php App\Classes\Session::flash("product_insert_success") ?>
                @endif
                @if(App\Classes\Session::has("delete_success"))
                    <?php App\Classes\Session::flash("delete_success") ?>
                @endif
                @if(App\Classes\Session::has("delete_fail"))
                    <?php App\Classes\Session::flash("delete_fail") ?>
                @endif
                {{-- Table Start --}}
                    <table class="table table-bordered text-center">
                        <thead>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr class="text-muted">
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <img src="{{ $product->image }}" alt="" style="max-width:50px; max-height: 100px;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a href="/admin/product/{{ $product->id }}/edit">
                                            <i class="fa fa-edit text-warning mx-2"></i>
                                        </a>
                                        <a href="/admin/product/{{ $product->id }}/delete">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{-- Table End --}}
                <div class="mt-5 d-flex justify-content-center">
                    {!! $pages !!}
                </div>
            </div>

        </div>
    </div>
@endsection