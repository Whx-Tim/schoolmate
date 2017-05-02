$(function () {
    $("[clickable]").on('click', function (ev) {
        ev.preventDefault();
        var target = ev.target;

        window.open($(target).attr('clickable'));
    });

    $(".back-top").on('click', function () {
        $('body').animate({scrollTop: 0}, 500);
    });
    
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 400) {
            $(".back-top").removeClass('hide');
        } else {
            $(".back-top").addClass('hide');
        }
    });
});