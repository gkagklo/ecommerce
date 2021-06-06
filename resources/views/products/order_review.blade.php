@extends('layouts.frontLayout.front_design')
@section('content')

<section id="cart_items">
    <div class="container">
      
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Order review</li>
            </ol>
        </div><!--/breadcrums-->

    
        <div class="shopper-informations">
            <div class="row">				
            </div>
        </div>

        <div class="row"> 
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2 style="color:orange">Bill details</h2>
                        <div class="form-group">
                            <label>First name: </label> {{$userDetails->name}}
                        </div>
                        <div class="form-group">
                            <label>Last name: </label> {{$userDetails->last_name}}
                        </div>
                        <div class="form-group">
                            <label>Country: </label> {{$userDetails->country }}    
                        </div>
                        <div class="form-group">
                            <label>City: </label> {{$userDetails->city}}
                        </div>
                        <div class="form-group">
                            <label>State: </label> {{$userDetails->state}}
                        </div>
                        <div class="form-group">
                            <label>Address: </label> {{$userDetails->address}}
                        </div>
                        <div class="form-group">
                            <label>Pincode: </label> {{$userDetails->pincode}}
                        </div>
                        <div class="form-group">
                            <label>Mobile: </label> {{$userDetails->mobile}}
                    </div>
                </div>
            </div>
            <div class="col-sm-1">
                <h2></h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2 style="color:orange">Ship details</h2>
                    <div class="form-group">
                        <label>First name: </label> {{ $shippingDetails->name }}
                        </div>
                        <div class="form-group">
                            <label>Last name: </label> {{ $shippingDetails->last_name }}
                        </div>
                        <div class="form-group">
                            <label>Country: </label> {{$shippingDetails->country}}
                        </div>
                        <div class="form-group">
                            <label>City: </label> {{ $shippingDetails->city }}
                        </div>
                        <div class="form-group">
                            <label>State: </label> {{ $shippingDetails->state }}
                        </div>
                        <div class="form-group">
                            <label>Address: </label> {{ $shippingDetails->address }}
                        </div>
                        <div class="form-group">
                            <label>Pincode: </label> {{ $shippingDetails->pincode }}
                        </div>
                        <div class="form-group">
                            <label>Mobile: </label>  {{ $shippingDetails->mobile }}
                        </div> 
                </div>
            </div>
        </div>

        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_amount = 0; ?>
                    @foreach($userCart as $cart)
                    <tr>
                        <td class="cart_image">
                            <a href=""><img  style="width:200px;" src="{{ asset('images/backend_images/product/small/'.$cart->image) }}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart->product_name}}</a></h4>
							<p style="font-size:16px;"><strong>Code:</strong> {{$cart->product_code}} | <strong>Size:</strong> {{$cart->size}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{$cart->price}}&euro;</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                {{$cart->quantity}}
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$cart->price*$cart->quantity}}&euro;</p>
                        </td>
                    </tr>
                    <?php $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>
                    @endforeach

                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>{{$total_amount}}&euro;</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost (+)</td>
                                    <td>0&euro;</td>										
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Discount Amount (-)</td>
                                    <td>@if(!empty(Session::get('CouponAmount'))) {{ Session::get('CouponAmount') }}&euro; @else 0&euro; @endif</td>										
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td><span>{{ $grand_total = $total_amount - Session::get('CouponAmount') }}&euro;</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <form name="paymentForm" id="paymentForm" action="{{ url('/place-order') }}" method="post">{{ csrf_field() }}
        <input type="hidden" name="grand_total" value="{{ $grand_total }}">
        <div class="payment-options">
            
                <span>
                    <label><strong>Select Payment Method:</strong> </label>
                </span>
                <span>
                    <label><input type="radio" name="payment_method" id="COD" value="COD"> COD</label>
                </span>
                <span>
                    <label><input type="radio" name="payment_method" id="Paypal" value="Paypal"> Paypal</label>
                </span>
                <span style="float:right;">
                    <button type="submit" class="btn btn-default" style="background-color:orange;color:white;" onclick="return selectPaymentMethod();">Place order</button>
                </span>
            </div>
        </form>
    </div>
</section> <!--/#cart_items-->
@endsection