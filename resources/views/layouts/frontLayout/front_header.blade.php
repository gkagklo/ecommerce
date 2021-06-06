<?php
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Wishlist;
$wishlistCount=0;
if(Auth::check()){
	$wishlistCount = Wishlist::where('user_id',Auth::user()->id)->count();
}
$categories = Category::with('categories')->where(['parent_id' => 0])->get(); 
$mainCategories = Controller::mainCategories();
$cartCount = Product::cartCount();
//Cart Items drop down menu
if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();  
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();   
        }
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;    
		}
//end cart items
?>
<header id="header"><!--header-->
	<div class="header_top"><!--header_top-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
							<li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header_top-->
	
	<div class="header-middle"><!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="logo pull-left">
						<img src="{{ asset('images/frontend_images/home/logo.png') }}" alt="" />
					</div>
				</div>
				<div class="col-sm-8">
					<div class="shop-menu pull-right">
						<ul class="nav navbar-nav">
							<li><a href="{{url('/orders')}}"><i class="glyphicon glyphicon-list-alt"></i> Orders</a></li>
							<li><a href="{{url('/wishlist')}}"><i class="fa fa-heart"></i> Wishlist ({{$wishlistCount}})</a></li>
							<li><a href="{{url('/cart')}}"><i class="glyphicon glyphicon-shopping-cart"></i> Cart ({{$cartCount}})</a></li>
							@if( empty(Auth::check() ))
							<li><a href="{{url('/login-register')}}"><i class="fa fa-lock"></i> Login-Register</a></li>
							@else
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, {{Auth::user()->name}} <b class="caret"></b></a>
								<ul  class="dropdown-menu">
									<li><a href="{{url('/account')}}"><i class="fa fa-user"></i> Account</a></li>
									<li><a href="{{url('/user-logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
								</ul>
							</li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-middle-->

	<div class="header-bottom"><!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="/" class="active">Home</a></li>	
											
							@foreach($categories as $cat)
							<li class="dropdown"><a href="{{asset('products/'.$cat->url)}}">{{$cat->name}}<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									@foreach($cat->categories as $subcat)
										@if($subcat->status==1)
											<li><a href="{{ url('products/'. $subcat->url) }}">{{ $subcat->name }} </a></li>
										@endif
									@endforeach
							</ul>	
						</li>
						@endforeach			
							<li><a href="/page/contact">Contact</a></li>
							<li><a href="/page/blog">Blog</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="search_box pull-right">
						<form action="{{ url('/search-products') }}" method="post"> {{ csrf_field() }}
						<input type="text" placeholder="Search Product" name="product" required/>
						<button type="submit" style="border:0px; height:33px; margin-left:-3px;"><span class="glyphicon glyphicon-search"></span></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-bottom-->
</header><!--/header-->