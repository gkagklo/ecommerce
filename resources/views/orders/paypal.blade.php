@extends('layouts.frontLayout.front_design')
@section('content')
<?php
 use App\Order;
?>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanks</li>
				</ol>
			</div>
		</div>
	</section>

	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<h3>Your order has been placed.</h3>
                <p>Your order number is {{ Session::get('order_id') }} and total payable about is {{ Session::get('grand_total') }} &euro;</p>
								<p>Please make payment by clicking on below Payment Button</p>
								<?php
								$orderDetails = Order::getOrderDetails(Session::get('order_id'));
								$orderDetails = json_decode(json_encode($orderDetails));
								?>
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_xclick">
								<input type="hidden" name="business" value="geogkagkloidis-facilitator@hotmail.com">																							
								<input type="hidden" name="item_number" value="{{ Session::get('order_id') }}">
								<input type="hidden" name="amount" value="{{ Session::get('grand_total') }}">
								<input type="hidden" name="currency_code" value="EUR">
								<input type="hidden" name="first_name" value="{{ $orderDetails->name }}">
								<input type="hidden" name="last_name" value="{{ Auth::user()->last_name }}">
								<input type="hidden" name="country" value="GR">
								<input type="hidden" name="city" value="{{ $orderDetails->city }}">
								<input type="hidden" name="state" value="{{ $orderDetails->state }}">
								<input type="hidden" name="address1" value="{{ $orderDetails->address }}">											 							
  							<input type="hidden" name="zip" value="{{ $orderDetails->pincode }}">
  							<input type="hidden" name="night_phone_a" value="{{ $orderDetails->mobile }}">
  							<input type="hidden" name="email" value="{{ $orderDetails->user_email }}">
								<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay now">
								<img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
								<input type="hidden" name="cancel_return" id="cancel_return" value="http://procomputerades.gr/order-review" />
							

								</form>

						
			</div>
		</div>
	</section>

@endsection

<?php 
Session::forget('grand_total');
Session::forget('order_id');
?>