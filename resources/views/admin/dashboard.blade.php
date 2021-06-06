@extends('layouts.adminLayout.admin_design')
@section('content')
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

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

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="/admin/dashboard"> <i class="icon-dashboard"></i> My Dashboard </a> </li>
        <li class="bg_lo span3"> <a href="/admin/form-common"> <i class="icon-th-list"></i> Forms</a> </li>
        <li class="bg_ls"> <a href="/admin/buttons"> <i class="icon-tint"></i> Buttons</a> </li>
        <li class="bg_lg"> <a href="/admin/tables"> <i class="icon-th"></i> Tables</a> </li>
        <li class="bg_lb"> <a href="/admin/interface-elements"> <i class="icon-pencil"></i>Interface elements</a> </li>
        <li class="bg_ly"> <a href="/admin/widgets"> <i class="icon-inbox"></i> Widgets </a> </li>
        <li class="bg_ls"> <a href="/admin/grid"> <i class="icon-tasks"></i>Grid Layout</a> </li>
        <li class="bg_lr"> <a href="/admin/error404"> <i class="icon-info-sign"></i> Error 404</a> </li>

       
      </ul>
    </div>
<!--End-Action boxes-->    

<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Site Analytics</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div>
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong>{{ $count_users->count() }}</strong> <small>Total Users</small></li>
                <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong>{{ $count_products->sum('stock') }}</strong> <small>Total Shop</small></li>
                <li class="bg_lh"><i class="icon-tag"></i> <strong>{{ $count_orders->count() }}</strong> <small>Total Orders</small></li>
              <li class="bg_lh"><i class="icon-repeat"></i> <strong>{{ $count_pending_orders->count() }}</strong> <small>Pending Orders</small></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
    <hr/>
   
  </div>
</div>

<!--end-main-container-part-->

@endsection