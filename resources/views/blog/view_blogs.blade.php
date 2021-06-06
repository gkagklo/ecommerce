
@extends('layouts.frontLayout.front_design')
@section('content')

<section>
	<div class="container">
			<div class="breadcrumbs">
                    <ol class="breadcrumb">
                      <li><a href="/">Home</a></li>
                      <li class="active">Blog</li>
                    </ol>
                </div> 
		<div class="row">
			<div class="col-sm-9">
				<div class="blog-post-area">					
					<h2 class="title text-center">LATEST NEWS FROM OUR BLOG</h2>						
					@foreach($post as $posts)
                    <div class="single-blog-post">
                        <h3>{{ $posts->title }}</h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-calendar"></i>{{ $posts->created_at->format('d M, Y') }}</li>
                                <li><i class="fa fa-clock-o"></i> {{ $posts->created_at->format('H:i') }}</li>
                            </ul>
						</div>
								<div class="cont">
									<img class="img-responsive image" src="{{ asset('/images/frontend_images/posts/'.$posts->image) }}" alt="">
									<div class="middle">
										<a href="{{ url('/page/blog/'.$posts->id) }}"><div class="text">MORE INFO</div></a>
									</div>
								</div><br>
								{!! Str_limit($posts->body, 300) !!}
				</div>
				<hr>
				<br>	
				@endforeach	
				<div align="center">{{ $post->links() }}</div> <!--paginate(4)-->
			</div>	
		</div>
	</div>
</section>

@endsection

