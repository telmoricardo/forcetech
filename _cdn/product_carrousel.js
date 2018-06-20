(function($) {
    $(function() {
        var jcarousel = $('.pcarousel');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var carousel = $(this),
                    width = carousel.innerWidth();
                if (width >= 1024) {
                    width = width / 4;
                } else if (width >= 800) {
                    width = width / 3;
                }else if (width >= 600) {
                    width = width / 2;
                }else if (width >= 320) {
                    width = width / 1;
                }
                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            });

        $('.pcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.pcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });
        
    });
})(jQuery);

////$(function () {
//    $(".product-carrousel").jcarousel()
//            .jcarouselAutoscroll({
//                interval: 5000,
//                target: '+=1',
//                autostart: true
//            });
//    $('#prev').on('jcarouselcontrol:active', function () {
//        $(this).removeClass('inactive');
//    })
//            .on('jcarouselcontrol:inactive', function () {
//                $(this).addClass('inactive');
//            })
//            .jcarouselControl({
//                // Options go here
//                target: '-=1'
//            });
//
//    $('#next').on('jcarouselcontrol:active', function () {
//        $(this).removeClass('inactive');
//    }).on('jcarouselcontrol:inactive', function () {
//        $(this).addClass('inactive');
//    })
//            .jcarouselControl({
//                // Options go here
//                target: '+=1'
//            });
//
//
//    $("#promocao_carrousel").jcarousel()
//            .jcarouselAutoscroll({
//                interval: 5000,
//                target: '+=1',
//                autostart: true
//            });
//    $('#prev-1')
//            .on('jcarouselcontrol:active', function () {
//                $(this).removeClass('inactive');
//            })
//            .on('jcarouselcontrol:inactive', function () {
//                $(this).addClass('inactive');
//            })
//            .jcarouselControl({
//                // Options go here
//                target: '-=1'
//            });
//
//    $('#next-1').on('jcarouselcontrol:active', function () {
//        $(this).removeClass('inactive');
//    })
//            .on('jcarouselcontrol:inactive', function () {
//                $(this).addClass('inactive');
//            })
//            .jcarouselControl({
//                // Options go here
//                target: '+=1'
//            });
//
//    $("#audio_carrousel").jcarousel()
//            .jcarouselAutoscroll({
//                interval: 5000,
//                target: '+=1',
//                autostart: true
//            });
//    $('#prev-2')
//            .on('jcarouselcontrol:active', function () {
//                $(this).removeClass('inactive');
//            })
//            .on('jcarouselcontrol:inactive', function () {
//                $(this).addClass('inactive');
//            })
//            .jcarouselControl({
//                // Options go here
//                target: '-=1'
//            });
//
//    $('#next-2').on('jcarouselcontrol:active', function () {
//        $(this).removeClass('inactive');
//    })
//            .on('jcarouselcontrol:inactive', function () {
//                $(this).addClass('inactive');
//            })
//            .jcarouselControl({
//                // Options go here
//                target: '+=1'
//            });
//
//    $("#info_carrousel").jcarousel()
//            .jcarouselAutoscroll({
//                interval: 5000,
//                target: '+=1',
//                autostart: true
//            });
//    $('#prev-3')
//            .on('jcarouselcontrol:active', function () {
//                $(this).removeClass('inactive');
//            })
//            .on('jcarouselcontrol:inactive', function () {
//                $(this).addClass('inactive');
//            })
//            .jcarouselControl({
//                // Options go here
//                target: '-=1'
//            });
//
//    $('#next-3').on('jcarouselcontrol:active', function () {
//        $(this).removeClass('inactive');
//    })
//            .on('jcarouselcontrol:inactive', function () {
//                $(this).addClass('inactive');
//            })
//            .jcarouselControl({
//                // Options go here
//                target: '+=1'
//            });
//});