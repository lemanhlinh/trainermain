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

    document.getElementById("numberInput").addEventListener("input", function () {
        // Lấy giá trị nhập vào
        let inputValue = this.value;

        // Loại bỏ tất cả các ký tự không phải số dương
        inputValue = inputValue.replace(/[^0-9]/g, "");

        // Đặt lại giá trị vào trường nhập liệu
        this.value = inputValue;
    });
});
