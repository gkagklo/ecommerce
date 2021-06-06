@extends('layouts.frontLayout.front_design')
@section('content')
<?php use App\Wishlist; ?>
<div class="container">
    <div class="row">     					
        <h2 class="title text-center">My Wishlist</h2>            
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
       
        <?php $wishlistCount = Wishlist::where('user_id',Auth::user()->id)->count();  ?>
        @if($wishlistCount==0)
            <center><img  class="img-responsive" src="{{ asset('images/frontend_images/home/wishlist.png') }}" alt="" />  </center>
        @endif
  
        <div class="col-sm-9 padding-right">
            <div class="features_items"><!--features_items-->
            
    @foreach($wishlist as $item)

<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
                <div class="productinfo text-center">

                    <a href="{{ url('product/'.$item->id) }}" title="More information" alt="More information"><img src="{{ asset('/images/backend_images/product/small/'.$item->image) }}" alt="" /></a>
                    @if($item->sale_price==0)<h2>Price: {{ $item->price }}&euro;</h2>
                    @else
                    <h2>
                        <span style="text-decoration:line-through; color:black">
                            {{ $item->price }}&euro;
                        </span>
                            {{ $item->sale_price }}&euro;
                    </h2>	
                    @endif
                    <p><b>Product brand:</b> {{$item->product_brand}}</p>
                    <p><b>Product name:</b> {{$item->product_name}}</p>
                    <p><b>Product code:</b> {{$item->product_code}}</p>	
                    <a href="{{ url('product/'.$item->id) }}" class="btn btn-default add-to-cart" title="More information" alt="More information"><i class="glyphicon glyphicon-info-sign"></i>More info</a>   
                </div>
                <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="{{ url('removeWishlist/'.$item->id)}}"><i class="fa fa-minus-square"></i>Remove from wishlist</a></li>
                        </ul>
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
                <div align="center">{{ $wishlist->links() }}</div> <!--paginate(6)-->
            </div>
    </div>
</div>

@endsection