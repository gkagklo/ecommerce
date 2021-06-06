<?php 
use App\Product;
use App\ProductsAttribute;
use App\Review;
use App\Wishlist;
//AVG PRODUCT RATE
$avg=0;
$avg_rate=0; 
$reviews = Review::where(['product_id'=>$productDetails->id])->get();
	foreach($reviews as $review){
		$avg += $review->rating;
	}
	if(count($reviews)==0){
	 $avg_rate=$avg/1;
	}
	else{
		 $avg_rate=round($avg/count($reviews),2);
} // END AVG PRODUCT RATE							

?>
@extends('layouts.frontLayout.front_design')

@section('content')
<section>
		<div class="container">	
				<div class="breadcrumbs">
						<ol class="breadcrumb">
							  <?php echo $breadcrumb; ?>
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
						<div class="col-sm-9 padding-right">
								<div class="product-details"><!--product-details-->	
									<div class="col-sm-5">
										@if($productDetails->new_arrival==1)
											<img src="{{asset('images/frontend_images/home/new.png') }}" class="new" alt="" />	
										@endif
										@if($productDetails->sale_price!=0)
											<img src="{{asset('images/frontend_images/home/sale.png') }}" class="new" alt="" />	
										@endif									
										@if($productDetails->feature_item==1)
										<img src="{{asset('images/frontend_images/home/featured.png') }}" class="new" alt="" />	
									@endif
									<div class="container">
										<section id="lens">
											<div class="row">
										<br>
										<div class="large-5 column">
										<div class="xzoom-container">
										<img class="xzoom" id="xzoom-default" style="width:300px;"  src="{{ asset('/images/backend_images/product/medium/'.$productDetails->image) }}" xoriginal="{{ asset('/images/backend_images/product/large/'.$productDetails->image) }}"  />
										<div class="xzoom-thumbs">
												<br>
											<a  href="{{ asset('images/backend_images/product/large/'.$productDetails->image) }}">
											<img class="xzoom-gallery" style="width:80px;" src="{{ asset('images/backend_images/product/small/'.$productDetails->image) }}" />
											</a>	
													
								@foreach($productAltImages as $altimage)
									<a  href="{{ asset('images/backend_images/product/large/'.$altimage->image) }}">
									<img  class="xzoom-gallery" style="width:80px;" src="{{ asset('images/backend_images/product/small/'.$altimage->image) }}" />
									</a>	
								@endforeach
								
							</div>	
						</div>		
					</div>
					<div class="large-7 column"></div>
				</div>		
		</section>  
	</div>
</div>
						<div class="col-sm-7">
						<form name="addtocartForm" id="addtocartForm" action="{{ url('add-cart') }}" method="post">
							{{ csrf_field() }}

							<input type="hidden" name="product_id" value="{{$productDetails->id}}">
							<input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
							<input type="hidden" name="product_code" value="{{$productDetails->product_code}}">
							<input type="hidden" name="product_color" value="{{$productDetails->product_color}}">
							@if($productDetails->sale_price==0)
								<input type="hidden" name="price" id="price" value="{{$productDetails->price}}">
							@else
								<input type="hidden" name="price" id="price" value="{{$productDetails->sale_price}}">
							@endif
						
							<div class="product-information"><!--/product-information-->
								<h2 class="bold padding-bottom-7" style="text-align:center;"> <?php echo $avg_rate ?> <small> / 5 </small></h2>
								<div class="my-rating" style="text-align:center;"> <b style="margin-left:5px;font-size:16px;color:orange;margin-bottom:-5px;margin-right:5px;"></b> </div><br>					
								<h2>Product brand: {{$productDetails->product_brand}}</h2>
								<p><b>Product name: </b> {{$productDetails->product_name}}</p>
								
								<p><b>Product code:</b> {{$productDetails->product_code}}</p>
								<p><b>Color:</b> {{$productDetails->product_color}}</p>
								<p> 
									<label><b>Select size:<b> </label> 			
								<select id="selsize" name="size" class="form-control" style="width:150px;display:inline;"> 
										<option value="" disabled selected>Select one</option>
									@foreach($productDetails->attributes as $sizes)
										<option value="{{$productDetails->id}}-{{ $sizes->size }}">{{ $sizes->size }}</option>
									@endforeach
								</select>
								</p>
														
							
								<p ><span id="Availability" style="margin-top:5px; margin-bottom:5px;"> <b>Availability: </b>  @if( $total_stock > 0 ) In stock @else Out of stock @endif </span> </p>						
								<p><i class="fa fa-calendar" style="color:orange;"></i> <b> Created_at: </b> {{$productDetails->created_at->format('d/m/Y  h:i')}}</p>		
								<span>
									@if($productDetails->sale_price==0)
									<span id="getPrice" style="font-size:25px;">Price: {{$productDetails->price}} </span><span style="font-size:25px; margin-left:-20px;">&euro;</span>	
									@else
									<span id="getPrice" style="font-size:25px;">Price: {{$productDetails->sale_price}} </span><span style="font-size:25px; margin-left:-20px;">&euro;</span>
									@endif
									<label>Quantity:</label>
									<input type="number" min="1" name="quantity" value="1" />
									@if($total_stock>0)
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									@endif
								</span>							
								<div class="sharethis-inline-share-buttons"></div>
							</div><!--/product-information-->
						</form>
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
								<li><a href="#care" data-toggle="tab">Material & Care</a></li>
								<li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
								@if(!empty($productDetails->video))
								<li><a href="#product_video" data-toggle="tab">Product Video</a></li>
								@endif	
								<li><a href="#review" data-toggle="tab">Reviews ({{ $reviews->count() }})</a></li>
							</ul>
						</div>
						<div class="tab-content" style="margin-left:20px;">
							<div class="tab-pane active in" id="description" >
								<div class="col-sm-12">
									<p>{!!$productDetails->description!!}</p><br>	
								</div>
							</div>
							
							<div class="tab-pane fade" id="care" >
								<div class="col-sm-12">
									<p>{{$productDetails->care}}</p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="delivery" >
								<div class="col-sm-12">
									<p>100% Original products.<br>
										Cash on delivery might be available.<br>	
										Easy 30 days returns and exchanges.<br>
										Try & Buy might be available.</p>
								</div>
							</div>	

							@if(!empty($productDetails->video))
							<div class="tab-pane fade" id="product_video">
								<div class="col-sm-12">		
									<center><video controls style="max-width:100%; height:auto" >
										<source src="{{ asset('videos/'.$productDetails->video) }}" type="video/mp4">
										<source src="{{ asset('videos/'.$productDetails->video) }}" type="video/ogg">
										Your browser does not support the video tag.
										</video></center>			
								</div>
							</div>	
							@endif	
														
								<div class="tab-pane fade" id="review" >
								<div class="col-sm-12">		
									@if(!empty(Auth::check() ))									
										<div class="panel panel-default">											
											<div class="panel-heading">Comment and Vote</div>
												<div class="panel-body">
													<form id="add_review" name="add_review" method="post"  action="{{ url("/review/add-review") }}">							
														{{ csrf_field() }}							
														<input type="hidden" name="product_id" value="{{ $productDetails->id }}"/>							
																					
											<div class="form-group">
												<textarea id="comment" name="comment" placeholder="Add your comment here..." class="form-control"></textarea>
											</div>
										
											<div class="rate" style="margin-bottom:10px;float:right;">	
													<input type="radio" id="star5" name="rate" value="5" />
													<label for="star5" title="star 5">5 stars</label>
													<input type="radio" id="star4" name="rate" value="4" />
													<label for="star4" title="star 4">4 stars</label>
													<input type="radio" id="star3" name="rate" value="3" />
													<label for="star3" title="star 3">3 stars</label>
													<input type="radio" id="star2" name="rate" value="2" />
													<label for="star2" title="star 2">2 stars</label>
													<input type="radio" id="star1" name="rate" value="1" />
													<label for="star1" title="star 1">1 star</label>
												  </div><br>
												  <label for="rate" generated="true" class="error" style="float:right;"></label>
												  <br>
											<div class="form-group">
												<button type="submit" id="submit" class="btn btn-primary">Add review</button>
											</div>
										</form>									
									</div>
								</div>
							@endif

							<h3 style="text-align:center;color:orange">ALL REVIEWS</h3><br>
										@foreach($reviews as $review)
											<div>
												<div class="panel panel-default">
													<div class="panel-heading" style="font-family:Times New Roman;font-size:18px;">
													From: <strong> 	 {{ ucfirst($review->user->name) }} {{ ucfirst($review->user->last_name) }} </strong> <span class="text-muted" style="float:right"> <i class="fa fa-calendar"></i> {{ $review->created_at->format('d M, Y') }}
														<i class="fa fa-clock-o"></i> {{ $review->created_at->format('H:i') }}	</span>
													</div>
													<div class="panel-body">
													<p style="font-family:Helvetica;font-size:16px;font-weight:normal;">Rate product with:  
														@if($review->rating == 1)
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star"></span>
															<span class="fa fa-star"></span>
															<span class="fa fa-star"></span>
															<span class="fa fa-star"></span>
														@endif 
														@if($review->rating == 2) 
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span> 
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>  
														@endif
														@if($review->rating == 3) 
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span> 
														<span class="fa fa-star checked"></span> 
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span> 
														@endif
														@if($review->rating == 4) 
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span> 
														<span class="fa fa-star checked"></span> 
														<span class="fa fa-star checked"></span> 
														<span class="fa fa-star"></span>
														@endif
														@if($review->rating == 5) 
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span> 
														<span class="fa fa-star checked"></span> 
														<span class="fa fa-star checked"></span> 
														<span class="fa fa-star checked"></span> 
														@endif
													</p>
													<p style="font-family:Helvetica;font-size:15px;font-weight:normal;">{{$review->comment}}</p>

													@if(!Auth::guest())
													@if(Auth::user()->id == $review->user_id )
													<div class="action">
														<a href="#myModal{{ $review->id }}" data-toggle="modal"  title="Edit review" class="btn btn-success btn-xs" style="color:white"><span class="glyphicon glyphicon-pencil"></span></a> 
														<a  rel="{{ $review->id }}" rel1="delete-review" title="Delete review" href="javascript:"  class="btn btn-danger btn-xs deleteRecord" style="color:white"><i class="glyphicon glyphicon-trash"></i></a>
													</div>	
													@endif
													@endif

											<!--Edit review with modal -->
											<div id="myModal{{ $review->id }}" class="modal fade">
													<div class="modal-dialog">				
																	<div class="panel panel-default widget">
																		<div class="panel-heading">
																			<span class="glyphicon glyphicon-comment"></span>
																				<h3 class="panel-title" style="display:inline">
																					Edit your review </h3>
																					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																		</div>
																		<form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('review/edit-review/'.$review->id) }}" name="edit_review" id="edit_review" novalidate="novalidate">{{ csrf_field() }}
																			<div class="panel-body">
																				<ul class="list-group" style="border-color:#ddd;background-color:white;">				
																					<li class="list-group-item" style="border-bottom:none;">
																						<div class="row">
																							<div class="col-xs-10 col-md-11">
																							<div>
																								<div class="mic-info">		
																									<ul class="sinlge-post-meta" style="background-color:white;border-bottom:none;">	 
																									<li><i class="fa fa-user"></i>  {{ ucfirst($review->user->name) }} {{  ucfirst($review->user->last_name) }} </li>
																									<li><i class="fa fa-calendar"></i> {{$review->created_at->format('d M, Y')}}</li>
																									<li><i class="fa fa-clock-o"></i> {{$review->created_at->format('H:i')}}</li>		
																									</ul>
																								</div>
																							</div>
																						
																							<div class="comment-text">
																								<textarea  name="comment" id="comment" class="form-control">{{ $review->comment }}</textarea>
																							</div>
																							@if($review->rating == 1)
																							<label for="star1" title="text">1 star</label>	
																							<input type="radio" id="star1" name="rate" value="1" checked="true"/>	
																							<label for="star2" title="text">2 stars</label>
																							<input type="radio" id="star2" name="rate" value="2" />
																							<label for="star3" title="text">3 stars</label>
																							<input type="radio" id="star3" name="rate" value="3" />
																							<label for="star4" title="text">4 stars</label>
																							<input type="radio" id="star4" name="rate" value="4" />
																							<label for="star5" title="text">5 stars</label>
																							<input type="radio" id="star5" name="rate" value="5" />			
																							@endif

																							@if($review->rating == 2)
																							<label for="star1" title="text">1 star</label>	
																							<input type="radio" id="star1" name="rate" value="1" />	
																							<label for="star2" title="text">2 stars</label>
																							<input type="radio" id="star2" name="rate" value="2" checked="true" />
																							<label for="star3" title="text">3 stars</label>
																							<input type="radio" id="star3" name="rate" value="3" />
																							<label for="star4" title="text">4 stars</label>
																							<input type="radio" id="star4" name="rate" value="4" />
																							<label for="star5" title="text">5 stars</label>
																							<input type="radio" id="star5" name="rate" value="5" />				
																							@endif

																							@if($review->rating == 3)
																							<label for="star1" title="text">1 star</label>	
																							<input type="radio" id="star1" name="rate" value="1" >	
																							<label for="star2" title="text">2 stars</label>
																							<input type="radio" id="star2" name="rate" value="2" />
																							<label for="star3" title="text">3 stars</label>
																							<input type="radio" id="star3" name="rate" value="3" checked="true"//>
																							<label for="star4" title="text">4 stars</label>
																							<input type="radio" id="star4" name="rate" value="4" />
																							<label for="star5" title="text">5 stars</label>
																							<input type="radio" id="star5" name="rate" value="5" />					
																							@endif

																							@if($review->rating == 4)
																							<label for="star1" title="text">1 star</label>	
																							<input type="radio" id="star1" name="rate" value="1" />	
																							<label for="star2" title="text">2 stars</label>
																							<input type="radio" id="star2" name="rate" value="2" />
																							<label for="star3" title="text">3 stars</label>
																							<input type="radio" id="star3" name="rate" value="3" />
																							<label for="star4" title="text">4 stars</label>
																							<input type="radio" id="star4" name="rate" value="4" checked="true"/>
																							<label for="star5" title="text">5 stars</label>
																							<input type="radio" id="star5" name="rate" value="5" />
																							@endif

																							@if($review->rating == 5)
																							<label for="star1" title="text">1 star</label>	
																							<input type="radio" id="star1" name="rate" value="1" />	
																							<label for="star2" title="text">2 stars</label>
																							<input type="radio" id="star2" name="rate" value="2" />
																							<label for="star3" title="text">3 stars</label>
																							<input type="radio" id="star3" name="rate" value="3" />
																							<label for="star4" title="text">4 stars</label>
																							<input type="radio" id="star4" name="rate" value="4" />
																							<label for="star5" title="text">5 stars</label>
																							<input type="radio" id="star5" name="rate" value="5"checked="true" />
																							@endif<br><br>
																							  <label for="rate" generated="true" class="error" style="float:right;"></label>
																							  <br> <br>

																							<div class="form-actions">
																								<input type="submit" value="Edit Review" class="btn btn-success">	
																								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																							</div>
																							</div>				
																						</div>	
																					</li>
																				</ul>
																			</div>
																		</form>
																	</div>					
															</div>
														</div>	
													</div>
												</div>
											</div>										
										@endforeach
									
								</div>
								@if($reviews->count()<=0)
								<h4 style="text-align:center">No reviews at this time.</h4>
								@endif
							</div>								
						</div>
					</div><!--/category-tab-->

				@if($relatedProducts->count()>0)<!--recommended_items-->
					<div class="recommended_items">
						<h2 class="title text-center">recommended items</h2>	
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
							<?php $count=1; ?>
								@foreach($relatedProducts->chunk(3) as $chunk)
							<div <?php if($count==1){ ?> class="item active" <?php } else{
							?>	class="item" <?php } ?>>
									@foreach($chunk as $item)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">												
												<div class="productinfo text-center">		
												<a href="{{ url('product/'.$item->id) }}"><img  style="width:230px;"src="{{ asset('images/backend_images/product/small/'.$item->image) }}" alt="" /></a>
												@if($item->sale_price==0)<h2>Price: {{ $item->price }}&euro;</h2>
												@else
												<h2>
													<span style="text-decoration:line-through; color:black">
													{{ $item->price }}&euro;</span>
													{{ $item->sale_price }}&euro;
												</h2>	
												@endif
													<p>{{$item->product_brand}}</p>
													<p>{{$item->product_name}}</p>
													<a href="{{ url('product/'.$item->id) }}" class="btn btn-default add-to-cart" title="More information" alt="Περισσότερες πληροφορίες"><i class="glyphicon glyphicon-info-sign"></i>More info</a>
												</div>
												@if($item->new_arrival==1)
												<img src="{{asset('images/frontend_images/home/new.png') }}" class="new" alt="" />	
											@endif
												@if($item->sale_price!=0)
												<img src="{{asset('images/frontend_images/home/sale.png') }}" class="new" alt="" />	
											@endif
											@if($item->feature_item==1)
											<img src="{{asset('images/frontend_images/home/featured.png') }}" class="new" alt="" />	
										@endif
										
											</div>										
										</div>										
									</div>								
									@endforeach
								</div>
								<?php $count++; ?>	
							@endforeach	
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					@endif
			
				</div>
			</div>
		</div>
	
	</section>	
	<script>
			// SweetAllert message
			$(document).on('click','.deleteRecord',function(e){
				var id = $(this).attr('rel');
				var deleteFunction = $(this).attr('rel1');
				swal({
				  title: "Are you sure?",
				  text: "Your will not be able to recover this record again!",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonClass: "btn-danger",
				  confirmButtonText: "Yes, delete it!",
				  closeOnConfirm: false
				},
				function(){
					window.location.href="/review/"+deleteFunction+"/"+id;
				});
			});// SweetAllert message
			</script>
<script>
$(".my-rating").starRating({
	initialRating: 	<?php
						$price=0;
						if(count($reviews)==0){
						echo $avg/1;}
						else{
							echo round($avg/count($reviews),2);
						} ?>,
	readOnly:true,
	starSize: 20
  });
</script>

@endsection

