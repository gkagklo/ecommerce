
$(document).ready(function(){

$("#access").hide();
$("#type").change(function(){
	var type = $("#type").val();
	if(type == "Admin"){
		$("#access").hide();
	}else{
		$("#access").show();
	}
});


	$("#current_pwd").click(function(){
		var current_pwd = $("#current_pwd").val();
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				if(resp=="false"){
					$("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
				}else if(resp=="true"){
					$("#chkPwd").html("<font color='green'>Current Password is correct</font>");
				}
			},error:function(){
				alert("Error");
			}
		});
	});
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();

	/*$('select').select2();*/
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
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


    // Category Validation
	$("#add_category").validate({
		rules:{
			category_name:{
				required:true
			},
			url:{
				required:true
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

	
$("#add_coupon").validate({
	rules:{
		coupon_code:{
			required:true,
			minlength:5,
			maxlength:15
		},
		amount:{
			required:true,
		},
		amount_type:{
			required:true,
		},
		expiry_date:{
			required:true,
		}
	},
	messages:{
		coupon_code:{
			required: "Coupon code is required",
			maxlength: "Coupon code must not be longer than 15 characters",
			minlength: "Coupon code must be at least 5 characters long",
		
		},	
		amount:{
			required: "Amount is required",
		},
		amount_type:{
			required: "Amount type is required",
		},
		expiry_date:{
			required: "Expiry date is required",
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



	// Validate addtocartform	
	$("#edit_coupon").validate({
		rules:{
			coupon_code:{
				required:true,
				minlength:5,
				maxlength:15
			},
			amount:{
				required:true,
			},
			amount_type:{
				required:true,
			},
			expiry_date:{
				required:true,
			}
		},
		messages:{
			coupon_code:{
				required: "Coupon code is required",
				maxlength: "Coupon code must not be longer than 15 characters",
				minlength: "Coupon code must be at least 5 characters long",
			
			},	
			amount:{
				required: "Amount is required",
			},
			amount_type:{
				required: "Amount type is required",
			},
			expiry_date:{
				required: "Expiry date is required",
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

	// Product Validation
	$("#add_product").validate({
		rules:{
			category_id:{
				required:true
			},
			product_brand:{
				required:true
			},
			product_name:{
				required:true
			},
			product_code:{
				required:true
			},
			product_color:{
				required:true
			},
			price:{
				required:true,
				number:true
			},
			image:{
				required:true
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

	// Product Validation
	$("#edit_product").validate({
		rules:{
			category_id:{
				required:true
			},
			product_brand:{
				required:true
			},
			product_name:{
				required:true
			},
			product_code:{
				required:true
			},
			product_color:{
				required:true
			},
			price:{
				required:true,
				number:true
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
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
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
	
	$("#password_validate").validate({
		rules:{
			/*name:{
				required:true
			},*/
			/*email:{
				required:true,
				email: true
			},*/
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

	$("#add_post").validate({
		rules:{
			title:{
				required:true
			},
			body:{
				required:true
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

	$("#edit_post").validate({
		rules:{
			title:{
				required:true
			},
			body:{
				required:true
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


	
	$("#add_banner").validate({
		rules:{
			title:{
				required:true
			},
			link:{
				required:true
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


	$("#edit_banner").validate({
		rules:{
			title:{
				required:true
			},
			link:{
				required:true
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

		
	$("#add_cms_page").validate({
		rules:{
			title:{
				required:true
			},
			url:{
				required:true
			},
			description:{
				required:true
			},
			
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


	$("#edit_cms_page").validate({
		rules:{
			title:{
				required:true
			},
			url:{
				required:true
			},
			description:{
				required:true
			},
			
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

	/*$("#delCat").click(function(){
		if(confirm('Are you sure to delete the Category?')){
            return true;
        }
        return false;
	});
*/
	/*$("#delProduct").click(function(){
		if(confirm('Are you sure to delete the Product?')){
            return true;
        }
        return false;
	});*/

	$(document).on('click','.deleteRecord',function(e){
        var id = $(this).attr('rel');
        var deleteFunction = $(this).attr('rel1');
        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this Record Again!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
            window.location.href="/admin/"+deleteFunction+"/"+id;
        });
    });

    $(document).ready(function(){
	    var maxField = 10; //Input fields increment limitation
	    var addButton = $('.add_button'); //Add button selector
	    var wrapper = $('.field_wrapper'); //Input field wrapper
		var fieldHTML = '<div class="field_wrapper" style="margin-left:180px;"><div><input type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px; margin-right:2px; margin-top:2px;" /><input type="text" name="size[]" id="size" placeholder="Size" style="width:120px; margin-right:5px; margin-top:5px;" /><input type="text" name="price[]" id="price" placeholder="Price" style="width:120px; margin-right:5px; margin-top:5px;" /><input type="text" name="stock[]" id="stock" placeholder="Stock" style="width:120px; margin-right:5px; margin-top:5px;" /><a href="javascript:void(0);" class="remove_button" title="Remove field"> Remove </a> </div></div>'; //New input field html 
	    var x = 1; //Initial field counter is 1
	    $(addButton).click(function(){ //Once add button is clicked
	        if(x < maxField){ //Check maximum number of input fields
	            x++; //Increment field counter
	            $(wrapper).append(fieldHTML); // Add field html
	        }
	    });
	    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
	        e.preventDefault();
	        $(this).parent('div').remove(); //Remove field html
	        x--; //Decrement field counter
	    });
	});

});
