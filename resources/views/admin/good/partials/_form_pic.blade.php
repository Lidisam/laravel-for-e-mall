<div class="tab-pane" id="pics">
    <div id="goods_pics" class="tab-pane">
        <div class="form-group">
            <input type="button" class="col-xs-12 btn" name="add_pics" value="添加图片">
        </div>
    </div>
</div>
<script src="/packages/gallery/js/jquery-2.1.4.min.js"></script>
<script>
    //添加图片事件
    $("[name=add_pics]").click(function () {
        $(this).parent().parent().append('' +
            '<div style="margin-bottom: 5px">' +
            '<input type="file" name="pics[]" class="form-control">' +
            '</div>'
        );
    });
</script>