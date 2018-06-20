$(document).ready(function () {

    search = $('#search');

    search.click(function () {
        if (!$(this).hasClass('search_ative')) {
            $(this).addClass('search_ative');
            $('.search_form').animate({'margin-top': '10px'}, 300);
        }else{
             $(this).removeClass('search_ative');
            $('.search_form').animate({'margin-top': '-100px'}, 300);
        }
    });
});
