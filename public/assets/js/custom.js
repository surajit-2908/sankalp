// =============================== Fancybox Js ===============================
$(document).ready(function () {
    $(".fancybox").fancybox();
});

/*==============================================
                Tab to Accordion
===============================================*/
!(function ($) {
    "use strict";
    var a = {
        accordionOn: ["xs"],
    };
    $.fn.responsiveTabs = function (e) {
        var t = $.extend({}, a, e),
            s = "";
        return (
            $.each(t.accordionOn, function (a, e) {
                s += " accordion-" + e;
            }),
            this.each(function () {
                var a = $(this),
                    e = a.find("> li > a"),
                    t = $(e.first().attr("href")).parent(".tab-content"),
                    i = t.children(".tab-pane");
                a.add(t).wrapAll('<div class="responsive-tabs-container" />');
                var n = a.parent(".responsive-tabs-container");
                n.addClass(s),
                    e.each(function (a) {
                        var t = $(this),
                            s = t.attr("href"),
                            i = "",
                            n = "",
                            r = "";
                        t.parent("li").hasClass("active") && (i = " active"),
                            0 === a && (n = " first"),
                            a === e.length - 1 && (r = " last"),
                            t
                                .clone(!1)
                                .addClass("accordion-link" + i + n + r)
                                .insertBefore(s);
                    });
                var r = t.children(".accordion-link");
                e.on("click", function (a) {
                    a.preventDefault();
                    var e = $(this),
                        s = e.parent("li"),
                        n = s.siblings("li"),
                        c = e.attr("href"),
                        l = t.children('a[href="' + c + '"]');
                    s.hasClass("active") ||
                        (s.addClass("active"),
                        n.removeClass("active"),
                        i.removeClass("active"),
                        $(c).addClass("active"),
                        r.removeClass("active"),
                        l.addClass("active"));
                }),
                    r.on("click", function (t) {
                        t.preventDefault();
                        var s = $(this),
                            n = s.attr("href"),
                            c = a.find('li > a[href="' + n + '"]').parent("li");
                        s.hasClass("active") ||
                            (r.removeClass("active"),
                            s.addClass("active"),
                            i.removeClass("active"),
                            $(n).addClass("active"),
                            e.parent("li").removeClass("active"),
                            c.addClass("active"));
                    });
            })
        );
    };
})(jQuery);

$(".responsive-tabs").responsiveTabs({
    accordionOn: ["xs", "sm"],
});

// =============================== Menu Js ===============================
$(document).ready(function () {
    $(".hmbrgr-icon").click(function () {
        $("nav.navbar").toggleClass("show-nav");
        $("body").toggleClass("open-menu");
    });
});

$(document).ready(function () {
    $("button.close-nav").click(function () {
        $("nav.navbar").removeClass("show-nav");
        $("body").removeClass("open-menu");
    });
});

// =============================== Room Count Popup Js ===============================
$(document).ready(function () {
    $(".room-count-popup").hide();
});
$(".room-count").on("click", function () {
    $(".room-count-popup").show();
});
$(document).mouseup(function (e) {
    var popup = $(".room-count-popup");
    if (
        !$(".room-count-popup").is(e.target) &&
        !popup.is(e.target) &&
        popup.has(e.target).length == 0
    ) {
        popup.hide();
    }
});

// =============================== Others Js ===============================
$(document).ready(function () {
    $(".close-blue-hdr a").click(function () {
        $(".top-contact-info-hdr").addClass("blue-hdr-none");
        $(".mob-date-room-sec").addClass("top-date-room-sec");
    });
});

if ($(window).width() <= 991) {
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $(".mob-date-room-sec").addClass("reservation-area-top");
            } else {
                $(".mob-date-room-sec").removeClass("reservation-area-top");
            }
        });
    });
}

if ($(window).width() < 991) {
    $(document).ready(function () {
        $(".footer-contact-hdn").click(function () {
            $(".ftr-contact-info").toggleClass("show-ftr-info");
        });
        $(".footer-menu-hdn").click(function () {
            $(".footer-main-menu").toggleClass("show-ftr-info");
        });
    });
}

// =============================== Owl Carousel Js ===============================
// $(document).ready(function () {
// 	var url = "{{env('APP_URL')}}"+"/public/assets/images/left-arrow2.png";
// 	var img1 = '<img src="'+url+'">';
// 	var img2 = "<img src='http://localhost/spring-hotel-bequia/public/assets/images/right-arrow2.png'>";
// 	$('#review_scrl').owlCarousel({
// 		loop:true,
// 		margin:5,
// 		nav:true,
// 		navText: [img1,img2],
// 		autoplay:false,
// 		smartSpeed:2000,
// 		autoplayTimeout:3000,
// 		autoplayHoverPause:true,
// 		responsive:{
// 			0:{
// 			items:1
// 			},
// 			480:{
// 			items:1
// 			},
// 			767:{
// 			items:1
// 			},
// 			1024:{
// 			items:1
// 			}
// 		}
// 	});

// });

// =============================== Calendar Multiple Month Js ===============================
$(document).ready(function () {
    var rangeText = function (start, end) {
            var str = "";
            str += start ? start.format("Do MMMM YYYY") + " to " : "";
            str += end ? end.format("Do MMMM YYYY") : "...";

            return str;
        },
        css = function (url) {
            var head = document.getElementsByTagName("head")[0];
            var link = document.createElement("link");
            link.rel = "stylesheet";
            link.type = "text/css";
            link.href = url;
            head.appendChild(link);
        },
        script = function (url) {
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.async = true;
            s.src = url;
            var head = document.getElementsByTagName("head")[0];
            head.appendChild(s);
        };
    callbackJson = function (json) {
        var id = json.files[0].replace(/\D/g, "");
        document.getElementById("gist-" + id).innerHTML = json.div;

        if (!document.querySelector('link[href="' + json.stylesheet + '"]')) {
            css(json.stylesheet);
        }
    };

    // new Lightpick({
    //     field: document.getElementById('demo-9'),
    //     singleDate: false,
    //     selectBackward: true,
    //     onSelect: function(start, end){
    //         document.getElementById('result-9').innerHTML = rangeText(start, end);
    //     }
    // });

    // new Lightpick({
    //     field: document.getElementById('demo-10'),
    //     singleDate: false,
    //     selectBackward: true,
    //     onSelect: function(start, end){
    //         document.getElementById('result-10').innerHTML = rangeText(start, end);
    //     }
    // });
    // new Lightpick({
    // 	field: document.getElementById('demo-12'),
    // 	singleDate: false,
    // 	numberOfMonths: 12,
    // 	footer: true,
    // 	onSelect: function(start, end){
    // 	    document.getElementById('result-12').innerHTML = rangeText(start, end);
    // 	}
    // 	});

    // new Lightpick({
    // 	field: document.getElementById('demo-13'),
    // 	singleDate: false,
    // 	numberOfMonths: 12,
    // 	footer: true,
    // 	onSelect: function(start, end){
    // 		document.getElementById('result-13').innerHTML = rangeText(start, end);
    // 	}
    // 	});

    new Lightpick({
        field: document.getElementById("demo-14"),
        singleDate: false,
        numberOfMonths: 12,
        footer: true,
        onSelect: function (start, end) {
            document.getElementById("result-14").innerHTML = rangeText(
                start,
                end
            );
        },
    });

});
