@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Admins / Sub-Admins</a>  </div>
    <h1>Admins / Sub-Admins</h1>
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
            <h5>Admins / Sub-Admins</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Type</th>
                  <th>Roles</th>
                  <th>Status</th>
                  <th>Created on</th>
                  <th>Updated on</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody> 
                @foreach($admins as $admin) 
                <?php if($admin->type=="Admin"){
                    $roles = "All";
                }else{
                    $roles="";
                    if($admin->categories_access==1){
                        $roles .= "Categories, ";
                    }
                    if($admin->products_access==1){
                        $roles .= "Products, ";
                    }
                    if($admin->orders_access==1){
                        $roles .= "Orders, ";
                    }
                    if($admin->users_access==1){
                        $roles .= "Users, ";
                    }
                    if($admin->posts_access==1){
                        $roles .= "Posts, ";
                    }
                    if($admin->banners_access==1){
                        $roles .= "Banners, ";
                    }
                    if($admin->coupons_access==1){
                        $roles .= "Coupons, ";
                    }
                    if($admin->cmspages_access==1){
                        $roles .= "CmsPages, ";
                    }
                    if($admin->admins_access==1){
                        $roles .= "Admins, ";
                    }
                }  
                ?>      
                <tr class="gradeX">
                  <td class="center">{{ $admin->id }}</td>
                  <td class="center">{{ $admin->username }}</td>
                  <td class="center">{{ $admin->type }}</td>
                  <td class="center">{{ $roles }}</td>
                  <td class="center"> @if($admin->status == 1) <span style="color:green">Active</span> @else <span style="color:red">Inactive</span> @endif </td>                                                     
                  <td class="center">{{ $admin->created_at->format('d/m/Y H:i') }}</td>
                  <td class="center">{{ $admin->updated_at->format('d/m/Y H:i') }}</td>
                  <td class="center">
                  <a href="{{ url('/admin/edit-admin/'.$admin->id) }}" class="btn btn-primary btn-mini">Edit</a>
                  <a <?php /* id="delCat" href="{{ url('/admin/delete-admin/'.$admin->id) }}" */ ?> rel="{{ $admin->id }}" rel1="delete-admin" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
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

<script src="https://code.jquery.com/jquery.min.js"></script>

@endsection