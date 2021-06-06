<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="geogkagkloidis-facilitator@hotmail.com">

<?php $count =0;?>
@foreach($userCart as $cart)
   <?php $count++; ?>
   <input type="hidden" name="item_name_{{$count}}" value="{{$cart->product_name}}">
<input type="hidden" name="item_number_{{$count}}" value="{{$cart->product_id}}">
<input type="hidden" name="quantity_{{$count}}" value="{{$cart->quantity}}">
<input type="hidden" name="amount_{{$count}}" value="{{$cart->price}}">
<input type="hidden" name="grand_total" value="{{ $grand_total }}">


<!-- after payment -->
 <input type="hidden" name="return" id="return" value="http://procomputerades.gr/thankyou" />
<!-- Cancel payment -->
  <input type="hidden" name="cancel_return" id="cancel_return" value="http://procomputerades.gr/order-review" />
  <br>
@endforeach


<input name="submit" id="paypalbtn" type="image" onclick="return selectPaymentMethod();" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_200x51.png" alt="PayPal Logo" value="PayPal" formaction="https://www.paypal.com/cgi-bin/webscr">
