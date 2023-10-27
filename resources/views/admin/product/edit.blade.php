@extends('layout.master')
@section('title', 'Product Edit Page')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                @include('layout.admin_sidebar')
            </div>
            <div class="col-md-8">
                @include("layout.report_message")
                @if(App\Classes\Session::has("product_update_success"))
                    <?php App\Classes\Session::flash("product_update_success") ?>
                @endif
                <form action="/admin/product/{{ $product->id }}/edit" class="table-bordered p-5" autocomplete="off" method="POST" enctype="multipart/form-data">
                    <h3 class="text-center text-info">Edit Product</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" value="{{ $product->name }}" class="form-control rounded-0" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" value="{{ $product->price }}" class="form-control rounded-0" id="price" name="price">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cat_id">Category</label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id === $product->cat_id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sub_cat_id">Sub Category</label>
                                <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                                    @foreach($sub_categories as $sub_cat)
                                        <option value="{{ $sub_cat->id }}" @if($sub_cat->id === $product->sub_cat_id) selected @endif>{{ $sub_cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file">File Input</label>
                        <input type="file" class="form-control-file bg-secondary p-1 text-white" id="file" name="file">
                    </div>

                    <input type="hidden" name="old_image" value="{{ $product->image }}">

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">
                            {{ $product->description }}
                        </textarea>
                    </div>

                    <input type="hidden" name="token" value="<?php \App\Classes\CSRFToken::_token() ?>">
                    <div class="row d-flex justify-content-between no-gutters">
                        <button class="btn btn-outline-secondary">Cancel</button>
                        <button class="btn btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection