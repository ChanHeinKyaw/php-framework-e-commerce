@extends('layout.master')
@section('title','Category Create')
@section('content')
<style>
  .pagination > li {
    padding: 5px 15px;
    background: #ddd;
    margin-right: 1px;
  }
</style>
<div class="container my-5">
    <h1 class="text-primary text-center">Create Category</h1>
    <div class="row">
      <div class="col-md-4">
        @include("layout.admin_sidebar")
      </div>
      <div class="col-md-8">
          @include('layout.report_message')
          @if(\App\Classes\Session::has('delete_success'))
            <?php \App\Classes\Session::flash('delete_success') ?>
          @endif
          @if(\App\Classes\Session::has('delete_fail'))
            <?php \App\Classes\Session::flash('delete_fail') ?>
          @endif
          <form action="/admin/category/create" autocomplete="off" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Category Name</label>
              <input type="name" class="form-control rounded-0" id="name" name="name">
            </div>
            <input type="hidden" name="token" value="<?php \App\Classes\CSRFToken::_token() ?>">
            <div class="row justify-content-end no-gutters mt-3">
                <button type="submit" class="btn btn-primary">create</button>
            </div>
          </form>
          <ul class="list-group mt-5">
            @foreach($categories as $category)
              <li class="list-group-item rounded-0">
                  <a href="/admin/category">{{ $category->name }}</a>
                  <span class="float-right">
                    <i class="fa fa-edit text-warning" onclick="showEditModal('{{ $category->name }}','{{ $category->id }}')"></i>
                    <a href="/admin/category/{{ $category->id }}/delete">
                      <i class="fa fa-trash text-danger ml-2"></i>
                    </a>
                  </span>
              </li>
            @endforeach
          </ul>
          <div class="mt-5"></div>
          {!! $pages !!}
      </div>
    </div>
</div>
{{-- Modal Start --}}
<div class="modal" tabindex="-1" id="edit-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="name" class="form-control rounded-0" id="edit-name">
          </div>
          <input type="hidden" id="edit-token" value="<?php \App\Classes\CSRFToken::_token() ?>">
          <input type="hidden" id="edit-id">

          <div class="row justify-content-end no-gutters mt-3">
              <button class="btn btn-primary" onclick="startEdit(event)">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- Modal End --}}
@endsection

@section('script')
  <script>
      function showEditModal(name,id){
        $("#edit-name").val(name);
        $("#edit-id").val(id);
        $("#edit-modal").modal('show');
      }

      function startEdit(e){
        e.preventDefault();
        let name = $("#edit-name").val();
        let id = $("#edit-id").val();
        let token = $("#edit-token").val();

        $.ajax({
          type: 'POST',
          url : '/admin/category/update',
          data: {
            name: name,
            token: token,
            id: id,
          }
        }).done(function(response) {
          console.log(response);
        }).fail(function(response){
          console.log(response);
        })
      }
  </script>
@endsection