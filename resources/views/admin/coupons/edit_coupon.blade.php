@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="/admin/view-coupons">Coupons</a> <a href="" class="current">Edit Coupon</a> </div>
    <h1>Coupons</h1>
    @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
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
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Coupon</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/edit-coupon/'.$couponDetails->id) }}" name="edit_coupon" id="edit_coupon" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Coupon code</label>
                <div class="controls">
                <input value="{{ $couponDetails->coupon_code }}" type="text" name="coupon_code" id="coupon_code" class="span11">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                    <input value="{{ $couponDetails->amount }}" type="number" min="1" name="amount" id="amount" class="span11">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Amount type</label>
                <div class="controls">
                    <select name="amount_type" id="amount_type" class="span11">
                        <option  @if($couponDetails->amount_type=="Percentage") selected @endif value="Percentage">Percentage</option>
                        <option  @if($couponDetails->amount_type=="Fixed") selected @endif value="Fixed">Fixed</option>
                    </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Expiry date</label>
                <div class="controls">
                    <input value="{{ $couponDetails->expiry_date }}" type="text" name="expiry_date" id="expiry_date" autocomplete="off" class="span11">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($couponDetails->status=="1") checked @endif >
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Coupon" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection