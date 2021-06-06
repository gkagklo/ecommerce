
@extends('layouts.frontLayout.front_design')
@section('content')

<section>
	<div class="container">
		<div class="row">		
			<div class="col-sm-9">
				<div class="blog-post-area">					
					<h2 class="title text-center">{{ $post->title }}</h2>						
					@if(Session::has('flash_message_error'))
					<div class="alert alert-error alert-block" style="background-color:#f2dede;color:#b94a48;border-color:#eed3d7;">
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
			
                    <div class="single-blog-post">
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-calendar"></i>{{ $post->created_at->format('d M, Y') }}</li>
                                <li><i class="fa fa-clock-o"></i> {{ $post->created_at->format('H:i') }}</li>
                            </ul>
                        </div>
					  <img class="img-responsive" src="{{ asset('/images/frontend_images/posts/'.$post->image) }}" alt=""><br><br>
					<p>{!! $post->body !!}</p>
					<br><br>
					<div class="row">
							<div class="panel panel-default widget">
								<div class="panel-heading">
									<span class="glyphicon glyphicon-comment"></span>
									<h3 class="panel-title" style="display:inline">
										Recent Comments</h3>
									<span class="label label-info" style="float:right">
											{{$post->comments->count()}}</span>
								</div>
								<div class="panel-body">									
									<ul class="list-group">								
										@foreach($post->comments as $comment)
										<li class="list-group-item">
											<div class="row">
												<div class="col-xs-10 col-md-11">
													<div>
														<div class="mic-info">		
														<ul class="sinlge-post-meta">	
														<li><i class="fa fa-user"></i>  {{ ucfirst($comment->user->name) }} {{  ucfirst($comment->user->last_name) }} </li>
															<li><i class="fa fa-calendar"></i> {{$comment->created_at->format('d M, Y')}}</li>
															<li><i class="fa fa-clock-o"></i> {{$comment->created_at->format('H:i')}}</li>		
														</ul>
														</div>
													</div>
													<div class="comment-text">
														 <p>{{$comment->comment}}</p>
													</div>
													
													<br>
													
													@if(!Auth::guest())
													@if(Auth::user()->id == $comment->user_id )
													<div class="action">
														<a href="#myModal{{ $comment->id }}" data-toggle="modal"  title="Edit comment" class="btn btn-success btn-xs" style="color:white"><span class="glyphicon glyphicon-pencil"></span></a> 
														<a  rel="{{ $comment->id }}" rel1="delete-comment" title="Delete comment" href="javascript:"  class="btn btn-danger btn-xs deleteRecord" style="color:white"><i class="glyphicon glyphicon-trash"></i></a>
													</div>		
													@endif
													@endif												
												
											<!--Edit comment with modal -->
											<div id="myModal{{ $comment->id }}" class="modal fade">
													<div class="modal-dialog">				
																	<div class="panel panel-default widget">
																		<div class="panel-heading">
																			<span class="glyphicon glyphicon-comment"></span>
																				<h3 class="panel-title" style="display:inline">
																					Edit your comment </h3>
																					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																		</div>
																		<form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('comment/edit-comment/'.$comment->id) }}" name="edit_comment" id="edit_comment" novalidate="novalidate">{{ csrf_field() }}
																			<div class="panel-body">
																				<ul class="list-group">				
																					<li class="list-group-item">
																						<div class="row">
																							<div class="col-xs-10 col-md-11">
																							<div>
																								<div class="mic-info">		
																									<ul class="sinlge-post-meta">	 
																									<li><i class="fa fa-user"></i>  {{ ucfirst($comment->user->name) }} {{  ucfirst($comment->user->last_name) }} </li>
																									<li><i class="fa fa-calendar"></i> {{$comment->created_at->format('d M, Y')}}</li>
																									<li><i class="fa fa-clock-o"></i> {{$comment->created_at->format('H:i')}}</li>		
																									</ul>
																								</div>
																							</div>
																							<div class="comment-text">
																								<textarea  name="comment" id="comment" class="form-control">{{ $comment->comment }}</textarea>
																						
																							</div><br>
														
																							<div class="form-actions">
																								<input type="submit" value="Edit Comment" class="btn btn-success">	
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
													
																
													<br>			
												</div>	
											</div><br>
										</li>	
									@endforeach	
									@if($post->comments->count()<=0)
									<h5>No comments at this time.</h5>
									@endif
									<br>

								
								@if(!empty(Auth::check() ))
								<div class="card">
										<div class="card-block">
											<form id="addcommentform" name="addcommentform" method="post"  action="{{ url("/comment/add-comment") }}">
											{{ csrf_field() }}
											<input type="hidden" name="post_id" value="{{ $post->id }}"/>
											<div class="form-group">
												<textarea id="comment" name="comment" placeholder="Add your comment here..." class="form-control"></textarea>
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-primary">Add comment</button>
											</div>
											</form>
										</div>
								</div>	
								@endif
								</ul>					
								</div>	
							</div>
						</div>	
						<hr>					
				</div>					
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
                window.location.href="/comment/"+deleteFunction+"/"+id;
            });
        });// SweetAllert message
</script>


@endsection

