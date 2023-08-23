$(document).ready(function() {
    var fixmeTop = $('.menu-head').offset().top;
    $(window).scroll(function() {
        var currentScroll = $(window).scrollTop();
        if (currentScroll >= fixmeTop) {
            $('.menu-head').css({
                position: 'fixed',
                top: '0',
                left: '0'
            });
        } else {
            $('.menu-head').css({
                position: 'static'
            });
        }
    });
});
