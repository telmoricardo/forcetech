$(function () {
    $('.thumbs img').click(function () {
        var cover = $('.cover img');
        var thumb = $(this).attr('src');

        if (cover.attr('src') !== thumb) {
            cover.fadeTo('200', '0', function () {
                cover.attr('src', thumb);
                cover.fadeTo('150', '1');
            });
            
            $('.thumbs img').removeClass('active');
            $(this).addClass('active');
        }
    });
});



