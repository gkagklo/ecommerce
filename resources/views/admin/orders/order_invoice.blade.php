<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
                <h2>Order # {{ $orderDetails->id }}</h2>
                <strong>User details:</strong> <br>
                <p><strong>First name:</strong> {{ ucfirst($userDetails->name) }} <strong> Last name:</strong> {{ ucfirst($userDetails->last_name) }} <br>
                <strong>Email:</strong> {{ $orderDetails->user_email }}</p>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br><br>
                    <!--<strong>First name:</strong> {{ ucfirst($userDetails->name) }}<br> 
                    <strong>Last name:</strong> {{ ucfirst($userDetails->last_name) }}<br>-->
                     <strong>Country:</strong> {{$userDetails->country}}<br>
                    <strong>City:</strong> {{$userDetails->city}}<br>
                    <strong>State:</strong> {{$userDetails->state}}<br>
                    <strong>Address:</strong> {{$userDetails->address}}<br>
                    <strong>Pincode:</strong>  {{$userDetails->pincode}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br><br>
                    <strong>Country:</strong> {{$orderDetails->country}}<br>
                    <strong>City:</strong> {{$orderDetails->city}}<br>
                    <strong>State:</strong> {{$orderDetails->state}}<br>
                    <strong>Address:</strong> {{$orderDetails->address}}<br>
                    <strong>Pincode:</strong> {{$orderDetails->pincode}}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
                        {{ $orderDetails->payment_method }}<br>
                      
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
                        {{ $orderDetails->created_at }}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Product code</strong></td>
        							<td class="text-center"><strong>Product name</strong></td>
        							<td class="text-center"><strong>Product size</strong></td>
                                    <td class="text-center"><strong>Product color</strong></td>
                                    <td class="text-center"><strong>Product price</strong></td>
                                    <td class="text-center"><strong>Product quantity</strong></td>
                                    <td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
                              <?php $Subtotal = 0; ?>
                                @foreach( $orderDetails->orders as $pro )
    							<tr>
    								<td>{{ $pro->product_code }}</td>
    								<td class="text-center">{{ $pro->product_name }}</td>
    								<td class="text-center">{{ $pro->product_size }}</td>
                                    <td class="text-center">{{ $pro->product_color }}</td>
                                    <td class="text-center">{{ $pro->product_price }}&euro;</td>
                                    <td class="text-center">{{ $pro->product_qty }}</td>
                                    <td class="text-center">{{ $pro->product_price * $pro->product_qty }}&euro;</td>
                                </tr>
                                <?php $Subtotal = $Subtotal + ($pro->product_price * $pro->product_qty ); ?>
                               @endforeach
                               <tr class="blank_row">
                                    <td bgcolor="#FFFFFF" colspan="7">&nbsp;</td>
                                </tr>
                               <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right">{{ $Subtotal }}&euro;</td>
                            </tr>
                            <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Coupon discount (-)</strong></td>
                                    <td class="thick-line text-right">{{$orderDetails->coupon_amount}}&euro;</td>
                                </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right">{{$orderDetails->grand_total}}&euro;</td>
                            </tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>