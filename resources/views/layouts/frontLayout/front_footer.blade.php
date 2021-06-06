<?php
use App\Http\Controllers\Controller;
use App\Post;
$mainCategories = Controller::mainCategories();
?>

<footer id="footer"><!--Footer-->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="companyinfo">
					<img style="width:50px;height:50px;" src="{{ asset('images/frontend_images/home/shop.png') }}" alt="" />	
					
					</div>
				</div>
		
			</div>
		</div>
	</div>	
	<div class="footer-widget">
		<div class="container">
			<div class="row">			
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Quick Shop</h2>
						<ul class="nav nav-pills nav-stacked">
								@foreach($mainCategories as $cat)
								<li><a href="{{asset('products/'.$cat->url)}}">{{$cat->name}}</a></li>
								@endforeach
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Our company</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="/page/about-us">About us</a></li>
							<li><a href="/page/contact">Contact Us</a></li>
							<li><a href="/page/terms">Terms of Use</a></li>
						</ul>
					</div>
				</div>

				<div class="col-sm-3">
					<div class="single-widget">
						<div class="contact-info">
							<h2>Contact Info</h2>
							<address style="color:#8C8C88">
								<p>E-Shopper Inc.</p>
								<p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
								<p>Newyork USA</p>
								<p>Mobile: +2346 17 38 93</p>
								<p>Fax: 1-714-252-0026</p>
								<p>Email: info@e-shopper.com</p>
							</address>						
					</div>			
			</div>
		</div>


				<div class="col-sm-3">
					<div class="single-widget">
						<h2>Latest Posts</h2>
						<?php $posts=Post::orderBy('created_at', 'desc')->take(3)->get(); ?>
						@foreach($posts as $post)
						<div class="hovereffect" >
							<img style="width:300px;height:150px;"  src="{{ asset('images/frontend_images/posts/'.$post->image) }}" alt="" />
							<div class="overlay" >
								<a href="{{ url('/page/blog/'.$post->id) }}" ><h2 style="color:white;">MORE INFO</h2></a>
							</div>								
						</div>&nbsp;
						<p style="font-weight:bold">{{$post->title}}</p>
						<p style="padding-bottom:10px;color:#8C8C88;">Created at: {{ $post->created_at->format('d M, Y') }} {{ $post->created_at->format('H:i') }}</p>
						 @endforeach
					</div>
				</div>
		
			</div>
		</div>
	</div>
	
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<p class="pull-left">Copyright © E-SHOPPER 2019. All rights reserved.</p>
			</div>
		</div>
	</div>
	
</footer><!--/Footer-->
