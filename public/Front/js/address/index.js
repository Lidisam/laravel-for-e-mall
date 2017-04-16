$(document).ready(function(){
    //测试返回页面，程序对接删除即可
    $(".userForm input[type='button']").click(function(){
        alert("地址修改成功！");
        location.href="user_set.html";
    });
    $("[name=select]").click(function () {
        var addressId = $(this).parent().parent().parent().find("a").attr('about');
        $.ajax({
            type: "POST",
            url: "/address/select",
            data: {
                addressId: addressId
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            }
        });

    })
});