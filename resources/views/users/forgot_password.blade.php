@extends('layouts.frontLayout.front_design')

@section('content')


 
<section id="form" style="margin-top:20px;"><!--form-->
    <div class="container">
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
              
            <div class="col-sm-5">
                <div class="login-form"><!--login form-->
                    <div class="panel panel-default">
                    <div class="panel-heading"><h2 style="text-align:center;margin-bottom:15px;color:orange;font-weight:bold;">Forgot Password?</h2></div>
                    <div class="panel-body">
                    <form id="forgotPasswordForm" name="forgotPasswordForm" method="post" action="{{ url('/forgot-password') }}">
                        {{csrf_field()}}
                        <div style="margin-bottom:10px;" class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                            <input name="email" type="email" placeholder="Email Address"  class="form-control" required=""/>
                        </div>
                        <center><button  type="submit" class="btn btn-default">Submit</button></center><br>
                    </form>
                </div>
                </div>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-5">
                <div class="signup-form"><!--sign up form-->
                    <div class="panel panel-default">
                    <div class="panel-heading"><h2 style="text-align:center;margin-bottom:15px;color:orange;font-weight:bold;">New User Signup!</h2></div>
                    <div class="panel-body">
                <form id="registerForm" name="registerForm" method="POST" action="{{ url('/user-register') }}">
                    {{csrf_field()}}
                   
                    <div class="row">
                            <label style="margin-left:20px;margin-bottom:10px;">Select your gender:</label>
                        <label class="radio-inline"><input type="radio" name="gender" style="width:15px;height:15px;" value="Male">Male</label>
                        <label class="radio-inline"><input type="radio" name="gender" style="width:15px;height:15px;" value="Female">Female</label>
                        <label for="gender" generated="true" class="error" style="padding-left:15px;"></label>
                        </div>
                              
                  <div style="margin-bottom:10px;" class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                        <input  id="name" name="name" type="text" placeholder="First name" class="form-control"/>            
                    </div>

                    <div style="margin-bottom:10px;" class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                            <input  id="last_name" name="last_name" type="text" placeholder="Last name" class="form-control"/>
                        </div>

                    <div style="margin-bottom:10px;" class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                        <input id="email" name="email" type="email" placeholder="Email Address" class="form-control" />
                    </div>
                 
                    <div style="margin-bottom:10px;" class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <input  id="myPassword" name="password" type="password" placeholder="Password" class="form-control" />
                    </div>
                  

                    <div style="margin-bottom:10px;" class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <input  id="cpassword" name="cpassword" type="password" placeholder="Confirm password" class="form-control" />
                </div>
               
                <center><div  class="g-recaptcha" data-sitekey="6LfIFJcUAAAAACQaKfJzojJYHlxoKBYmPZTQP4cD" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpired" ></div>
                    <label for="hidden-grecaptcha" generated="true" class="error" style="text-align:center"></label>
                </center>
                <input id="hidden-grecaptcha" name="hidden-grecaptcha" type="text" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;"/>
                
                <br>
                    <center><button type="submit" class="btn btn-default">Sign up</button></center>
                    </form>
                </div>
            </div>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

<!--Captcha validate-->
<script>
    function recaptchaCallback() {
        var response = grecaptcha.getResponse(),
            $button = jQuery(".button-register");
        jQuery("#hidden-grecaptcha").val(response);
        console.log(jQuery("#registerForm").valid());
        if (jQuery("#registerForm").valid()) {
            $button.attr("disabled", false);
        }
        else {
            $button.attr("disabled", "disabled");
        }
    }
    function recaptchaExpired() {
        var $button = jQuery(".button-register");
        jQuery("#hidden-grecaptcha").val("");
        var $button = jQuery(".button-register");
        if (jQuery("#registerForm").valid()) {
            $button.attr("disabled", false);
        }
        else {
            $button.attr("disabled", "disabled");
        }
    }
    </script>
    
    <script type="text/javascript">
        jQuery("#cpassword").CapsLockAlert();
        jQuery("#myPassword").CapsLockAlert();
        jQuery("#password").CapsLockAlert();
      </script>
    


@endsection