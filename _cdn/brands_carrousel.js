$(function () {
    $(".jbrands").jcarousel()
            .jcarouselAutoscroll({
                interval: 5000,
                target: '+=1',
                autostart: true
            });
    $('#prev').on('jcarouselcontrol:active', function () {
        $(this).removeClass('inactive');
    })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '-=1'
            });

    $('#next').on('jcarouselcontrol:active', function () {
        $(this).removeClass('inactive');
    }).on('jcarouselcontrol:inactive', function () {
        $(this).addClass('inactive');
    })
            .jcarouselControl({
                // Options go here
                target: '+=1'
            });


    $("#promocao_carrousel").jcarousel()
            .jcarouselAutoscroll({
                interval: 5000,
                target: '+=1',
                autostart: true
            });
    $('#prev-1')
            .on('jcarouselcontrol:active', function () {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '-=1'
            });

    $('#next-1').on('jcarouselcontrol:active', function () {
        $(this).removeClass('inactive');
    })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '+=1'
            });

    $("#audio_carrousel").jcarousel()
            .jcarouselAutoscroll({
                interval: 5000,
                target: '+=1',
                autostart: true
            });
    $('#prev-2')
            .on('jcarouselcontrol:active', function () {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '-=1'
            });

    $('#next-2').on('jcarouselcontrol:active', function () {
        $(this).removeClass('inactive');
    })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '+=1'
            });

    $("#info_carrousel").jcarousel()
            .jcarouselAutoscroll({
                interval: 5000,
                target: '+=1',
                autostart: true
            });
    $('#prev-3')
            .on('jcarouselcontrol:active', function () {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '-=1'
            });

    $('#next-3').on('jcarouselcontrol:active', function () {
        $(this).removeClass('inactive');
    })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '+=1'
            });
});