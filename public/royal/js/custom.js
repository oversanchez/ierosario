jQuery(document).ready(function () {
    OptionSwitcher.initOptionSwitcher();
});
jQuery(document).ready(function ($) {
    if($(window).width() < 768){
        $(".logo img").attr('src',"/royal/img/logo2.png");
        $(".logo img").css('width',"242px");
        $(".logo img").css('margin',"0px");
    }
    var navbar = $('.navbar-main'), distance = navbar.offset().top, $window = $(window);
    $window.scroll(function () {
        if (($window.scrollTop() >= 140) && ($(".navbar-default").hasClass("navbar-main"))){
            if($(window).width() >= 768){
                if($(".logo img").attr('src') !== "/royal/img/logo2.png" ){
                    $(".logo img").hide();
                    $(".logo img").attr('src',"/royal/img/logo2.png");
                    $(".logo img").css('width',"273px");
                    $(".logo img").css('margin-top',"-1px");
                    setTimeout(function(){$(".logo img").fadeIn("slow"); }, 500);
                }
            }
            $("body").css("padding-top", "70px");
            navbar.removeClass('navbar-fixed-top').addClass('navbar-fixed-top');
        }else {
            if($(window).width() >= 768){
                if($(".logo img").attr('src') !== "/royal/img/logo.png" ){
                    $(".logo img").hide();
                    $(".logo img").attr('src',"/royal/img/logo.png");
                    $(".logo img").css('width',"120px");
                    $(".logo img").css('margin-top',"");
                    setTimeout(function(){$(".logo img").fadeIn("slow"); }, 500);
                }
            }
            $("body").css("padding-top", "0px");
            navbar.removeClass('navbar-fixed-top');
        }
    });
});
jQuery(document).ready(function () {
    jQuery('#about_banner').flexslider({
        animation: "slide",
        controlNav: true,
        animationSpeed: 600,
        slideshowSpeed: 5000,
        easing: "swing",
        directionNav: true,
        prevText: "",
        nextText: "",
        pauseOnAction: false,
        touch: true,
        start: function () {
            jQuery('.flex-active-slide .about_caption').addClass('show')
        },
        before: function () {
            jQuery('.flex-active-slide .about_caption').removeClass('show')
        },
        after: function (slider) {
            jQuery('.flex-active-slide .about_caption').addClass('show')
        }
    });
    jQuery('#single_banner').flexslider({
        animation: "slide",
        controlNav: true,
        animationSpeed: 600,
        slideshowSpeed: 5000,
        easing: "swing",
        directionNav: false,
        prevText: "",
        nextText: "",
        pauseOnAction: false,
        touch: true,
    });
    if (document.documentElement.clientWidth < 992) {
        jQuery('.carousal_section').flexslider({
            animation: "slide",
            controlNav: true,
            animationSpeed: 600,
            slideshowSpeed: 5000,
            easing: "swing",
            directionNav: false,
            prevText: "",
            nextText: "",
            pauseOnAction: false,
            touch: true,
            minItems: 1,
            maxItems: 1,
            move: 1,
            animationLoop: true,
            direction: "horizontal",
            reverse: false,
        });
    }
    jQuery('.carousal_section').flexslider({
        animation: "slide",
        controlNav: true,
        animationSpeed: 600,
        slideshowSpeed: 5000,
        easing: "swing",
        directionNav: false,
        prevText: "",
        nextText: "",
        pauseOnAction: false,
        touch: true,
        itemWidth: 475,
        minItems: 1,
        maxItems: 2,
        move: 1,
        animationLoop: true,
        direction: "horizontal",
        reverse: false,
    });
    (function () {
        var $window = $(window), flexslider = {vars: {}};

        function getGridSize() {
            return (window.innerWidth < 600) ? 2 : (window.innerWidth < 800) ? 3 : (window.innerWidth < 900) ? 4 : 5;
        }

        $window.load(function () {
            $('.flexslider').flexslider({
                animation: "slide",
                animationLoop: false,
                itemWidth: 228,
                itemMargin: 0,
                prevText: "",
                nextText: "",
                minItems: getGridSize(),
                maxItems: getGridSize()
            });
        });
        $window.resize(function () {
            var gridSize = getGridSize();
            flexslider.vars.minItems = gridSize;
            flexslider.vars.maxItems = gridSize;
        });
    }());
    $('[data-toggle="tooltip"]').tooltip();
    $("#guiest_id1").selectbox();
    $("#guiest_id2").selectbox();
    $(".option-select").selectbox();
    $('.videoLeft img').click(function () {
        video = '<iframe width="550" height="368" src="' + $(this).attr('data-video') + '"></iframe>';
        $(this).replaceWith(video);
    });
    $('.admission_video img').click(function () {
        video = '<iframe width="769" height="454" src="' + $(this).attr('data-video') + '"></iframe>';
        $(this).replaceWith(video);
    });
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        closeBtnInside: false,
        gallery: {enabled: true, navigateByImgClick: true, preload: [0, 1]},
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.', titleSrc: function (item) {
                return item.el.attr('title') + '';
            }
        }
    });
    new WOW().init();
    jQuery(document).ready(function ($) {
        $('span.timer').counterUp({delay: 5, time: 2000});
    });
    (function (w, i, d, g, e, t, s) {
        w[d] = w[d] || [];
        t = i.createElement(g);
        t.async = 1;
        t.src = e;
        s = i.getElementsByTagName(g)[0];
        s.parentNode.insertBefore(t, s);
    })(window, document, '_gscq', 'script', '//widgets.getsitecontrol.com/46851/script.js');
    $(document).ready(function (event, jsEvent, ui, view) {
        $('#calendar').fullCalendar({
            header: {left: 'prev,next', center: 'title',},
            defaultDate: '2016-03-12',
            editable: true,
            eventLimit: true,
            events: [{title: 'All Day Event', start: '2016-03-01'}, {
                title: 'Long Event',
                start: '2016-03-07',
                end: '2016-03-10'
            }, {id: 999, title: 'Repeating Event', start: '2016-03-09T16:00:00'}, {
                id: 999,
                title: 'Repeating Event',
                start: '2016-03-16T16:00:00'
            }, {title: 'Conference', start: '2016-03-11', end: '2016-03-13'}, {
                title: 'Meeting',
                start: '2016-03-12T10:30:00',
                end: '2016-03-12T12:30:00'
            }, {title: 'Lunch', start: '2016-03-12T12:00:00'}, {
                title: 'Meeting',
                start: '2016-03-12T14:30:00'
            }, {title: 'Happy Hour', start: '2016-01-12T17:30:00'}, {
                title: 'Dinner',
                start: '2016-03-12T20:00:00'
            }, {title: 'Click for Google', url: 'http://google.com/', start: '2016-03-28'}]
        })
        $("a.fc-event").attr("href", "single-events.html")
    });
});
(function (i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
    a = s.createElement(o), m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
ga('create', 'UA-71155940-1', 'auto');
ga('send', 'pageview');
(function () {
    var hm = document.createElement('script');
    hm.type = 'text/javascript';
    hm.async = true;
    hm.src = ('++u-heatmap-it+log-js').replace(/[+]/g, '/').replace(/-/g, '.');
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(hm, s);
})();