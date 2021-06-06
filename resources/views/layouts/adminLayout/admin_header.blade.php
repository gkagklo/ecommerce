
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Laravel Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
  <li><a href="{{ url('/') }}" target="_blank" title="Visit your website"> My website</a></li>
  <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"> </i>  <span class="text">{{ucfirst(Session::get('adminSession'))}}</span><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('/admin/settings') }}"><i class="icon-user"></i>Settings</a></li>
          <li class="divider"></li>
          <li><a href="{{ url('/logout') }}"><i class="icon-key"></i> Log Out</a></li>
        </ul>
      </li>  
  </ul>
</div>
<!--close-top-Header-menu-->
