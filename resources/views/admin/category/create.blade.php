@extends('layout.master')
@section('title','Category Create')
@section('content')
<div class="container my-5">
    <h1 class="text-primary text-center">Create Category</h1>
    <div class="col-md-8 offset-md-2">
        <form action="/admin/category" autocomplete="off" method="POST">
            <div class="form-group">
              <label for="name">Category Name</label>
              <input type="name" class="form-control" id="name" name="name">
            </div>
            
            <div class="row justify-content-end no-gutters mt-3">
                <button type="submit" class="btn btn-primary">create</button>
            </div>
          </form>
    </div>
</div>
@endsection