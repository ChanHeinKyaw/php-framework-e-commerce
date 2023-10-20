@extends('layout.master')
@section('title','Category Create')
@section('content')
<div class="container my-5">
    <h1 class="text-primary text-center">Create Category</h1>
    <div class="col-md-8 offset-md-2">
        <form action="/admin/category" autocomplete="off" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Category Name</label>
              <input type="name" class="form-control rounded-0" id="name" name="name">
            </div>
            <div class="form-group">
              <label for="file">File</label>
              <input type="file" class="form-control rounded-0" id="file" name="file">
            </div>

            <input type="hidden" name="token" value="<?php \App\Classes\CSRFToken::_token() ?>">
            <div class="row justify-content-end no-gutters mt-3">
                <button type="submit" class="btn btn-primary">create</button>
            </div>
          </form>
    </div>
</div>
@endsection