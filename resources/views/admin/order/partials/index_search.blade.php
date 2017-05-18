<script src="/packages/layer/module/laydate/laydate.js"></script>
<style>
    .delMargin {
        margin: 0;
        padding: 0;
    }

    .radio-style {
        float: left;
        margin-right: 30px;
        height: 34px;
        line-height: 34px;
    }

    .radio-inline input {
        height: 25px;
    }

    .index_search {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px 10px 10px 10px;
        background-color: #fff;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.15);
    }
</style>
<div class="col-md-11 delMargin index_search" style="width: 100%">
    <div class="form-group">
        <div class="col-md-2">
            <input type="text" maxlength="15" class="search_example form-control" name="order_num"
                   placeholder="订单号" onkeyup="this.value=this.value.replace(/\D/g,'')">
        </div>
        <div class="col-md-2">
            <input type="text" maxlength="100" class="search_example form-control" name="consigner"
                   placeholder="收货人">
        </div>
        <div class="col-md-3 delMargin">
            <div class="col-md-5 delMargin">
                <input type="text" maxlength="15" class="search_example form-control" name="order_start_price"
                       placeholder="￥价格下限">
            </div>
            <div class="col-md-1 text-center delMargin" style="margin: 0;padding: 0">~~~~</div>
            <div class="col-md-5 delMargin">
                <input type="text" maxlength="15" class="search_example form-control" name="order_end_price"
                       placeholder="￥价格上限">
            </div>
        </div>
        <div class="col-md-5 delMargin">
            <div class="col-md-5 delMargin">
                <input type="text" class="search_example form-control laydate-icon-molv skindemo"
                       name="order_start_time"
                       onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" readonly
                       style="height: 34px">
            </div>
            <div class="col-md-1 text-center delMargin" style="margin: 0;padding: 0">~~~~</div>
            <div class="col-md-5 delMargin">
                <input type="text" class="search_example form-control laydate-icon-molv skindemo"
                       name="order_end_time"
                       onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" readonly
                       style="height: 34px">
            </div>
        </div>
        <div class="delMargin radio-style">
            付款：
            <label class="radio-inline">
                <input type="radio" class="search_example" value="" name="pay_status" checked>全部
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="0" name="pay_status">未付款
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="1" name="pay_status">已付款
            </label>
        </div>
        <div class="delMargin radio-style">
            发货：
            <label class="radio-inline">
                <input type="radio" class="search_example" value="" name="deliver_status" checked>全部
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="0" name="deliver_status">已发货
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="1" name="deliver_status">未发货
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="2" name="deliver_status">已发货
            </label>
        </div>
        <div class="delMargin radio-style">
            已取消订单：
            <label class="radio-inline">
                <input type="radio" class="search_example" value="" name="is_del" checked>全部
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="1" name="is_del">是
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="0" name="is_del">否
            </label>
        </div>
        {{--S=添加按钮--}}
        <div class="text-right">
            <a href="/admin/order/create" class="btn btn-success btn-md">
                <i class="fa fa-plus-circle"></i> 添加
            </a>
        </div>
        {{--E=添加按钮--}}
    </div>
</div>