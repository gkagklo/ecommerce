<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>

  <ul>
    <li class="active"><a href="{{ url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>

    @if(Session::get('adminDetails')['categories_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <i class="fa fa-angle-down" style='font-size:20px;color:yellow;float:right;'></i> </a>
      <ul>
        <li><a href="{{ url('/admin/add-category')}}">Add Category</a></li>
        <li><a href="{{ url('/admin/view-categories')}}">View Categories</a></li>
      </ul>
    </li>
    @endif

    @if(Session::get('adminDetails')['products_access']==1)
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <i class='fas fa-angle-down' style='font-size:20px;color:yellow;float:right;'></i></a>
      <ul>
        <li><a href="{{ url('/admin/add-product')}}">Add Product</a></li>
        <li><a href="{{ url('/admin/view-products')}}">View Products</a></li>
      </ul>
    </li>
    @endif

    @if(Session::get('adminDetails')['orders_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span> <i class='fas fa-angle-down' style='font-size:20px;color:yellow;float:right;'></i></a>
      <ul>
        <li><a href="{{ url('/admin/view-orders')}}">View Orders</a></li>
      </ul>
    </li>
    @endif

    @if(Session::get('adminDetails')['coupons_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <i class='fas fa-angle-down' style='font-size:20px;color:yellow;float:right;'></i></a>
      <ul>
        <li><a href="{{ url('/admin/add-coupon')}}">Add Coupon</a></li>
        <li><a href="{{ url('/admin/view-coupons')}}">View Coupons</a></li>
      </ul>
    </li>
    @endif


    @if(Session::get('adminDetails')['posts_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Posts</span> <i class='fas fa-angle-down' style='font-size:20px;color:yellow;float:right;'></i></a>
      <ul>
        <li><a href="{{ url('/admin/add-post')}}">Add Post</a></li>
        <li><a href="{{ url('/admin/view-posts')}}">View Posts</a></li>
      </ul>
    </li>
    @endif


    @if(Session::get('adminDetails')['banners_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banners</span> <i class='fas fa-angle-down' style='font-size:20px;color:yellow;float:right;'></i></a>
      <ul>
        <li><a href="{{ url('/admin/add-banner')}}">Add Banner</a></li>
        <li><a href="{{ url('/admin/view-banners')}}">View Banners</a></li>
      </ul>
    </li>
    @endif


    @if(Session::get('adminDetails')['cmspages_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>CMS Pages</span> <i class='fas fa-angle-down' style='font-size:20px;color:yellow;float:right;'></i></a>
      <ul>
        <li><a href="{{ url('/admin/add-cms-page')}}">Add CMS Page</a></li>
        <li><a href="{{ url('/admin/view-cms-pages')}}">View CMS Pages</a></li>
      </ul>
    </li>
    @endif


    @if(Session::get('adminDetails')['users_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Users</span> <i class='fas fa-angle-down' style='font-size:20px;color:yellow;float:right;'></i></a>
      <ul>
        <li><a href="{{ url('/admin/view-users')}}">View Users</a></li>
      </ul>
    </li>
    @endif


    @if(Session::get('adminDetails')['admins_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Admins / Sub-Admins</span> <i class='fas fa-angle-down' style='font-size:20px;color:yellow;float:right;'></i></a>
      <ul>
        <li><a href="{{ url('/admin/add-admin')}}">Add Admin / Sub-Admin</a></li>
        <li><a href="{{ url('/admin/view-admins')}}">View Admins / Sub-Admins</a></li>
      </ul>
    </li>
    @endif


  </ul>
</div>
<!--sidebar-menu-->
