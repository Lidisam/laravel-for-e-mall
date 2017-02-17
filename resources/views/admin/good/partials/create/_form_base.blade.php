<div class="tab-pane active" id="home">
    <div class="form-group">
        <label class="col-md-3 control-label">商品名</label>
        <div class="col-md-5">
            <input type="text" maxlength="45" class="form-control" name="goods_name" value="{{ $goods_name }}"
                   autofocus>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">商品分类</label>
        <div class="col-md-5">
            @if(count($catDatas))
                <select name="cat_id" class="form-control">
                    @foreach($catDatas as $key => $catData)
                        <option value="{{ $catData->id }}">{{ $catData->cat_name }}</option>
                    @endforeach;
                </select>
            @else
                <span style="color: #ccc">商品分类为空</span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">拓展分类</label>
        <label class="control-label no-padding-right"><i></i>
            <a href="javascript:void(0);"
               onclick="$('#more_ext_cat').append($('#ext_cat').find('select').clone())">[+]</a>：
        </label>
        <div class="col-md-5" id="ext_cat">
            @if(count($catDatas))
                <select name="ext_cat_id[]" class="form-control">
                    <option value="">选项如下</option>
                    @foreach($catDatas as $key => $catData)
                        <option value="{{ $catData->id }}">{{ $catData->cat_name }}</option>
                    @endforeach;
                </select>
            @else
                <span style="color: #ccc">商品分类为空</span>
            @endif
        </div>
        <div class="col-md-12 text-right" style="padding: 0;">
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-5" id="more_ext_cat"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">品牌</label>
        <div class="col-md-5">
            @if(count($brandDatas))
                <select name="brand_id" class="form-control">
                    @foreach($brandDatas as $key => $brandData)
                        <option value="{{ $brandData->id }}">{{ $brandData->brand_name }}</option>
                    @endforeach;
                </select>
            @else
                <span style="color: #ccc">品牌为空</span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">市场价</label>
        <div class="col-md-5">
            <input type="text" maxlength="50" placeholder="￥ 人民币" class="form-control" name="market_price"
                   value="{{ $market_price }}" onkeyup="this.value=this.value.replace(/[^\.\d]/g,'')">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">本店价</label>
        <div class="col-md-5">
            <input type="text" maxlength="50" placeholder="￥ 人民币" class="form-control" name="shop_price"
                   value="{{ $shop_price }}" onkeyup="this.value=this.value.replace(/[^\.\d]/g,'')">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">赠送积分</label>
        <div class="col-md-5">
            <input type="text" maxlength="100" class="form-control" name="jifen" value="{{ $jifen }}"
                   onkeyup="this.value=this.value.replace(/[^\.\d]/g,'')">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">赠送经验值</label>
        <div class="col-md-5">
            <input type="text" maxlength="100" class="form-control" name="jyz" value="{{ $jyz }}"
                   onkeyup="this.value=this.value.replace(/[^\.\d]/g,'')">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">商品兑换(积分)</label>
        <div class="col-md-5">
            <input type="text" maxlength="100" class="form-control" placeholder="如果要用积分兑换，需要的积分；如果不填则不用"
                   name="jifen_price"
                   value="{{ $jifen_price }}" onkeyup="this.value=this.value.replace(/[^\.\d]/g,'')">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 checkbox control-label">
            <input type="checkbox" name="is_promote" onclick="toggleCheckbox(this)" value="1">促销价
        </label>
        <div class="col-md-5">
            <input type="text" class="form-control" name="promote_price" id="promote_price"
                   value="{{ $promote_price }}" disabled="disabled"
                   onkeyup="this.value=this.value.replace(/[^\.\d]/g,'')">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">促销开始时间</label>
        <div class="col-md-5">
            <input type="text" class="form-control laydate-icon-molv skindemo" name="promote_start_time"
                   onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" disabled="disabled"
                   value="{{ $promote_start_time }}" style="height: 34px">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">促销结束时间</label>
        <div class="col-md-5">
            <input type="text" class="form-control laydate-icon-molv skindemo" name="promote_end_time"
                   onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" disabled="disabled"
                   value="{{ $promote_end_time }}" style="height: 34px">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">logo原图</label>
        <div class="col-md-5">
            <input type="file" class="form-control" name="logo" value="{{ $logo }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">特品选项</label>
        <div class="col-md-9">
            热卖:
            <label class="radio-inline">
                <input type="radio" value="1" name="is_hot" @if($is_hot == 1) checked @endif>是
            </label>
            <label class="radio-inline">
                <input type="radio" value="0" name="is_hot" @if($is_hot == 0) checked @endif>否
            </label>
            |新品:
            <label class="radio-inline">
                <input type="radio" value="1" name="is_new" @if($is_new == 1) checked @endif>是
            </label>
            <label class="radio-inline">
                <input type="radio" value="0" name="is_new" @if($is_new == 0) checked @endif>否
            </label>
            |精品:
            <label class="radio-inline">
                <input type="radio" value="1" name="is_best" @if($is_best == 1) checked @endif>是
            </label>
            <label class="radio-inline">
                <input type="radio" value="0" name="is_best" @if($is_best == 0) checked @endif>否
            </label>
            |上架:
            <label class="radio-inline">
                <input type="radio" value="1" name="is_on_sale"
                       @if($is_on_sale == 1 || $is_on_sale == '') checked @endif>是
            </label>
            <label class="radio-inline">
                <input type="radio" value="0" name="is_on_sale"
                       @if($is_on_sale == 0 && $is_on_sale != '') checked @endif>否
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">排序数字</label>
        <div class="col-md-5">
            <input type="text" maxlength="3" class="form-control" placeholder="默认值100，数值大优先级高" name="sort_num"
                   value="@if(!isset($sort_num)){{ $sort_num }}@else{{ 100 }}@endif"
                   onkeyup="this.value=this.value.replace(/\D/g,'')">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">seo_关键字</label>
        <div class="col-md-5">
            <input type="text" maxlength="250" class="form-control" name="sec_keyword" value="{{ $sec_keyword }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">seo_描述</label>
        <div class="col-md-5">
            <input type="text" maxlength="250" class="form-control" name="sec_description"
                   value="{{ $sec_description }}">
        </div>
    </div>
</div>

<script>
    //是否促销的-----------------
    function toggleCheckbox(obj) {
        if ($(obj).is(':checked')) {
            $('[name=promote_price]').removeAttr('disabled');
            $('[name=promote_start_time]').removeAttr('disabled');
            $('[name=promote_end_time]').removeAttr('disabled');
        } else {
            $('[name=promote_price]').attr('disabled', 'disabled');
            $('[name=promote_start_time]').attr('disabled', 'disabled');
            $('[name=promote_end_time]').attr('disabled', 'disabled');
        }
    }
</script>