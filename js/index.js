$(document).ready(function(){
	$(function () {
		$('.marquee').marquee({
			duration: 9000
		});
	});
	$("#bar_show").click(function(e){
		$("#menu_none").toggleClass("show-menu-none");
		$("body").addClass("hidden-scroll");
		if($("#uesr_none").hasClass("show-uesr-none")){
			$("#uesr_none").removeClass("show-uesr-none");
		}
		else{
			return false;
		}
		e.stopPropagation();
	});
	$("#close").click(function(){
		$("#menu_none").removeClass("show-menu-none");
		$("body").removeClass("hidden-scroll");
	});
	$("#menu_none").click(function(e){
		e.stopPropagation();
	});
	$(document).click(function(){
		$("#menu_none").removeClass("show-menu-none");
		$("body").removeClass("hidden-scroll");
	});
	$(".user_button").click(function(e){
		$("#uesr_none").toggleClass("show-uesr-none");
		$("body").addClass("hidden-scroll");
		if($("#menu_none").hasClass("show-menu-none")){
			$("#menu_none").removeClass("show-menu-none");		
		}
		else{
			return false;
		}
		e.stopPropagation();
	});
	$("#uesr_none").click(function(e){
		e.stopPropagation();
	});
	$("#close_uesr").click(function(){
		$("#uesr_none").removeClass("show-uesr-none");
		$("body").removeClass("hidden-scroll");
	});
	$(document).click(function(){
		$("#uesr_none").removeClass("show-uesr-none");
		$("body").removeClass("hidden-scroll");
	});
	$(".search_button").click(function(){
		$(".search_fix").addClass("show");
		if($("#menu_none").hasClass("show-menu-none")){
			$("#menu_none").removeClass("show-menu-none");	}
			else{
				return false;
			}
		});
	$(".close_search").click(function(e){
		$(".search_fix").removeClass("show");
	});
	// nav rdw
	// cart end
	$(".login_regiter").click(function(e){
		$(".nav_login").toggleClass("show-nav-login");
		$(".login_regiter span").toggleClass("bg");
		e.stopPropagation();
	});

	$(document).click(function(){
		$(".nav_login").removeClass("show-nav-login");
		$(".login_regiter span").removeClass("bg");
	});
	// user end
	// nav head
});
var owl = $('#koicarosel.owl-carousel');
$('#koicarosel.owl-carousel').owlCarousel({
	loop: true,
	dots: true,
	nav: true,
	autoplay: true,
	margin: 10,
	autoplayTimeout: 5000,
	autoplaySpeed:2000, 
	autoplayHoverPause: true,
	smartSpeed:2000,
	navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
	responsive:{
		0:{
			items:1
		},
		768:{
			items:1
		},
		992:{
			items:1
		},
		1200:{
			items:1
		}
	}
});
$(window).scroll(function(){
	if($(this).scrollTop() > 350){
		$("#goTop").css({"opacity": "0.9" , "pointer-events": "all"});
	}
	else{
		$("#goTop").css({"opacity": "0" , "pointer-events": "none"});
	}
});
$("#goTop").click(function(){
	$("html, body").animate({ scrollTop: 0 }, 1000);
	return false; 
});
$(".tab-content").hide();
$(".tab-content:first").show();
$(".tabs li:first").addClass("active");
$(".tabs li").click(function(){
	$(".tabs li").removeClass("active");
	$(this).addClass("active");
	$(".tab-content").hide();
	var selectored = $(this).find("a").attr("href");
	$(selectored).show();
});
$(".row-picture.lightbox-container").lightweightLightbox();

//all-item
$(document).ready(function() {
	$('select:not(.ignore)').niceSelect();      
	FastClick.attach(document.body);
});
$(window).scroll(function(){
	if ($(window).scrollTop() >= 300) {
		$("#sticky").addClass('sticky');
	}
	else{
		$("#sticky").removeClass('sticky');
	}
}); 

//cart
 $(document).ready(function() {
   $(".up").on('click',function(){
     var $incdec = $(this).prev();
     if ($incdec.val() < $(this).data("max")) {
      $incdec.val(parseInt($incdec.val())+1);
    }
  });

   $(".down").on('click',function(){
    var $incdec = $(this).next();
    if ($incdec.val() > $(this).data("min")) {
      $incdec.val(parseInt($incdec.val())-1);
    }
  });
 }); 


//Js + Ajax validate form register

if ($("#form_register").length > 0) {

    $("#form_register").validate({
      
	    rules: {
		    name: {
		        required: true,
		        minlength: 8,
		        maxlength: 16,
		    },
		    password: {
                required: true,
                minlength: 8,
                maxlength: 16,
	        },
	        password_again: {
                required: true,
                minlength: 8,
                maxlength: 16,
                equalTo: "#password",
	        },
		    email: {
                required: true,
                email: true,
	        },
	        phone: {
	            required: true,
	            digits:true,
	            minlength: 10,
	            maxlength:11,
	        },     
	    },

	    messages: {
		    name: {
		        required: "Bạn chưa nhập tên tài khoản",
		        minlength: "Tên tài khoản phải trong khoảng từ 8 đến 16 ký tự",
		        maxlength: "Tên tài khoản phải trong khoảng từ 8 đến 16 ký tự",
		    },
		    password: {
                required: "Bạn chưa nhập mật khẩu",
                minlength: "Mật khẩu phải trong khoảng từ 8 đến 16 ký tự",
                maxlength: "Mật khẩu phải trong khoảng từ 8 đến 16 ký tự",
	        },
	        password_again: {
                required: "Bạn chưa nhập lại mật khẩu",
                minlength: "Mật khẩu phải trong khoảng từ 8 đến 16 ký tự",
                maxlength: "Mật khẩu phải trong khoảng từ 8 đến 16 ký tự",
                equalTo: "Xác nhận chưa trùng với mật khẩu đã nhập",
	        },
	        email: {
		        required: "Bạn chưa nhập email",
		        email: "Không đúng định dạng email",
		    },
		    phone: {
		        required: "Bạn chưa nhập số điện thoại",
		        digits: "Làm ơn chỉ nhập số",
		        minlength: "Số điện thoại phải gồm 10 hoặc 11 chữ số",
		        maxlength: "Số điện thoại phải gồm 10 hoặc 11 chữ số",
		    },
	    },

	    submitHandler: function(form) {

		    $.ajaxSetup({
	          	headers: {
	             	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	         	}
		    });

		    //$('#send_form').html('Sending..');

			/*var data = {'name': $('#name').val(),
						'password': $('#password').val(),
                        'email': $('#email').val(), 
                        'phone': $('phone').val(), 
                        '_token': $('input[name=_token]').val(),
                        };*/
   			//console.log(data);

		    $.ajax({
		        url: "http://localhost/koibento/form/register",
		        type: "POST",
		        dataType: "json", 
		       	data: $('#form_register').serialize(),
		        success: function( response ){
		            //$('#send_form').html('Đăng ký');
		            $('#res_message').show();
		            $('#res_message').html(response.message);

		            $('#res_message').html(response.message);
		            $('#msg_div').removeClass('d-none');
		            document.getElementById("form_register").reset();

		            setTimeout(function(){
			            $('#res_message').hide();
			            $('#msg_div').hide();
		            },15000);
		        }          
		    });
		        
	    }
 	});
}

///Js + Ajax validate form register
/*Js + Ajax cart confirm*/

if ($("#form_cart_confirm").length > 0) {

    $("#form_cart_confirm").validate({
      
	    rules: {
		    phone_cart: {
		        required: true,
	            digits:true,
	            minlength: 10,
	            maxlength:11,
		    },
		    date_cart: {
                required: true,
	        },
		    address_cart: {
                required: true,
	        },    
	    },

	    messages: {
		    phone_cart: {
		        required: "Bạn chưa nhập số điện thoại",
		        digits: "Làm ơn chỉ nhập số",
		        minlength: "Số điện thoại phải gồm 10 hoặc 11 chữ số",
		        maxlength: "Số điện thoại phải gồm 10 hoặc 11 chữ số",
		    },
		    date_cart: {
                required: "Bạn chưa nhập thời gian hẹn giao hàng",
	        },
	        address_cart: {
		        required: "Bạn chưa nhập địa chỉ giao hàng",
		    },
	    },

	    submitHandler: function(form) {

		    $.ajaxSetup({
	          	headers: {
	             	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	         	}
		    });

		    $.ajax({
		        url: "http://localhost/koibento/cart/confirm",
		        type: "POST",
		        dataType: "json", 
		       	data: $('#form_cart_confirm').serialize(),
		        success: function( response ){
		            //$('#send_form').html('Đăng ký');
		            $('#res_message').show();
		            $('#res_message').html(response.message);

		            $('#res_message').html(response.message);
		            $('#msg_div').removeClass('d-none');
		            $('#modal-cart-confirm').modal('hide');
		            $('#cart_update_success').modal('show');
		            document.getElementById("form_cart_confirm").reset(); 

		            setTimeout(function(){
			            $('#res_message').hide();
			            $('#msg_div').hide();
			            location.reload();
		            },15000);

		        }          
		    });
		        
	    }
 	});
}

//Ajax cart confirm

//Ajax change password

if ($("#change_password").length > 0) {

    $("#change_password").validate({
      
	    rules: {
		    change_password_old: {
		        required: true,
	            minlength: 8,
	            maxlength:16,
		    },
		    change_password_new: {
                required: true,
	            minlength: 8,
	            maxlength:16,
	        },
	        change_password_new_again: {
                required: true,
	            minlength: 8,
	            maxlength:16,
	            equalTo: "#change_password_new",
	        },
	    },

	    messages: {
		    change_password_old: {
		        required: "Bạn chưa nhập mật khẩu cũ",
		        minlength: "Mật khẩu phải có độ dài từ 8 đến 16 ký tự",
		        maxlength: "Mật khẩu phải có độ dài từ 8 đến 16 ký tự",
		    },
		    change_password_new: {
                required: "Bạn chưa nhập mật khẩu mới",
		        minlength: "Mật khẩu mới phải có độ dài từ 8 đến 16 ký tự",
		        maxlength: "Mật khẩu mới phải có độ dài từ 8 đến 16 ký tự",
	        },
	        change_password_new_again: {
                required: "Bạn chưa nhập lại mật khẩu mới",
		        minlength: "Mật khẩu mới phải có độ dài từ 8 đến 16 ký tự",
		        maxlength: "Mật khẩu mới phải có độ dài từ 8 đến 16 ký tự",
		        equalTo: "Xác nhận chưa trùng với mật khẩu mới đã nhập",
	        },
	    },

	    submitHandler: function(form) {

		    $.ajaxSetup({
	          	headers: {
	             	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	         	}
		    });

		    $.ajax({
		        url: "http://localhost/koibento/form/change",
		        type: "PATCH",
		        dataType: "json", 
		       	data: $('#change_password').serialize(),
		        success: function( response ){
		            $('#res_message').show();
		            $('#res_message').html(response.message);

		            $('#msg_div').removeClass('d-none');
		            document.getElementById("change_password").reset(); 

		            setTimeout(function(){
			            $('#res_message').hide();
			            $('#msg_div').hide();
		            },10000);

		        }          
		    });
		        
	    }
 	});
}
//Js + Ajax change password
//Ajax search enginer
$(document).ready(function(){

	$('.searchInput').keyup(function(){
	    var query = $(this).val();
	    if(query != '')
	    {
		    $.ajaxSetup({
	          	headers: {
	             	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	         	}
		    });
		    var _token = $('input[name="_token"]').val();
		    $.ajax({
			    url:"http://localhost/koibento/form/searchSuggest",
			    method:"POST",
			    data:{query:query, _token:_token},
			    success:function(data){
			        $('.searchList').fadeIn();  
			        $('.searchList').html(data);
			    }
		   	});
		}
	});

	$(document).on('click', 'li', function(){  
	    //$('#searchInput').val($(this).text());  
	    $('.searchList').fadeOut();  
	});  

});

//Ajax search enginer

//Lazy loading

document.addEventListener("DOMContentLoaded", function() {
  var lazyloadImages = document.querySelectorAll("img.lazy");    
  var lazyloadThrottleTimeout;
  
  function lazyload () {
    if(lazyloadThrottleTimeout) {
      clearTimeout(lazyloadThrottleTimeout);
    }    
    
    lazyloadThrottleTimeout = setTimeout(function() {
        var scrollTop = window.pageYOffset;
        lazyloadImages.forEach(function(img) {
            if(img.offsetTop < (window.innerHeight + scrollTop)) {
              img.src = img.dataset.src;
              img.classList.remove('lazy');
            }
        });
        if(lazyloadImages.length == 0) { 
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
        }
    }, 20);
  }
  
  document.addEventListener("scroll", lazyload);
  window.addEventListener("resize", lazyload);
  window.addEventListener("orientationChange", lazyload);
});

//Lazy loading

/*$(document).ready(function(){

	if ($("#quantity_form").length > 0) {

		event.preventdefault();

		$(this).validate({

			rules: {
				quantity : {
					digits: true,
				},
			},

			messages: {
			 	quantity : {
			 		digits: "Làm ơn chỉ nhập số.",
			 	},
			},

		});

	}
		
});*/
