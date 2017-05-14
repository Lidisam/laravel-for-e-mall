$(document).ready(function () {
    $(".searchHistory dd:last a").click(function () {
        var clear = confirm("确定清除搜索记录吗?");
        if (clear == true) {
            $(this).parents(".searchHistory").find("dd").remove();
        }
    });

    /**提交表单*/
    $(".searchBtn").click(function () {
        $("[name=form1]").submit();   //提交
    });
});
