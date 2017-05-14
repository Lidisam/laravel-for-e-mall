$(document).ready(function () {

    /*** 全选购物车*/
    $("#checkAll").click(function () {
        var checkBox = $(".singleCheck");
        if (!checkBox.attr("checked")) {
            checkBox.attr("checked", true);
        } else {
            checkBox.attr("checked", false);
        }
    });

    //show or hide:delBtn
    var totalPrice = $("#totalPrice");
    $(".edit").toggle(function () {
        $(this).parent().siblings("dd").find(".delBtn").fadeIn();
        $(this).html("完成");
        $(".numberWidget").show();
        $(".priceArea").hide();
    }, function () {
        $(this).parent().siblings("dd").find(".delBtn").fadeOut();
        $(this).html("编辑");
        $(".numberWidget").hide();
        $(".priceArea").show();
    });
    //minus
    $(".minus").click(function () {
        var currNum = $(this).siblings(".number");

        if (currNum.val() <= 1) {
            $(this).parents("dd").remove();
            nullTips();
            togglePrice(this, 1, currNum);  //修改价格
        } else {
            currNum.val(parseInt(currNum.val()) - 1);
            togglePrice(this, 1, currNum);  //修改价格
        }
    });
    //plus
    $(".plus").click(function () {
        var currNum = $(this).siblings(".number");
        currNum.val(parseInt(currNum.val()) + 1);
        togglePrice(this, 0, currNum);  //修改价格
    });
    //delBtn
    $(".delBtn").click(function () {
        var rowId = $(this).parent().find('.number').attr('data-icon');
        $(this).parent().remove();
        nullTips();
        $.ajax({  //移除当前购物车商品
            type: "POST",
            url: "/cart/ajaxRemove",
            data: {
                rowId: rowId
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            }
        });
    });
    //isNull->tips
    function nullTips() {
        if ($(".cart dd").length == 0) {
            var tipsCont = "<mark style='display:block;background:none;text-align:center;color:grey;'>购物车为空！</mark>"
            $(".cart").remove();
            $("body").append(tipsCont);
        }
    }

    /**
     * 增加或减少商品改变总价
     */
    function togglePrice(singlePriceObj, mode, currNum) {
        var singlePrice = $(singlePriceObj).parent().parent().find(".priceArea").children("strong");
        var singleMarkPrice = $(singlePriceObj).parent().parent().find(".priceArea").children("del");
        var singleCount = $(singlePriceObj).parent().parent().find("h2").children("span");
        var price = currNum.attr('about');
        var markPrice = currNum.attr('data-expand');

        if (mode == 0) {  //即时修改前端
            totalPrice.text(parseFloat(parseFloat(totalPrice.text()) + parseFloat(price)).toFixed(2));
            singlePrice.text(parseFloat(parseFloat(singlePrice.text()) + parseFloat(price)));
            singleMarkPrice.text(parseFloat(parseFloat(singleMarkPrice.text()) + parseFloat(markPrice)));
            singleCount.text(parseInt(parseInt(singleCount.text()) + 1));  //修改数量
        } else {
            totalPrice.text(parseFloat(parseFloat(totalPrice.text()) - parseFloat(price)).toFixed(2));
            singlePrice.text(parseFloat(parseFloat(singlePrice.text()) - parseFloat(price)));
            singleMarkPrice.text(parseFloat(parseFloat(singleMarkPrice.text()) - parseFloat(markPrice)));
            singleCount.text(parseInt(parseInt(singleCount.text()) - 1));
        }
        //提交服务器修改
        ajaxUpdateCart(currNum);
    }

    /**
     * 提醒服务器修改购物车数量
     * @param currNum
     */
    function ajaxUpdateCart(currNum) {
        var rowId = currNum.attr('data-icon');
        var qty = currNum.val();
        $.ajax({
            type: "POST",
            url: "/cart/ajaxUpdate",
            data: {
                rowId: rowId,
                qty: qty
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            }
        });
    }
});