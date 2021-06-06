<?php use App\Product; use App\Wishlist; ?>   
@extends('layouts.frontLayout.front_design')
@section('content')

<section id="slider"><!--slider-->	
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>
					
					<div class="carousel-inner">
						@foreach($banners as $key => $banner)
						<div class="item @if($key==0) active @endif"> <!-- color for banner background : d9ab2e-->
							<a href="{{ $banner->link }}"><img class="img-responsive" src={{asset('images/frontend_images/banners/'.$banner->image	)}}  alt="" /></a>
						</div>	
						@endforeach					
					</div>
					
					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				
			</div>
		</div>
	</div>
</section><!--/slider-->

<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">

					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								@foreach($categories as $cat)
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{ $cat->name }}
										</a>
									</h4>
								</div>
								<div id="{{$cat->id}}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											@foreach($cat->categories as $subcat)
											<?php $productCount = Product::productCount($subcat->id); ?>
											@if($subcat->status==1)
											<li><a href="{{ url('products/'. $subcat->url) }}">{{ $subcat->name }} ({{ $productCount }}) </a></li>
											@endif
											@endforeach
										</ul>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>

					@include('layouts.frontLayout.front_sidebar')	
				</div>	

				<div class="col-sm-9 padding-right">
						
					<div class="features_items">
						<!-- All products -->
				<h2 class="title text-center">ALL PRODUCTS</h2>
				@foreach($productsAll as $product)
				<div class="col-sm-4">		
					<div class="product-image-wrapper">
						<div class="single-products">
								<div class="productinfo text-center">
									<a href="{{ url('product/'.$product->id) }}" title="More information" alt="Περισσότερες πληροφορίες"> <img class="img-responsive" src="{{asset('images/backend_images/product/small/'.$product->image)}}" alt="" /> </a>
									@if($product->sale_price==0)<h2>Price: {{ $product->price }}&euro;</h2>
									@else
									<h2>
										<span style="text-decoration:line-through; color:black">
										{{ $product->price }}&euro;</span>
										{{ $product->sale_price }}&euro;
									</h2>	
									@endif
									<p><b>Product brand:</b> {{$product->product_brand}}</p>
									<p><b>Product name:</b> {{$product->product_name}}</p>
									<p><b>Product code:</b> {{$product->product_code}}</p>	
									<a href="{{ url('product/'.$product->id) }}" class="btn btn-default add-to-cart" title="More information" alt="Περισσότερες πληροφορίες"><i class="glyphicon glyphicon-info-sign"></i>More info</a>
									
									@if(!empty(Auth::check() ))	
									<?php $count = Wishlist::where(['pro_id' => $product->id,'user_id' => Auth::user()->id])->count(); ?>
									@if($count=="0")
									<div class="choose">
										<ul class="nav nav-pills nav-justified">												
											<li><a href="{{ url('addToWishlist/'.$product->id)}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>		
										</ul>
									</div> 
									@else
										<h5 style="color:green"> Added to <a href="{{url('/wishlist')}}">Wishlist</a></h5>
									@endif	
									@endif
																
								</div>
								@if($product->new_arrival==1)
								<img src="{{asset('images/frontend_images/home/new.png') }}" class="new" alt="" />
								@endif
								@if($product->sale_price != 0)
								<img src="{{asset('images/frontend_images/home/sale.png') }}" class="new" alt="" />
								@endif
								@if($product->feature_item==1)
								<img src="{{asset('images/frontend_images/home/featured.png') }}" class="new" alt="" />
								@endif
						</div>
					</div>
				</div>	
				@endforeach
			</div>
	
				<div align="center">{{ $productsAll->links() }}</div> <!--paginate(6)-->

							<br><br>
								
								@if($new_arrival->count()>0)
								<div class="newarrival_items"><!--new arrival products-->
									<h2 class="title text-center">New Arrival</h2>									
									<div id="newarrival-item-carousel" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
												<?php $count=1; ?>
												@foreach($new_arrival->chunk(3) as $chunk)
											<div <?php if($count==1){ ?> class="item active" <?php } else{
											?>	class="item" <?php } ?>>
													@foreach($chunk as $item)
												<div class="col-sm-4">
													<div class="product-image-wrapper">
														<div class="single-products">
															<div class="productinfo text-center">
																	<a href="{{ url('product/'.$item->id) }}" title="More information" alt="Περισσότερες πληροφορίες"> <img class="img-responsive" src="{{asset('images/backend_images/product/small/'.$item->image)}}" alt="" /> </a>
																	@if($item->sale_price==0)<h2>Price: {{ $item->price }}&euro;</h2>
																	@else
																	<h2>
																		<span style="text-decoration:line-through; color:black">
																		{{ $item->price }}&euro;</span>
																		{{ $item->sale_price }}&euro;
																	</h2>	
																	@endif
																	<p><b>Product brand:</b> {{$item->product_brand}}</p>
																	<p><b>Product name:</b> {{$item->product_name}}</p>
																	<a href="{{ url('product/'.$item->id) }}" class="btn btn-default add-to-cart" title="More information" alt="Περισσότερες πληροφορίες"><i class="glyphicon glyphicon-info-sign"></i>More info</a>
															</div>
															<img src="{{asset('images/frontend_images/home/new.png') }}" class="new" alt="" />
														</div>
													</div>
												</div>
												@endforeach
											</div>
											<?php $count++; ?>
											@endforeach												
										</div>
										 <a class="left newarrival-item-control" href="#newarrival-item-carousel" data-slide="prev">
											<i class="fa fa-angle-left"></i>
										  </a>
										  <a class="right newarrival-item-control" href="#newarrival-item-carousel" data-slide="next">
											<i class="fa fa-angle-right"></i>
										  </a>			
									</div>
								</div><!--/new arrival products-->
								@endif

								<br><br>


								@if($popular_products->count()>0)
								<div class="popular_items"><!--On sale products-->
									<h2 class="title text-center">Popular products</h2>									
									<div id="popular-item-carousel" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
												<?php $count=1; ?>
												@foreach($popular_products->chunk(3) as $chunk)
											<div <?php if($count==1){ ?> class="item active" <?php } else{
											?>	class="item" <?php } ?>>
													@foreach($chunk as $item)
												<div class="col-sm-4">
													<div class="product-image-wrapper">
														<div class="single-products">
															<div class="productinfo text-center">
																	<a href="{{ url('product/'.$item->id) }}" title="More information" alt="Περισσότερες πληροφορίες"> <img class="img-responsive" src="{{asset('images/backend_images/product/small/'.$item->image)}}" alt="" /> </a>
																	@if($item->sale_price==0)<h2>Price: {{ $item->price }}&euro;</h2>
																	@else
																	<h2>
																		<span style="text-decoration:line-through; color:black">
																		{{ $item->price }}&euro;</span>
																		{{ $item->sale_price }}&euro;
																	</h2>	
																	@endif
																	<p><b>Product brand:</b> {{$item->product_brand}}</p>
																	<p><b>Product name:</b> {{$item->product_name}}</p>
																	<a href="{{ url('product/'.$item->id) }}" class="btn btn-default add-to-cart" title="More information" alt="Περισσότερες πληροφορίες"><i class="glyphicon glyphicon-info-sign"></i>More info</a>
															</div>
															<img src="{{asset('images/frontend_images/home/pop.png') }}" class="new" alt="" />
														</div>
													</div>
												</div>
												@endforeach
											</div>
											<?php $count++; ?>
											@endforeach												
										</div>
										 <a class="left popular-item-control" href="#popular-item-carousel" data-slide="prev">
											<i class="fa fa-angle-left"></i>
										  </a>
										  <a class="right popular-item-control" href="#popular-item-carousel" data-slide="next">
											<i class="fa fa-angle-right"></i>
										  </a>			
									</div>
								</div><!--/On sale products-->
								@endif


								<br><br>

								@if($onsale_item->count()>0)
								<div class="onsale_items"><!--On sale products-->
									<h2 class="title text-center">On Sale</h2>									
									<div id="onsale-item-carousel" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
												<?php $count=1; ?>
												@foreach($onsale_item->chunk(3) as $chunk)
											<div <?php if($count==1){ ?> class="item active" <?php } else{
											?>	class="item" <?php } ?>>
													@foreach($chunk as $item)
												<div class="col-sm-4">
													<div class="product-image-wrapper">
														<div class="single-products">
															<div class="productinfo text-center">
																	<a href="{{ url('product/'.$item->id) }}" title="More information" alt="Περισσότερες πληροφορίες"> <img class="img-responsive" src="{{asset('images/backend_images/product/small/'.$item->image)}}" alt="" /> </a>
																	@if($item->sale_price==0)<h2>Price: {{ $item->price }}&euro;</h2>
																	@else
																	<h2>
																		<span style="text-decoration:line-through; color:black">
																		{{ $item->price }}&euro;</span>
																		{{ $item->sale_price }}&euro;
																	</h2>	
																	@endif
																	<p><b>Product brand:</b> {{$item->product_brand}}</p>
																	<p><b>Product name:</b> {{$item->product_name}}</p>
																	<a href="{{ url('product/'.$item->id) }}" class="btn btn-default add-to-cart" title="More information" alt="Περισσότερες πληροφορίες"><i class="glyphicon glyphicon-info-sign"></i>More info</a>
															</div>
															<img src="{{asset('images/frontend_images/home/sale.png') }}" class="new" alt="" />
														</div>
													</div>
												</div>
												@endforeach
											</div>
											<?php $count++; ?>
											@endforeach												
										</div>
										 <a class="left onsale-item-control" href="#onsale-item-carousel" data-slide="prev">
											<i class="fa fa-angle-left"></i>
										  </a>
										  <a class="right onsale-item-control" href="#onsale-item-carousel" data-slide="next">
											<i class="fa fa-angle-right"></i>
										  </a>			
									</div>
								</div><!--/On sale products-->
								@endif
								
								<br><br>

								@if($feature_item->count()>0)
								<div class="featured_items"><!--featured products-->
									<h2 class="title text-center">Featured Items</h2>									
									<div id="featured-item-carousel" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
												<?php $count=1; ?>
												@foreach($feature_item->chunk(3) as $chunk)
											<div <?php if($count==1){ ?> class="item active" <?php } else{
											?>	class="item" <?php } ?>>
													@foreach($chunk as $item)
												<div class="col-sm-4">
													<div class="product-image-wrapper">
														<div class="single-products">
															<div class="productinfo text-center">
																	<a href="{{ url('product/'.$item->id) }}" title="More information" alt="Περισσότερες πληροφορίες"> <img class="img-responsive" src="{{asset('images/backend_images/product/small/'.$item->image)}}" alt="" /> </a>
																	@if($item->sale_price==0)<h2>Price: {{ $item->price }}&euro;</h2>
																	@else
																	<h2>
																		<span style="text-decoration:line-through; color:black">
																		{{ $item->price }}&euro;</span>
																		{{ $item->sale_price }}&euro;
																	</h2>	
																	@endif
																	<p><b>Product brand:</b> {{$item->product_brand}}</p>
																	<p><b>Product name:</b> {{$item->product_name}}</p>
																	<a href="{{ url('product/'.$item->id) }}" class="btn btn-default add-to-cart" title="More information" alt="Περισσότερες πληροφορίες"><i class="glyphicon glyphicon-info-sign"></i>More info</a>
															</div>
															<img src="{{asset('images/frontend_images/home/featured.png') }}" class="new" alt="" />													
														</div>
													</div>
												</div>
												@endforeach
											</div>
											<?php $count++; ?>
											@endforeach												
										</div>
										 <a class="left featured-item-control" href="#featured-item-carousel" data-slide="prev">
											<i class="fa fa-angle-left"></i>
										  </a>
										  <a class="right featured-item-control" href="#featured-item-carousel" data-slide="next">
											<i class="fa fa-angle-right"></i>
										  </a>			
									</div>
								</div><!--/featured products-->
								@endif

								<br><br>
																										
						</div>
					</div>
			</div>		
	</section>
@endsection

