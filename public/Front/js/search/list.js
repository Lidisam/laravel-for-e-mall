
$(document).ready(function () {
    $(".des_icon").click(function () {
        $(this).toggleClass("asc_icon");
    });
    $(".drop_icon").click(function () {
        $(".drop_list").toggle();
        $(".drop_list li a").click(function () {
            $(this).parents(".drop_list").hide();
        });
    });
    //飞入动画，具体根据实际情况调整
    $(".addToCart").click(function () {
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
    });
});