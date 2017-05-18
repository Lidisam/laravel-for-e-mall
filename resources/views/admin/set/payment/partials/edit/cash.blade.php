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
        支付手续费：
    </div>
    <div class="col-md-7">
        配送决定
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