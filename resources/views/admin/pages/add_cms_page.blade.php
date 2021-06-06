@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="/admin/view-cms-pages"> CMS Pages</a> <a href="" class="current">Add CMS Page</a> </div>
    <h1>Add CMS Page</h1>
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
            <h5>Add CMS Page</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/add-cms-page') }}" name="add_cms_page" id="add_cms_page" novalidate="novalidate">{{ csrf_field() }}
            
              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" class="span11">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">CMS Page URL</label>
                <div class="controls">
                  <input type="text" name="url" id="url" class="span11">
                </div>
              </div>
           
              <div class="control-group">
                  <label class="control-label">Description</label>
                  <div class="controls">
                    <textarea id="article-ckeditor" name="description" class="span11"></textarea>
                  </div>
                </div>  
                <div class="control-group">
                  <label class="control-label">Meta title</label>
                  <div class="controls">
                    <input type="text" name="meta_title" id="meta_title" class="span11">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Meta description</label>
                  <div class="controls">
                    <input type="text" name="meta_description" id="meta_description" class="span11">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Meta keywords</label>
                  <div class="controls">
                    <input type="text" name="meta_keywords" id="meta_keywords" class="span11">
                  </div>
                </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1"> 
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add CMS Page" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection