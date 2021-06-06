@extends('layouts.frontLayout.front_design')

@section('content')

<section id="form" style="margin-top:20px;">
    <div class="container">
            <div class="breadcrumbs">
                    <ol class="breadcrumb">
                      <li><a href="/">Home</a></li>
                      <li class="active">Account</li>
                    </ol>
                </div> 
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
                    <h2 style="color:orange">User information</h2>
                    <form enctype="multipart/form-data" id="accountForm" name="accountForm" method="POST" action="{{ url('/account') }}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label>Profile image:</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                    <i class="glyphicon glyphicon-picture"></i>  Browse img<input type="file" name="image" id="imgInp" accept=".png, .jpg, .jpeg"  >
                                    </span>
                                </span>
                                <input type="text"  class="form-control" readonly >       
                            </div>
                            <img id='img-upload'/>  
                            @if($userDetails->image!='')
                            <a class="btn btn-danger btn-xs deleteRecord" style="float:right;" href="{{ url('/account/delete-user-image/'.$userDetails->id) }}"><i class="glyphicon glyphicon-remove"></i> Delete img</a><br><br>
                            @endif
                        </div> 
                        <div class="text-center">
                               
                            @if($userDetails->gender == "Male" && $userDetails->image==null)
                                <img src="{{ asset('/images/frontend_images/profile/male.png') }}" class="img-responsive rounded" alt="..." style="width:300px;height:150px;">
                                @elseif($userDetails->gender == "Female" && $userDetails->image==null)
                                <img src="{{ asset('/images/frontend_images/profile/female.png') }}" class="img-responsive rounded" alt="..." style="width:300px;height:150px;">
                                @else
                                <img src="{{ asset('/images/frontend_images/profile/'.$userDetails->image) }}" class="img-responsive rounded" alt="..." style="width:350px;height:250px;">
                                @endif
                               
                          </div><br>
                          <div class="row">
                                <label style="margin-left:20px;margin-bottom:10px;">Select your gender:</label>
                                @if($userDetails->gender=="Male")
                            <label class="radio-inline"><input type="radio" name="gender" style="width:15px;height:15px;" checked="true" value="Male">Male</label>
                            <label class="radio-inline"><input type="radio" name="gender" style="width:15px;height:15px;"  value="Female">Female</label>
                            @else
                            <label class="radio-inline"><input type="radio" name="gender" style="width:15px;height:15px;"  value="Male">Male</label>
                            <label class="radio-inline"><input type="radio" name="gender" style="width:15px;height:15px;" checked="true" value="Female">Female</label>
                            @endif  
                            </div>

                  <div class="form-group"> <label >Fist name: </label>  <input value="{{ $userDetails->name }}" id="name" name="name" type="text" placeholder="First name"/></div>
                  <div class="form-group"> <label >Last name: </label> <input value="{{ $userDetails->last_name }}" id="last_name" name="last_name" type="text" placeholder="Last name"/></div>
                  <div class="form-group"><label >Country: </label><select id="country" name="country" >
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->country_name }}" @if($country->country_name == $userDetails->country) selected @endif > {{ $country->country_name }}</option>
                    @endforeach
                    </select>
                    </div>
                  <div class="form-group"><label >City: </label><input value="{{ $userDetails->city }}" id="city" name="city" type="text" placeholder="City"/></div>
                  <div class="form-group"><label >State: </label><input value="{{ $userDetails->state }}" id="state" name="state" type="text" placeholder="State"/></div>
                  <div class="form-group"><label >Address: </label><input value="{{ $userDetails->address }}" id="address" name="address" type="text" placeholder="Address"/></div>   
                <div class="form-group"><label >Pincode: </label><input value="{{ $userDetails->pincode }}"  id="pincode" name="pincode" type="text" placeholder="Pincode"/></div>
                <div class="form-group"><label >Mobile: </label><input value="{{ $userDetails->mobile }}" id="mobile" name="mobile" type="text" placeholder="Mobile"/></div>
                        <button type="submit" class="btn btn-default">Update</button>
                        </form>
                </div>
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2 style="color:orange">Update Password</h2>
                    <form id="passwordForm" name="passwordForm" method="POST" action="{{ url('/update-user-pwd') }}">
                        {{csrf_field()}}
                        <input  type="password" id="current_pwd" name="current_pwd"  placeholder="Current Password"/>
                        <span id="chkPwd"></span>
                        <input  type="password" id="new_pwd" name="new_pwd"  placeholder="New Password"/>
                        <input  type="password" id="confirm_pwd" name="confirm_pwd"  placeholder="Confirm Password"/>
                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection