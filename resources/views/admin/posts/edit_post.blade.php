@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="/admin/view-posts">Posts</a> <a href="" class="current">Edit Post</a> </div>
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
            <h5>Edit Post</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/edit-post/'.$postDetails->id) }}" name="edit_post" id="edit_post" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{ $postDetails->title }}" class="span11">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Body</label>
                <div class="controls">
                  <textarea id="article-ckeditor" name="body" class="span11" >{!! $postDetails->body !!}</textarea>
                </div>
              </div>
          
    
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <div id="uniform-undefined">
                    <table>
                      <tr>
                        <td>
                        <input name="image" id="image" type="file">
                        @if(!empty($postDetails->image))
                          <input type="hidden" name="current_image" value="{{ $postDetails->image }}"> 
                        @endif
                      </td>
                      <td>
                        @if(!empty($postDetails->image))
                          <img class="img-responsive" style="width:250px;" src="{{ asset('/images/frontend_images/posts/'.$postDetails->image) }}"> | <a href="{{ url('/admin/delete-post-image/'.$postDetails->id) }}">Delete</a>
                        @endif
                      </td>
                      </tr>
                    </table>
                </div>
              </div>
            </div>
            
              <div class="form-actions">
                <input type="submit" value="Edit Post" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection