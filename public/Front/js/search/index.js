$(document).ready(function () {
    $(".searchHistory dd:last a").click(function () {
        var clear = confirm("确定清除搜索记录吗?");
        if (clear == true) {
            $(this).parents(".searchHistory").find("dd").remove();
        }
    });

    /**提交表单*/
    $(".searchBtn").click(function () {
        if ($("[name=keyword]").val() == "") {
            layer.msg("搜索内容不能为空");
            $("[name=keyword]").focus();
            return;
        }

        $("[name=form1]").submit();   //提交
    });


    /**
     * 历史搜索记录
     */
    $(".history").click(function () {
        $("[name=keyword]").val($(this).text());
        $("[name=form1]").submit();
    });
});
