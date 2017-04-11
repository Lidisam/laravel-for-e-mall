{{--laydate时间插件--}}
<script src="/packages/layer/module/laydate/laydate.js"></script>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">广告名称</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="ad_name" id="tag" value="{{ $ad_name }}" required autofocus>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">广告权重</label>
    <div class="col-md-5">
        <input type="text" class="form-control" style="width: 80px" name="ad_weight" id="tag" value="1"
               onkeyup="this.value=this.value.replace(/\D/g,'')" required>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">开始日期</label>
    <div class="col-md-5">
        <input type="text" class="form-control laydate-icon-molv skindemo" name="ad_start_time"
               onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" required style="height: 34px" readonly
               value="{{ $ad_start_time }}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">结束日期</label>
    <div class="col-md-5">
        <input type="text" class="form-control laydate-icon-molv skindemo" name="ad_end_time"
               onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" style="height: 34px" required readonly
               value="{{ $ad_end_time }}">
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">广告链接</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="ad_url" id="tag" value="{{ $ad_url }}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">上传图片(像素:352*150)</label>
    <div class="col-md-5">
        <input type="file" class="form-control" name="ad_logo">
    </div>
    @if($ad_logo != "")
        <div class="col-md-8 text-center">
            <img src="/{{ $ad_logo }}" alt="" width="200" height="150">
        </div>
    @endif
</div>
<div class="form-group">
    <label class="col-md-3 control-label">是否开启</label>
    <div class="col-md-9">
        <label class="radio-inline">
            <input type="radio" value="1" name="is_open" checked>是
        </label>
        <label class="radio-inline">
            <input type="radio" value="0" name="is_open" @if(isset($is_open) && $is_open == 0) checked @endif>否
        </label>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">广告联系人</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="linkman" id="tag" value="{{ $linkman }}">
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">联系人Email</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="lm_email" id="tag" value="{{ $lm_email }}"
               pattern="^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$">
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">联系人电话</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="lm_num" id="tag" value="{{ $lm_num }}"
               pattern="^(\(\d{3,4}-)|\d{3.4}-)?\d{7,8}$">
    </div>
</div>

