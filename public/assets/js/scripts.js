$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });

$(".close-menu").on("click", function(){
    $(".navbar-collapse").removeClass("show");
    return false;
});


// $('.adrsModify .fa').click(function() {
//     $('.adrsAction').toggleClass("openAction");
// });

$(document).ready(function () {
    $('#product_scroller').owlCarousel({
		loop:false,
		margin:5,
		nav: true,
        navText: [""],
        dots: false,
		autoplay:true,
		smartSpeed:2000,
		autoplayTimeout:3000,
		autoplayHoverPause:true,
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
			items:3
			}
		}
	});
    });

$(document).ready(function () {
    $('#training_scroller').owlCarousel({
		loop:true,
		margin:5,
		nav: true,
        navText: [""],
        dots: false,
		autoplay:true,
		smartSpeed:2000,
		autoplayTimeout:3000,
		autoplayHoverPause:true,
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
			items:4
			}
		}
	});
    });

// Owl Carousel Js
$(document).ready(function () {
	$('#testimonial_scroller').owlCarousel({
		loop:true,
		margin:5,
		nav: true,
		navText: [""],
        dots: true,
		autoplay:true,
		smartSpeed:2000,
		autoplayTimeout:3000,
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
});



// ==========Accordion Js============

$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}

	var accordion = new Accordion($('#accordion'), false);
});




// JavaScript Document

// JavaScript Document
function isDevice() {
    return ((/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase())))
}

function initZoom(width, height) {
    $.removeData('#zoom_10', 'elevateZoom');
    $('.zoomContainer').remove();
    $('.zoomWindowContainer').remove();
    $("#zoom_10").elevateZoom({
        responsive: true,
        tint: true,
        tintColour: '#E84C3C',
        tintOpacity: 0.5,
        easing: true,
        borderSize: 0,
        lensSize: 100,
        constrainType: "height",
        loadingIcon: "https://icodefy.com/Tools/iZoom/images/loading.GIF",
        containLensZoom: false,
        zoomWindowPosition: 1,
        zoomWindowOffetx: 20,
        zoomWindowWidth: width,
        zoomWindowHeight: height,
        gallery: 'gallery_pdp',
        galleryActiveClass: "active",
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 500,
        lensFadeIn: 500,
        lensFadeOut: 500,
        cursor: "https://icodefy.com/Tools/iZoom/images/zoom-out.png",
        imageCrossfade: false
    });
    $("#zoom_10").bind("click", function(e) {
        var ez =   $('.zoom').data('elevateZoom');
            $.fancybox(ez.getGalleryList());
        return false;
    });

}

$(document).ready(function() {
    /* init vertical carousel if thumb image length greater that 4 */
    if ($("#gallery_pdp a").length > 4) {
        $("#gallery_pdp a").css("margin", "0");
        $("#gallery_pdp").rcarousel({
            orientation: "vertical",
            visible: 4,
            width: 105,
            height: 70,
            margin: 5,
            step: 1,
            speed: 500,
        });
        $("#ui-carousel-prev").show();
        $("#ui-carousel-next").show();
    }
    /* Init Product zoom */
    initZoom(500, 475);

    $("#ui-carousel-prev").click(function() {
        initZoom(500, 475);
    });

    $("#ui-carousel-next").click(function() {
        initZoom(500, 475);
    });

    // $(".zoomContainer").width($("#zoom_10").width());

    // $("body").delegate(".fancybox-inner .mega_enl", "click", function() {
    //     $(this).html("");
    //     $(this).hide();
    // });
			// $('#gallery_pdp img').click((e) => {
			// 	console.log(e)
			// })

});

$(window).resize(function() {
    var docWidth = $(document).width();
    if (docWidth > 769) {
        initZoom(500, 475);
    } else {
        $.removeData('#zoom_10', 'elevateZoom');
        $('.zoomContainer').remove();
        $('.zoomWindowContainer').remove();
        $("#zoom_10").elevateZoom({
            responsive: true,
            tint: false,
            tintColour: '#3c3c3c',
            tintOpacity: 0.5,
            easing: true,
            borderSize: 0,
            loadingIcon: "https://icodefy.com/Tools/iZoom/images/loading.GIF",
            zoomWindowPosition: "productInfoContainer",
            zoomWindowWidth: 330,
            gallery: 'gallery_pdp',
            galleryActiveClass: "active",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 500,
            lensFadeIn: 500,
            lensFadeOut: 500,
            cursor: "https://icodefy.com/Tools/iZoom/images/zoom-out.png",
            imageCrossfade: false
        });
        $("#zoom_10").bind("click", function(e) {
            var ez =   $('.zoom').data('elevateZoom');
              $.fancybox(ez.getGalleryList());
            return false;
        });

    }
})

$(document).ready(function() {
 $("#zoom_10").fancybox();
});





// jQuery(document).ready(function(){
//     // This button will increment the value
//     $('.qtyplus').click(function(e){
//         // Stop acting like a button
//         e.preventDefault();
//         // Get the field name
//         fieldName = $(this).attr('field');
//         // Get its current value
//         var currentVal = parseInt($('input[name='+fieldName+']').val());
//         // If is not undefined
//         if (!isNaN(currentVal)) {
//             // Increment
//             $('input[name='+fieldName+']').val(currentVal + 1);
//         } else {
//             // Otherwise put a 0 there
//             $('input[name='+fieldName+']').val(0);
//         }
//     });
//     // This button will decrement the value till 0
//     $(".qtyminus").click(function(e) {
//         // Stop acting like a button
//         e.preventDefault();
//         // Get the field name
//         fieldName = $(this).attr('field');
//         // Get its current value
//         var currentVal = parseInt($('input[name='+fieldName+']').val());
//         // If it isn't undefined or its greater than 0
//         if (!isNaN(currentVal) && currentVal > 0) {
//             // Decrement one
//             $('input[name='+fieldName+']').val(currentVal - 1);
//         } else {
//             // Otherwise put a 0 there
//             $('input[name='+fieldName+']').val(0);
//         }
//     });
// });





function handleClick(event) {
    // if the click target is not a button, just return
    // so nothing below runs
    if (event.target.tagName !== "BUTTON") {
      return;
    }

    // get the button text
    let buttonValue = event.target.innerText;

    // display the value in #result
    document
      .querySelector("#result")
      .innerText = buttonValue;
  }

  // add event listener to the group of buttons
  // and not every single button
  document
    .querySelector(".buttons")
    .addEventListener("click", handleClick);



 // tabbed content
    $(".tab_content").hide();
    $(".tab_content:first").show();

  /* if in tab mode */
    $("ul.tabs li").click(function() {

      $(".tab_content").hide();
      var activeTab = $(this).attr("rel");
      $("#"+activeTab).fadeIn();

      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");

    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {

      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel");
      $("#"+d_activeTab).fadeIn();

	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");

	  $("ul.tabs li").removeClass("active");
	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });


	/* Extra class "tab_last"
	   to add border to right side
	   of last tab */
	$('ul.tabs li').last().addClass("tab_last");



