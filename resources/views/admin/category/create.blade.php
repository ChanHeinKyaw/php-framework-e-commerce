@extends('layout.master')
@section('title','Category Create')
@section('content')
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
          {{-- Category Content Start --}}
          <ul class="list-group mt-5">
            @foreach($categories as $category)
              <li class="list-group-item rounded-0">
                  <a href="/admin/category">{{ $category->name }}</a>
                  <span class="float-right">
                    <i class="fa fa-plus text-primary" style="cursor: pointer" onclick="showSubCatModel('{{ $category->name }}','{{ $category->id }}')"></i>
                    <i class="fa fa-edit text-warning mx-2" style="cursor: pointer" onclick="showEditModal('{{ $category->name }}','{{ $category->id }}')"></i>
                    <a href="/admin/category/{{ $category->id }}/delete">
                      <i class="fa fa-trash text-danger"></i>
                    </a>
                  </span>
              </li>
            @endforeach
          </ul>
          <div class="mt-2 d-flex justify-content-center">
            {!! $pages !!}
          </div>
          {{-- Category Content End --}}
          
          {{-- Sub Category Content Start --}}
          <ul class="list-group mt-5">
            @foreach($sub_cats as $category)
              <li class="list-group-item rounded-0">
                  <a href="/admin/category">{{ $category->name }}</a>
                  <span class="float-right">
                    <i class="fa fa-edit text-warning mx-2" style="cursor: pointer" onclick="showSubEditModal('{{ $category->name }}','{{ $category->id }}')"></i>
                    <a href="/admin/subcategory/{{ $category->id }}/delete">
                      <i class="fa fa-trash text-danger"></i>
                    </a>
                  </span>
              </li>
            @endforeach
          </ul>
          <div class="mt-2 d-flex justify-content-center">
            {!! $sub_pages !!}
          </div>
          {{-- Sub Category Content End --}}
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
            <div id="error-message" class="py-2 text-danger"></div>
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

{{-- Sub Category Modal Start --}}
<div class="modal" tabindex="-1" id="sub-category-modal">
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
            <label for="name">Parent Category Name</label>
            <div id="error-message" class="py-2 text-danger"></div>
            <input type="name" class="form-control rounded-0" id="parent-cat-name">
          </div>
          <input type="hidden" id="parent-cat-id">

          <div class="form-group">
            <label for="name">Sub Category Name</label>
            <div id="sub-error-message" class="py-2 text-danger"></div>
            <input type="name" class="form-control rounded-0" id="sub-cat-name">
          </div>
          <input type="hidden" id="sub-cat-token" value="<?php \App\Classes\CSRFToken::_token() ?>">

          <div class="row justify-content-end no-gutters mt-3">
              <button class="btn btn-primary" onclick="createSubCategory(event)">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- Sub Category Modal End --}}

{{-- Sub Category Edit Modal Start --}}
<div class="modal" tabindex="-1" id="sub-edit-modal">
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
            <div id="sub-update-error-message" class="py-2 text-danger"></div>
            <input type="name" class="form-control rounded-0" id="sub-edit-name">
          </div>
          <input type="hidden" id="sub-edit-token" value="<?php \App\Classes\CSRFToken::_token() ?>">
          <input type="hidden" id="sub-edit-id">

          <div class="row justify-content-end no-gutters mt-3">
              <button class="btn btn-primary" onclick="startSubEdit(event)">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- Sub Category Edit Modal End --}}
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
          let res = JSON.parse(response);
          alert(res.success);
          window.location.href = "/admin/category/create";
        }).fail(function(response) {
          let res = JSON.parse(response.responseText);
          $("#error-message").html(res.name);
        });
      }

      function showSubCatModel(name,id){
          $("#parent-cat-name").val(name);
          $("#parent-cat-id").val(id);
          $("#sub-category-modal").modal("show");
      }

      function createSubCategory(event){
          event.preventDefault();
          let name = $("#sub-cat-name").val();
          let token = $("#sub-cat-token").val();
          let parent_cat_id = $("#parent-cat-id").val();

          $.ajax({
          type: 'POST',
          url : '/admin/subcategory/create',
          data: {
            name: name,
            token: token,
            parent_cat_id: parent_cat_id,
          }
        }).done(function(response) {
          let res = JSON.parse(response);
          alert(res.success);
          window.location.href = "/admin/category/create";
        }).fail(function(response) {
          let res = JSON.parse(response.responseText);
          $("#sub-error-message").html(res.name);
        });
      }

      function showSubEditModal(name,id){
        $("#sub-edit-name").val(name);
        $("#sub-edit-id").val(id);
        $("#sub-edit-modal").modal('show');
      }

      function startSubEdit(e){
        e.preventDefault();
        let name = $("#sub-edit-name").val();
        let id = $("#sub-edit-id").val();
        let token = $("#sub-edit-token").val();

        $.ajax({
          type: 'POST',
          url : '/admin/subcategory/update',
          data: {
            name: name,
            token: token,
            id: id,
          }
        }).done(function(response) {
          let res = JSON.parse(response);
          alert(res.update);
          window.location.href = "/admin/category/create";
        }).fail(function(response) {
          let res = JSON.parse(response.responseText);
          $("#sub-update-error-message").html(res.name);
        });
      }
  </script>
@endsection