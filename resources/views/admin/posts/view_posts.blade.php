@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Posts</a>  </div>
    <h1>Posts</h1>
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
            <h5>Posts</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Post ID</th>
                  <th>Title</th>
                  <th>Body</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($post as $posts)
                <tr class="gradeX">
                  <td class="center">{{ $posts->id }}</td>
                 <td class="center">{{ $posts->title }}</td> 
                  <td class="center" style="width:500px;">{!! $posts->body !!}</td>
                  <td class="center">
                    @if(!empty($posts->image))
                    <center><img src="{{ asset('/images/frontend_images/posts/'.$posts->image) }}" style="width:200px;"></center>
                    @endif
                  </td>
                  <td class="center">
                    <a href="{{ url('/admin/edit-post/'.$posts->id) }}" title="Edit blog" class="btn btn-primary btn-mini">Edit</a> 
                    <a  rel="{{ $posts->id }}" rel1="delete-post" title="Delete post" href="javascript:"  class="btn btn-danger btn-mini deleteRecord">Delete</a>
                  </td>
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