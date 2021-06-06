
/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

		$(document).ready(function(){
		  $(".changeImage").click(function(){
			  var image = $(this).attr('src');
			  $(".mainImage").attr("src",image);
		  });
		});


	
$().ready(function(){
// Validate Register Form	
	$("#registerForm").validate({
		rules:{

			name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"	
			},
			last_name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"	
			},

			password:{
				required:true,
				minlength:6,	
			},

			email:{
				required:true,
				email:true,	
				remote:"/check-email"
			},

			cpassword:{
				minlength:6,
				equalTo: "#myPassword"
			},
			
			"hidden-grecaptcha": {
				required: true,
				minlength: "255"
			  },

			  gender:{
				  required:true
			  }
		
		
		},
		messages:{
			name:{
				required: "Please enter your name",
				minlength: "Your name must be at least 2 characters long",
				accept: "Name must contain only English characters"
			},
			last_name:{
				required: "Please enter your last name",
				minlength: "Your last name must be at least 2 characters long",
				accept: "Last name must contain only English characters"
			},
			password:{
				required:"Please provide your password",
				minlength: "Your password must be atleast 6 characters long"	
			},
			email:{
				required: "Please enter your e-mail",
				email: "Please enter valid e-mail",
				remote: "Email already exists!"
			},
			cpassword:{
				minlength: "Your confirm password must be atleast 6 characters long",
				equalTo:"Passwords not match"
			},

			"hidden-grecaptcha":{
				required:"Captcha is required"
			},

			gender:{
				required: "Please select your gender"
			}
			
		
		}

		
	});	
//required for confirm password..
	$('#signup').click(function () {
		console.log($('#registerForm').valid());
	});


	$("#main-contact-form").validate({
		rules:{

			name:{
				required:true,
				minlength:2,
			},

			email:{
				required:true,
				email:true
			},

			subject:{
				required:true,
				minlength:2,	
			},
	
			
			message:{
				required:true,
				minlength:2,	
			},
		},
		messages:{
	
			name:{
				required: "Please enter your name",
				minlength: "Your name must be at least 2 characters long",
			},

			email:{
				required: "Please enter your e-mail",
				email: "Please enter valid e-mail",
			},

			subject:{
				required: "Please enter your subject",
				minlength: "Your subject must be at least 2 characters long",
			},

			message:{
				required: "Please enter your message",
				minlength: "Your message must be at least 2 characters long",
			},
		}
	});	






// Validate Login Form	
	$("#loginForm").validate({
		rules:{

			email:{
				required:true,
				email:true
			},

			password:{
				required:true	
			}
	
		},
		messages:{
	
			email:{
				required: "Please enter your e-mail",
				email: "Please enter valid e-mail"
			},

			password:{
				required:"Please provide your password"
			}
			
		}
	});	


	// Validate Account Form		

	$("#accountForm").validate({
		rules:{

			name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"	
			},

			last_name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"	
			},

			address:{
				required:true,
				minlength:3,	
			},

			city:{
				required:true,
				minlength:3,
			},

			state:{
				required:true,
				minlength:3,
			},

			country:{
				required:true,
			},

			pincode:{
				required:true,
			},

			mobile:{
				required:true,
				number:true
			},
		image:{
			required:true,
			accept:"jpg|jpeg|png|gif"
		}
		
		},
		messages:{
			name:{
				required: "Please enter your name",
				minlength: "Your name must be at least 2 characters long",
				accept: "Name must contain only English characters"
			},
			last_name:{
				required: "Please enter your last name",
				minlength: "Your last name must be at least 2 characters long",
				accept: "Last name must contain only English characters"
			},
			address:{
				required:"Please enter your address",
				minlength: "Your address must be atleast 3 characters long"	
			},
			city:{
				required:"Please enter your city",
				minlength: "Your city must be atleast 3 characters long"	
			},
			state:{
				required:"Please enter your state",
				minlength: "Your state must be atleast 3 characters long"
			},
			country:{
				required:"Please select your Country",			
			},
			pincode:{
				required:"Please enter your pincode",			
			},
			mobile:{
				required:"Please enter your mobile number",
				number:"Please enter numbers only"			
			},
			image:{
				required:"Please upload one image",
				accept: "Not an image!"			
			},

		}
	});	

	$("#passwordForm").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});




// Check current password
$('#current_pwd').keyup(function(){
	var current_pwd = $(this).val();
	$.ajax({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type:'post',
		url:'/check-user-pwd',
		data:{current_pwd:current_pwd},
		success:function(resp){
			if(resp=="false"){
				$("#chkPwd").html("<font color='red'>Current password is incorrect</font>");
			}else if(resp=="true"){
				$("#chkPwd").html("<font color='green'>Current password is correct</font>");	
			}
		},error:function(){
			alert("Error");
		}
	});
});




//password strength script

$('#myPassword').passtrength({
	minChars: 6,
	passwordToggle: true,
	tooltip: true,
	eyeImg : "/images/frontend_images/eye.svg" // toggle icon
  });


//Select size on product details
$("#selsize").change(function(){
	var idSize = $(this).val();
	if(idSize == ""){
		return false;
	}
	$.ajax({
		type:'get',
		url:'/get-product-price',
		data:{idSize:idSize},
		success:function(resp){
			/*alert(resp);*/
			var arr = resp.split('#');
			$("#getPrice").html("Price: "+arr[0]);
			$("#price").val(arr[0]);
			if(arr[1]==0){
				$("#cartButton").hide();
				$("Availability").text("Out of stock");
			}else{
				$("#cartButton").show();
				$("Availability").text("In stock");
			}
		},error:function(){
			alert("Error");
		}
	});
});


// Validate addtocartform	
$("#addtocartForm").validate({
	rules:{
		size:{
			required:true,
		}
	},
	messages:{

		size:{
			required: "Please select product size",
		},	
	}
});	

// Validate addcomment form
$("#addcommentform").validate({
	rules:{
		comment:{
			required:true,
		}
	},
	messages:{

		comment:{
			required: "Please write your comment",
		},	
	}
});	

// Validate add_review form
$("#add_review").validate({
	rules:{
		comment:{
			required:true
		},
		rate:{
			required:true
		}
	},
	messages:{

		comment:{
			required: "Please write your comment",
		},	
		rate:{
			required: "Please rate for product"
		}
	}
});	

// Validate add_review form
$("#edit_review").validate({
	rules:{
		comment:{
			required:true
		},
		rate:{
			required:true
		}
	},
	messages:{

		comment:{
			required: "Please write your comment",
		},	
		rate:{
			required: "Please rate for product"
		}
	}
});	

// Copy Billing Address to Shipping Address
$("#billtoship").click(function(){
	if(this.checked){
		$("#shipping_name").val($("#billing_name").val());
		$("#shipping_last_name").val($("#billing_last_name").val());
		$("#shipping_address").val($("#billing_address").val());
		$("#shipping_city").val($("#billing_city").val());
		$("#shipping_state").val($("#billing_state").val());
		$("#shipping_pincode").val($("#billing_pincode").val());
		$("#shipping_mobile").val($("#billing_mobile").val());
		$("#shipping_country").val($("#billing_country").val());
	}else{
		$("#shipping_name").val('');
		$("#shipping_last_name").val('');
		$("#shipping_address").val('');
		$("#shipping_city").val('');
		$("#shipping_state").val('');
		$("#shipping_pincode").val('');
		$("#shipping_mobile").val('');
		$("#shipping_country").val('');
	}
});
 
});//end



// Select payment method
function selectPaymentMethod(){
	if($('#Paypal').is(':checked') || $('#COD').is(':checked')){
	
	}else{
		alert("Please select Payment Method");
		return false;
	}
}






  


	   


