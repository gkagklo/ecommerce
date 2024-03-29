@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a class="current" href="">Categories</a>  </div>
    <h1>Categories</h1>
    @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif   
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Categories</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Level</th>
                  <th>Category URL</th>
                  <th>Meta title</th>
                  <th>Meta description</th>
                  <th>Meta keywords</th>
                  <th>Enable</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($categories as $category)
                <tr class="gradeX">
                  <td class="center">{{ $category->id }}</td>
                  <td class="center">{{ $category->name }}</td>
                  <td class="center">{{ $category->parent_id }}</td>
                  <td class="center">{{ $category->url }}</td>
                  <td class="center">{{ $category->meta_title }}</td>
                  <td class="center">{{ $category->meta_description }}</td>
                  <td class="center">{{ $category->meta_keywords }}</td>
                  <td class="center">@if($category->status==1) Yes @else No @endif</td>
                  <td class="center">
                    <a href="{{ url('/admin/edit-category/'.$category->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                    <a <?php /* id="delCat" href="{{ url('/admin/delete-category/'.$category->id) }}" */ ?> rel="{{ $category->id }}" rel1="delete-category" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection