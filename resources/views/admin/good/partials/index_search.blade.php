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
<div class="col-md-11 delMargin index_search">
    <div class="form-group">
        <div class="col-md-2">
            <input type="text" maxlength="45" class="search_example form-control" name="goods_name"
                   placeholder="商品名">
        </div>
        <div class="col-md-3 delMargin">
            <div class="col-md-5 delMargin">
                <input type="text" maxlength="15" class="search_example form-control" name="goods_start_price"
                       placeholder="￥价格下限">
            </div>
            <div class="col-md-1 text-center delMargin" style="margin: 0;padding: 0">~~~~</div>
            <div class="col-md-5 delMargin">
                <input type="text" maxlength="15" class="search_example form-control" name="goods_end_price"
                       placeholder="￥价格上限">
            </div>
        </div>
        <div class="col-md-2 delMargin" style="margin-right: 10px;">
            <select name="cat_id" class="search_example form-control">
                <option value="">全部(商品类型)</option>
                @foreach($catDatas as $key => $catData)
                    <option value="{{ $catData->id }}">{{ $catData->cat_name }}</option>
                @endforeach;
            </select>
        </div>
        <div class="col-md-2 delMargin">
            <select name="brand_id" class="search_example form-control">
                <option value="">全部(品牌)</option>
                @foreach($brandDatas as $key => $brandData)
                    <option value="{{ $brandData->id }}">{{ $brandData->brand_name }}</option>
                @endforeach;
            </select>
        </div>
        {{--TODO:服务器部分待修改--}}
        <div class="col-md-5 delMargin">
            <div class="col-md-5 delMargin">
                <input type="text" class="search_example form-control laydate-icon-molv skindemo"
                       name="promote_start_time"
                       onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" readonly
                       style="height: 34px">
            </div>
            <div class="col-md-1 text-center delMargin" style="margin: 0;padding: 0">~~~~</div>
            <div class="col-md-5 delMargin">
                <input type="text" class="search_example form-control laydate-icon-molv skindemo"
                       name="promote_end_time"
                       onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" readonly
                       style="height: 34px">
            </div>
        </div>
        <div class="delMargin radio-style">
            热卖：
            <label class="radio-inline">
                <input type="radio" class="search_example" value="" name="is_hot" checked>全部
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="1" name="is_hot">是
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="0" name="is_hot">否
            </label>
        </div>
        <div class="delMargin radio-style">
            新品：
            <label class="radio-inline">
                <input type="radio" class="search_example" value="" name="is_new" checked>全部
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="1" name="is_new">是
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="0" name="is_new">否
            </label>
        </div>
        <div class="delMargin radio-style">
            精品：
            <label class="radio-inline">
                <input type="radio" class="search_example" value="" name="is_best" checked>全部
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="1" name="is_best">是
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="0" name="is_best">否
            </label>
        </div>
        <div class="delMargin radio-style">
            上架：
            <label class="radio-inline">
                <input type="radio" class="search_example" value="" name="is_on_sale" checked>全部
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="1" name="is_on_sale">是
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="0" name="is_on_sale">否
            </label>
        </div>
        <div class="delMargin radio-style">
            删除：
            <label class="radio-inline">
                <input type="radio" class="search_example" value="" name="is_delete" checked>全部
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="1" name="is_delete">是
            </label>
            <label class="radio-inline">
                <input type="radio" class="search_example" value="0" name="is_delete">否
            </label>
        </div>
    </div>
</div>