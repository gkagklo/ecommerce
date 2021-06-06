@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="/admin/view-posts">Posts</a> <a href="" class="current">Add Post</a> </div>
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
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Post</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/add-post') }}" name="add_post" id="add_post" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" class="span11">
                </div>
              </div>
            
              <div class="control-group">
                  <label class="control-label">Body</label>
                  <div class="controls">
                    <textarea id="article-ckeditor" name="body" class="span11"></textarea>
                  </div>
                </div>
                           

              <div class="control-group">
                <label class="control-label">Image Post</label>
                <div class="controls">
                  <div class="uploader" id="uniform-undefined"><input name="image" id="image" type="file" size="19" style="opacity: 0;"><span class="filename">No file selected</span><span class="action">Choose File</span></div>
                </div>
              </div>      
              <div class="form-actions">
                <input type="submit" value="Add Post" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection