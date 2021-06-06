@extends('layouts.frontLayout.front_design')
@section('content')

<section>
	<div class="container">
            <div class="breadcrumbs">
                    <ol class="breadcrumb">
                      <li><a href="/">Home</a></li>
                      <li class="active">Contact</li>
                    </ol>
                </div> 
        <div class="row">
            <div class="col-sm-8">
                    <h2 class="title text-center"> Contact Us </h2>
                    @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                     @endif
                    <div class="contact-form">     
                            <div class="status alert alert-success" style="display: none"></div>
                    <form action="{{ url('/page/contact') }}" id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                                {{ csrf_field() }}
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                        </div>
                                    <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Subject</span>
                                    <input type="text" name="subject" class="form-control" required="required" >
                                </div>
                                </div>
                                          
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-comment fa-2"></i>                
                                        </div>  
                                        <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
                                    </div>
                                </div>                        
                                <div class="form-group col-md-12">
                                    <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>

                        <div class="col-sm-4">
                            <div class="contact-info">
                                <h2 class="title text-center">Contact Info</h2>
                                <address>
                                    <p>E-Shopper Inc.</p>
                                    <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                                    <p>Newyork USA</p>
                                    <p>Mobile: +2346 17 38 93</p>
                                    <p>Fax: 1-714-252-0026</p>
                                    <p>Email: info@e-shopper.com</p>
                                </address>
                                <div class="social-networks">
                                    <h2 class="title text-center">Social Networking</h2>
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> 
                        
                    <div id="map"></div>
        </div>
    </div>
</section>
<br><br>
 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI7InBGtLRBUut_eBRQjxqkwxC794KWCM&callback=initMap"
async defer></script>

<script>
 function initMap(){
     var options = {
         zoom:11,
         center:{ lat:40.640266, lng:22.9395244 }
     }
     // New Map
     var map = new google.maps.Map(document.getElementById('map'),options);
    //Add Marker
    var marker = new google.maps.Marker({
        position:{ lat:40.640266, lng:22.9395244 },
        map:map
    });
    //Add info window
    var infoWindow = new google.maps.InfoWindow({
        content:'<center><img src="{{ asset('images/frontend_images/home/logo.png') }}" alt="" /></center><br> <h2>E-com Website</h2> ' 
    });
    marker.addListener('click',function(){
        infoWindow.open(map,marker);
    });

 }
</script>

@endsection