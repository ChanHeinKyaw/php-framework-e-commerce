@extends('layout.master')
@section('title', 'Product Create Page')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                @include('layout.admin_sidebar')
            </div>
            <div class="col-md-8">
                @include("layout.report_message")
                <form action="/admin/product" class="table-bordered p-5" autocomplete="off" method="POST" enctype="multipart/form-data">
                    <h3 class="text-center text-info">Create Product</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control rounded-0" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control rounded-0" id="price" name="price">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cat_id">Category</label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sub_cat_id">Sub Category</label>
                                <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                                    @foreach($sub_categories as $sub_cat)
                                        <option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file">File Input</label>
                        <input type="file" class="form-control-file bg-secondary p-1 text-white" id="file" name="file">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
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