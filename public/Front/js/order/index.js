$(document).ready(function () {
    //payment style
    $(".payment dd label input[type='radio']").click(function () {
        $(this).parent().addClass("isTrue");
        $(this).parent().siblings().removeClass("isTrue");
    });
    //测试流程效果，程序对接可将其删除！
    $(".btmNav a:last").click(function () {
        // alert("点击提交订单后跳转支付接口，再返回支付状态！");
        $.ajax({
            type: "POST",
            url: "/confirm",
            data: {
                user_desc: $("[name=user_desc]").val(),
                pay_way_id: $("[name=pay]:checked").val(),
                pay_way_name: $('[name=pay]:checked').text()
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            }, success: function (data, textStatus, jqXHR) {
                if (data) {
                    location.href = "/confirm";
                }
            }
        });
    });
});