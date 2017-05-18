<div class="form-group">
    <div class="col-md-3 text-right">
        支付方式名称：
    </div>
    <div class="col-md-7">
        {{ $data['pay_name'] }}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3 text-right">
        支付方式描述：
    </div>
    <div class="col-md-7">
        <textarea name="pay_desc" id="" cols="30" rows="4" class="form-control">{{ $data['pay_desc'] }}</textarea>
    </div>
</div>
<div class="form-group">
    <div class="col-md-3 text-right">
        微信支付账号：
    </div>
    <div class="col-md-7">
        <input name="cgf[cfg_name]" class="form-control" maxlength="100"
               value="{{ isset($data['pay_config']['cfg_name'])?$data['pay_config']['cfg_name']:'' }}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-3 text-right">
        交易安全校验码：
    </div>
    <div class="col-md-7">
        <input name="cgf[cfg_code]" class="form-control" maxlength="100"
               value="{{ isset($data['pay_config']['cfg_code'])?$data['pay_config']['cfg_code']:'' }}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-3 text-right">
        合作者身份ID：
    </div>
    <div class="col-md-7">
        <input name="cgf[cfg_id]" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'')"
               value="{{ isset($data['pay_config']['cfg_id'])?$data['pay_config']['cfg_id']:'' }}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-3 text-right">
        选择接口类型：
    </div>
    <div class="col-md-7">
        <select name="cgf[cfg_type]">
            <option value="0"
                    {{ (isset($data['pay_config']['cfg_type']) && $data['pay_config']['cfg_type'] == 0)?'checked':'' }}>
                使用标准双接口
            </option>
            <option value="1"
                    {{ (isset($data['pay_config']['cfg_type']) && $data['pay_config']['cfg_type'] == 1)?'checked':'' }}>
                使用担保交易接口
            </option>
            <option value="2"
                    {{ (isset($data['pay_config']['cfg_type']) && $data['pay_config']['cfg_type'] == 2)?'checked':'' }}>
                使用即时到帐交易接口
            </option>
        </select>
    </div>
</div>
<div class="form-group">
    <div class="col-md-3 text-right">
        支付手续费：
    </div>
    <div class="col-md-7">
        {{ $data['pay_fee'] }}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3 text-right">
        货到付款？：
    </div>
    <div class="col-md-7">
        {{ $data['is_cod']?'是':'否' }}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3 text-right">
        在线支付？：
    </div>
    <div class="col-md-7">
        {{ $data['is_online']?'是':'否' }}
    </div>
</div>