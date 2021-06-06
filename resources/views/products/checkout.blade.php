@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top:20px;">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Checkout</li>
            </ol>
        </div>
    <form action="{{url('/checkout')}}" method="post">{{ csrf_field() }}
        <div class="row">
            	@if(Session::has('flash_message_success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
						<strong>{!! session('flash_message_success') !!}</strong>
				</div>
				 @endif
				 @if(Session::has('flash_message_error'))
				 <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
					 <button type="button" class="close" data-dismiss="alert">×</button> 
						 <strong>{!! session('flash_message_error') !!}</strong>
				 </div>
				@endif   
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2 style="color:orange;font-weight:bold;">Bill to</h2>
                        <div class="form-group">
                        <label>First name: </label>
                        <input name="billing_name" id="billing_name" value="{{$userDetails->name}}" type="text" placeholder="Billing Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Last name: </label>
                            <input name="billing_last_name" id="billing_last_name" value="{{$userDetails->last_name}}" type="text" placeholder="Billing Last Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Select country: </label>
                            <select id="billing_country" name="billing_country" class="form-control" >
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->country_name }}" @if($country->country_name == $userDetails->country) selected @endif > {{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>City: </label>
                            <input name="billing_city" id="billing_city" value="{{$userDetails->city}}" type="text" placeholder="Billing City" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>State: </label>
                            <input name="billing_state" id="billing_state" value="{{$userDetails->state}}" type="text" placeholder="Billing State" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Address: </label>
                            <input name="billing_address" id="billing_address" value="{{$userDetails->address}}" type="text" placeholder="Billing Address" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Pincode: </label>
                            <input name="billing_pincode" id="billing_pincode" value="{{$userDetails->pincode}}" type="text" placeholder="Billing Pincode" class="form-control"/>
                        </div>
                        <div class="form-group">
                        <label>Mobile: </label>
                        <input name="billing_mobile" id="billing_mobile" value="{{$userDetails->mobile}}" type="text" placeholder="Billing Mobile" class="form-control"/>
                    </div>
                    <br>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="billtoship">
                        <label class="form-check-label" for="billtoship">Shipping Address same as Billing Address</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-1">
                <h2></h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2 style="color:orange;font-weight:bold;">Ship to</h2>
                    <div class="form-group">
                            <label>First name: </label>
                            <input name="shipping_name" id="shipping_name" @if(!empty($shippingDetails->name)) value="{{ $shippingDetails->name }}" @endif type="text" placeholder="Shipping Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Last name: </label>
                            <input name="shipping_last_name" id="shipping_last_name" @if(!empty($shippingDetails->last_name)) value="{{ $shippingDetails->last_name }}" @endif type="text" placeholder="Shipping Last Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Select country: </label>
                            <select id="shipping_country" name="shipping_country" class="form-control" >
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->country_name }}" @if(!empty($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif > {{ $country->country_name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>City: </label>
                            <input name="shipping_city" id="shipping_city" @if(!empty($shippingDetails->city)) value="{{ $shippingDetails->city }}" @endif type="text" placeholder="Shipping City" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>State: </label>
                            <input name="shipping_state" id="shipping_state" @if(!empty($shippingDetails->state)) value="{{ $shippingDetails->state }}" @endif type="text" placeholder="Shipping State" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Address: </label>
                            <input name="shipping_address" id="shipping_address" @if(!empty($shippingDetails->address)) value="{{ $shippingDetails->address }}" @endif type="text" placeholder="Shipping Address" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Pincode: </label>
                            <input name="shipping_pincode" id="shipping_pincode" @if(!empty($shippingDetails->pincode)) value="{{ $shippingDetails->pincode }}" @endif type="text" placeholder="Shipping Pincode" class="form-control"/>
                        </div>
                        <div class="form-group">
                                <label>Mobile: </label>
                                <input name="shipping_mobile" id="shipping_mobile" @if(!empty($shippingDetails->mobile)) value="{{ $shippingDetails->mobile }}" @endif type="text" placeholder="Shipping Mobile" class="form-control"/>
                            </div>
                    <button type="submit" class="btn btn-default">Checkout</button>
                 
                </div>
            </div>
        </div>
    </form>
    </div>
</section>

@endsection