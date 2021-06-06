@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Banners</a>  </div>
    <h1>Banners</h1>
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
            <h5>Banners</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Banner ID</th>
                  <th>Title</th>
                  <th>Link</th>
                  <th>Status</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($banners as $banner)
                <tr class="gradeX">
                  <td class="center">{{ $banner->id }}</td>
                 <td class="center">{{ $banner->title }}</td> 
                  <td class="center">{{ $banner->link }}</td>
                  <td class="center">@if($banner->status==1)Active @else Inactive @endif </td>
                  <td class="center">
                    @if(!empty($banner->image))
                    <center><img src="{{ asset('/images/frontend_images/banners/'.$banner->image) }}" style="width:200px;"></center>
                    @endif
                  </td>
                  <td class="center">
                    <a href="{{ url('/admin/edit-banner/'.$banner->id) }}" title="Edit banner" class="btn btn-primary btn-mini">Edit</a> 
                    <a  rel="{{ $banner->id }}" rel1="delete-banner" title="Delete banner" href="javascript:"  class="btn btn-danger btn-mini deleteRecord">Delete</a>
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