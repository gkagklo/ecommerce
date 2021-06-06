<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @if(!empty($meta_title)) {{ $meta_title }} @else Home | E-Shopper @endif </title>
    @if(!empty($meta_description)) <meta name="description" content="{{ $meta_description }}"> @endif
    @if(!empty($meta_keywords)) <meta name="keywords" content="{{ $meta_keywords }}"> @endif

    <link href="{{ asset('css/frontend_css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/mains.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/passtrength.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/star-rating-svg.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css') }}" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('js/frontend_js/jquery.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/frontend_js/jquery.star-rating-svg.js') }}"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


     <!-- CAPS LOCK MESSAGE -->
    <script src="{{ asset('js/frontend_js/jquery.tipsy.js') }}"></script> 
    <script src="{{ asset('js/frontend_js/jquery.jccapsalert.js') }}"></script> 
    <!-- END OF CAPS LOCK MESSAGE -->
    <!-- xzoom plugin here -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend_css/xzoom.css') }}" media="all" /> 
  <script src="{{ asset('js/frontend_js/modernizr.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/frontend_js/xzoom.min.js') }}"></script> 
  <script src="{{ asset('js/frontend_js/foundation.min.js') }}"></script>
  <script src="{{ asset('js/frontend_js/setup.js') }}"></script>
  <!-- Share Button -->
  <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5ccb087c0ff462001290de0f&product=inline-share-buttons' async='async'></script>
 
</head><!--/head-->

<style>
 
</style>

<body>   	
@include('layouts.frontLayout.front_header')
@yield('content')	
@include('layouts.frontLayout.front_footer')

<script src="{{ asset('js/frontend_js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/frontend_js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('js/frontend_js/price-range.js') }}"></script>
<script src="{{ asset('js/frontend_js/jquery.prettyPhoto.js') }}"></script> 
<script src="{{ asset('js/frontend_js/main.js') }}"></script> 
<script src="{{ asset('js/frontend_js/jquery.validate.js') }}"></script> 
<script src="{{ asset('js/frontend_js/passtrength.js') }}"></script> 





<!--Edit comment modal script-->
<script type="text/javascript">
	$(document).ready(function(){
		$(".btn").click(function(){
			$("#myModal").modal('show');
		});
	});
</script>

<!-- Upload profile image -->
<script>
$(document).ready( function() {
    $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }   
    });	
});
</script>


</body>
</html>

