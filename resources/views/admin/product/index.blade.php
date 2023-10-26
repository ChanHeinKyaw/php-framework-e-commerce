@extends('layout.master')
@section('title', 'Product Index Page')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                @include('layout.admin_sidebar')
            </div>
            <div class="col-md-8">
                <h1>Product Index</h1>
                @if(App\Classes\Session::has("product_insert_success"))
                    <?php App\Classes\Session::flash("product_insert_success") ?>
                @endif
            </div>
        </div>
    </div>
@endsection