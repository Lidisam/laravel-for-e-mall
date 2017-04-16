$(document).ready(function () {
    var mySwiper = new Swiper('#slide', {
        autoplay: 5000,
        visibilityFullFit: true,
        loop: true,
        pagination: '.pagination',
    });
    //product list:Tab
    $(".tab_proList dd").eq(0).show().siblings(".tab_proList dd").hide();
    $(".tab_proList dt a").eq(0).addClass("currStyle");
    $(".tab_proList dt a").click(function () {
        var liindex = $(".tab_proList dt a").index(this);
        $(this).addClass("currStyle").siblings().removeClass("currStyle");
        $(".tab_proList dd").eq(liindex).fadeIn(150).siblings(".tab_proList dd").hide();
    });
    //飞入动画，具体根据实际情况调整
    $(".addToCart").click(function () {
        $.ajax({
            type: "POST",
            url: "/cart/ajaxAdd",
            data: {
                id: $(this).attr('data-content-id'),
                name: $(this).attr('name'),
                price: $(this).attr('about'),
                mark_price: $(this).attr('data-num'),
                img: $(this).attr('data-expand')
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success: function (msg) {
                $(".hoverCart a").html(parseInt($(".hoverCart a").html()) + 1);
                /*测试+1*/
                var shopOffset = $(".hoverCart").offset();
                var cloneDiv = $(this).parent().siblings(".goodsPic").clone();
                var proOffset = $(this).parent().siblings(".goodsPic").offset();
                cloneDiv.css({"position": "absolute", "top": proOffset.top, "left": proOffset.left});
                $(this).parent().siblings(".goodsPic").parent().append(cloneDiv);
                cloneDiv.animate({
                    width: 0,
                    height: 0,
                    left: shopOffset.left,
                    top: shopOffset.top,
                    opacity: 1
                }, "slow");
            }
        });

    });
});