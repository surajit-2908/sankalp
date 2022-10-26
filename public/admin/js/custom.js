$('#import_contact').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#import_contact')[0].files[0].name;
  $(this).prev('label').text(file);
});


// Header User Toggle JS
$(document).ready(function(){
	$(".userPic a").click(function(){
	  $(".hdrProfileSetting").toggleClass("show-user");
	});
});


// Menu Toggle JS
$(document).ready(function(){
	$(".navbar-toggler").click(function(){
	  $("body").toggleClass("body-fixed");
	});
});
  
$(document).ready(function () {
	$('.navbar-toggler').on('click', function () {
	  $('.navbar-toggler').toggleClass('open');
	  $('.headerMenu').toggleClass('show-nav');
	});
});


$(document).click(function(){
		$(".dropdown").click(function(){
		  $(".dropdown-menu").toggleClass("show");
		});
});



// Owl Carousel Js
$(document).ready(function () {
	$('#home_banner_carousel').owlCarousel({
		loop:true,
		margin:0,
		nav:false,
		navText:["<div class='navBtn prevSlide'></div>","<div class='navBtn nextSlide'></div>"],
		autoplay:true,
		smartSpeed:2000,
		autoplayTimeout:12000,
		autoplayHoverPause:true,
		responsive:{
			0:{
			items:1
			},
			480:{
			items:1
			},
			767:{
			items:1
			},
			1024:{
			items:1
			}
		}
	});


	$('#service_scroll').owlCarousel({
		loop:true,
		navRewind: true,
		margin:20,
		dots:false,
		nav:true,
		navText:["<div class='navBtn prevSlide'></div>","<div class='navBtn nextSlide'></div>"],
		autoplay:true,
		smartSpeed:2000,
		autoplayTimeout:12000,
		autoplayHoverPause:true,
		responsiveClass:true,
		responsive:{
			0:{
			items:1
			},
			480:{
			items:1
			},
			767:{
			items:2
			},
			1024:{
			items:2
			},
		}
	});

});