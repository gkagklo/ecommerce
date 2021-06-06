@extends('layouts.adminLayout.admin_design')
@section('content')

<!--main-container-part-->
<div id="content">
        <div id="content-header">
          <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="/admin/view-orders">Orders</a> <a href="" class="current">Order Details</a>  </div>
          <h1>Order #{{ $orderDetails->id }}</h1>
          @if(Session::has('flash_message_success'))
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{!! session('flash_message_success') !!}</strong>
          </div>
      @endif
        </div>
        <div class="container-fluid">
          <hr>
          <div class="row-fluid">
            <div class="span6">
                    <div class="widget-box">
                            <div class="widget-title"> 
                              <h5>Order Details</h5>
                            </div>
                            <div class="widget-content nopadding">
                              <table class="table table-striped table-bordered" style="font-size:15px;">
                                <tbody>
                                  <tr>
                                    <td class="taskDesc"> Order Date</td>
                                    <td class="taskStatus"><span>{{$orderDetails->created_at}}</span></td>
                                  </tr>
                                  <tr>
                                    <td class="taskDesc"> Order Status</td>
                                    <td class="taskStatus"><span>{{$orderDetails->order_status}}</span></td>
                                  </tr>
                                  <tr>
                                      <td class="taskDesc"> Order Total</td>
                                      <td class="taskStatus"><span>{{$orderDetails->grand_total}}&euro;</span></td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"> Coupon Code</td>
                                        <td class="taskStatus"><span>{{$orderDetails->coupon_code}}</span></td>
                                      </tr>
                                      <tr>
                                          <td class="taskDesc"> Coupon Amount</td>
                                          <td class="taskStatus"><span>{{$orderDetails->coupon_amount}}&euro;</span></td>
                                        </tr>
                                        <tr>
                                            <td class="taskDesc"> Payment Method</td>
                                            <td class="taskStatus"><span>{{$orderDetails->payment_method}}</span></td>
                                          </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                        <div class="span6">
                          <div class="widget-box">
                                <div class="widget-title"> 
                                  <h5>Customer Details</h5>
                                </div>
                                <div class="widget-content nopadding">
                                  <table class="table table-striped table-bordered" style="font-size:15px;">
                                    <tbody>
                                      <tr>
                                        <td class="taskDesc">Customer First Name</td>
                                        <td class="taskStatus"><span style="color:#0052cc">{{$orderDetails->name}}</span></td>
                                      </tr>
                                      <tr>
                                          <td class="taskDesc">Customer Last Name</td>
                                          <td class="taskStatus"><span style="color:#0052cc">{{$userDetails->last_name}}</span></td>
                                        </tr>
                                      <tr>
                                        <td class="taskDesc">Customer Email</td>
                                        <td class="taskStatus"><span style="color:#0052cc">{{$orderDetails->user_email}}</span></td>
                                      </tr>
                                      <tr>
                                          <td class="taskDesc">Customer Mobile</td>
                                          <td class="taskStatus"><span style="color:#0052cc">{{$userDetails->mobile}}</span></td>
                                        </tr>
                                      
                                    </tbody>
                                  </table>
                            
                                </div>
                              </div>

                              <div class="accordion-group widget-box">
                                  <div class="accordion-heading">
                                    <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                      <h5>Update Order Status</h5>
                                      </a> </div>
                                  </div>
                                  <div class="collapse in accordion-body" id="collapseGOne">
                                    <div class="widget-content" style="font-size:15px;">
                                    <form action="{{ url('admin/update-order-status') }}" method="post"> {{csrf_field()}}
                                    <input type="hidden" name="order_id" value="{{ $orderDetails->id }}">
                                        <table width="100%">
                                          <tr>
                                            <td>
                                                 <select name="order_status" id="order_status" class="control-label" required="">
                                                    <option value="New" @if($orderDetails->order_status == "New") selected @endif>New</option>
                                                    <option value="Pending" @if($orderDetails->order_status == "Pending") selected @endif>Pending</option>
                                                    <option value="Cancelled" @if($orderDetails->order_status == "Cancelled") selected @endif>Cancelled</option>
                                                    <option value="In Process" @if($orderDetails->order_status == "In Process") selected @endif>In Process</option>
                                                    <option value="Shipped" @if($orderDetails->order_status == "Shipped") selected @endif>Shipped</option>
                                                    <option value="Delivered" @if($orderDetails->order_status == "Delivered") selected @endif>Delivered</option>
                                                  </select>
                                            </td>
                                            <td>
                                               <input type="submit" value="Update Status">
                                            </td>
                                          </tr>
                                        </table>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                            </div>
                      </div>  

            <div class="row-fluid">
                            <div class="accordion-group" id="collapse-group">
                                <div class="span6">
                                    <div class="accordion-group widget-box">
                                      <div class="accordion-heading">
                                        <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                          <h5>Billing Details</h5>
                                          </a> </div>
                                      </div>
                                      <div class="collapse in accordion-body" id="collapseGOne">
                                        <div class="widget-content" style="font-size:15px;">               
                                          <strong>Country: </strong>{{$userDetails->country}}<br><hr>
                                          <strong>City: </strong>{{$userDetails->city}}<br><hr>
                                          <strong>State: </strong>{{$userDetails->state}}<br><hr>
                                          <strong>Address: </strong>{{$userDetails->address}}<br><hr>
                                          <strong>Pincode: </strong>{{$userDetails->pincode}}<br>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                             
                                <div class="span6">
                                        <div class="accordion-group widget-box">
                                          <div class="accordion-heading">
                                            <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                              <h5>Shipping Details</h5>
                                              </a> </div>
                                          </div>
                                          <div class="collapse in accordion-body" id="collapseGOne">
                                            <div class="widget-content" style="font-size:15px;">
                                                <strong>Country: </strong>{{$orderDetails->country}}<br><hr>
                                                <strong>City: </strong>{{$orderDetails->city}}<br><hr>
                                                <strong>State: </strong>{{$orderDetails->state}}<br><hr>
                                                <strong>Address: </strong>{{$orderDetails->address}}<br><hr>
                                                <strong>Pincode: </strong>{{$orderDetails->pincode}}<br>
                                            </div>
                                          </div>
                                        </div>
                                    </div>   
                                  </div>  
                              </div>
                              
                      <div class="row-fluid">
                                  <table id="example" class="table table-striped table-bordered" style="width:100%;font-size:15px;">
                                      <thead>
                                          <tr>
                                              <th style="font-size:15px;">Product code</th>
                                              <th style="font-size:15px;">Product name</th>
                                              <th style="font-size:15px;">Product size</th>
                                              <th style="font-size:15px;">Product color</th>
                                              <th style="font-size:15px;">Product price</th>
                                              <th style="font-size:15px;">Product quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach( $orderDetails->orders as $pro )
                                          <tr>
                                              <td>{{ $pro->product_code }}</td>
                                              <td>{{ $pro->product_name }}</td>
                                              <td>{{ $pro->product_size }}</td>
                                              <td>{{ $pro->product_color }}</td>
                                              <td>{{ $pro->product_price }}</td>
                                              <td>{{ $pro->product_qty }}</td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                     </div>   
         
        </div>
      </div>

@endsection