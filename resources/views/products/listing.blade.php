<?php 
use App\Product;
use App\Wishlist;
?>

@extends('layouts.frontLayout.front_design')
@section('content')
	
<section>
	<div class="container">
			<div class="breadcrumbs">
					<ol class="breadcrumb">
						@if(!empty($breadcrumb))
						  <?php echo $breadcrumb; ?>
						  @endif
					</ol>
				</div> 		
		<div class="row">

				@if(Session::has('flash_message_error'))
				<div class="alert alert-error alert-block" style="background-color:#f4d2d2">
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

			<div class="col-sm-3">
				@include('layouts.frontLayout.front_sidebar')	
			</div>
		
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">
							@if(!empty($search_product))
								{{ $search_product }} 
							@else
								{{ $categoryDetails->name }} 
							@endif
						</h2>
						@if(!empty($search_product))
						<center><p>{{ $productsAll->count() }} result(s) found for your search.</p></center>
						@endif
						<br>
					@foreach($productsAll as $pro)
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
									<div class="productinfo text-center">

										<a href="{{ url('product/'.$pro->id) }}" title="More information" alt="More information"><img src="{{ asset('/images/backend_images/product/small/'.$pro->image) }}" alt="" /></a>
										@if($pro->sale_price==0)<h2>Price: {{ $pro->price }}&euro;</h2>
										@else
										<h2>
											<span style="text-decoration:line-through; color:black">
												{{ $pro->price }}&euro;
											</span>
												{{ $pro->sale_price }}&euro;
										</h2>	
										@endif
										<p><b>Product brand:</b> {{$pro->product_brand}}</p>
										<p><b>Product name:</b> {{$pro->product_name}}</p>
										<p><b>Product code:</b> {{$pro->product_code}}</p>	
										<a href="{{ url('/product/'.$pro->id) }}" class="btn btn-default add-to-cart" title="More information" alt="More information"><i class="glyphicon glyphicon-info-sign"></i>More info</a>
								
									@if(!empty(Auth::check() ))	
									<?php $count = Wishlist::where(['pro_id' => $pro->id,'user_id' => Auth::user()->id])->count(); ?>
									@if($count=="0")
									<div class="choose">
										<ul class="nav nav-pills nav-justified">												
											<li><a href="{{ url('addToWishlist/'.$pro->id)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										</ul>
									</div> 
									@else
										<h5 style="color:green"> Added to <a href="{{url('/wishlist')}}">Wishlist</a></h5>
									@endif	
									@endif
									
								</div>	

																
												  							

								@if($pro->new_arrival==1)
									<img src="{{asset('images/frontend_images/home/new.png') }}" class="new" alt="" />	
								@endif
								@if($pro->sale_price!=0)
									<img src="{{asset('images/frontend_images/home/sale.png') }}" class="new" alt="" />	
								@endif
								@if($pro->feature_item==1)
									<img src="{{asset('images/frontend_images/home/featured.png') }}" class="new" alt="" />	
								@endif
							</div>
						</div>
					</div>
					@endforeach										
				</div><!--features_items-->
				@if(empty($search_product))
				<div align="center">{{ $productsAll->links() }}</div> <!--paginate(5)-->
				@endif
			</div>
		</div>
	</div>
</section>
<br><br><br><br>
@endsection