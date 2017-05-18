{{--laydate时间插件--}}
<link rel="stylesheet" href="{{ asset('dist/css/order-edit.css') }}">
<script src="/packages/layer/module/laydate/laydate.js"></script>

{{--S=信息--}}
<div class="col-md-12 every-content">
    <div class="text-center content-title">基本信息
    </div>
    <div class="content-detail">
        <div class="col-md-6">
            <div class="col-md-4">订单号：</div>
            <div class="col-md-8">{{ $order_num }}</div>
        </div>
        <div class="col-md-6 detail-second-col">
            <div class="col-md-4">订单状态：</div>
            <div class="col-md-8">{{ $order_status?'已':'未' }}确认,未付款(数据表待重写),{{ $deliver_status?'已':'未' }}发货</div>
        </div>
    </div>
    <div class="content-detail">
        <div class="col-md-6">
            <div class="col-md-4">购货人：</div>
            <div class="col-md-8">{{ $consigner }}</div>
        </div>
        <div class="col-md-6 detail-second-col">
            <div class="col-md-4">下单时间：</div>
            <div class="col-md-8">{{ $created_at }}</div>
        </div>
    </div>
    <div class="content-detail">
        <div class="col-md-6">
            <div class="col-md-4">支付方式：</div>
            <div class="col-md-8">
                @foreach($payments as $k => $v)
                    @if($v->id == $pay_way_id)
                        {{ $v->pay_name }}
                        @break(1)
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-6 detail-second-col">
            <div class="col-md-4">发货状态：</div>
            <div class="col-md-8">{{ $deliver_status?($deliver_status==1?'已发货':'已收货'):'未发货' }}</div>
        </div>
    </div>
</div>
<div class="col-md-12 every-content">
    <div class="text-center content-title">收货人信息</div>
    <div class="content-detail">
        <div class="col-md-6">
            <div class="col-md-4">收货人：</div>
            <div class="col-md-8">{{ $info->address->name }}</div>
        </div>
        <div class="col-md-6 detail-second-col">
            <div class="col-md-4">电话：</div>
            <div class="col-md-8">{{ $info->address->mobile }}</div>
        </div>
    </div>
    <div class="content-detail">
        <div class="col-md-6">
            <div class="col-md-4">收货地址：</div>
            <div class="col-md-8">{{ $info->address->province }}
                {{ $info->address->city }} {{ $info->address->county }}</div>
        </div>
        <div class="col-md-6 detail-second-col">
            <div class="col-md-4">详细地址：</div>
            <div class="col-md-8">{{ $info->address->address }}</div>
        </div>
    </div>
    <div class="content-detail">
        <div class="col-md-6">
            <div class="col-md-4">买家留言：</div>
            <div class="col-md-8">
                {{ $info->address->other }}
            </div>
        </div>
        <div class="col-md-6 detail-second-col">
            <div class="col-md-4"></div>
            <div class="col-md-8">&nbsp;</div>
        </div>
    </div>
</div>
{{--TODO：为数据表添加库存（已添加），然后修改购买时减少库存，创建商品时需加上该选项,又想到了要先修改购物车模块
TODO：，然后订单计算时购物车取出每个商品数目，并且最总价格乘上促销价--}}
<div class="col-md-12 every-content goods-content">
    <div class="text-center content-title">商品信息
        <button class="btn btn-sm btn-success">编辑</button>
    </div>
    <div class="content-detail goods-title">
        <div class="col-md-2">商品名称[品牌]</div>
        <div class="col-md-2">价格</div>
        <div class="col-md-2">数量</div>
        <div class="col-md-2">库存</div>
        <div class="col-md-2">促销[促销价]</div>
        <div class="col-md-2">小计</div>
    </div>
    @php($sum = 0)
    @foreach($info->goods as $k => $v)
        <div class="content-detail">
            <div class="col-md-2"><a href="{{ route('front.product.index', $v->id) }}">{{ $v->goods_name }}</a>
                [<a href="/admin/brand/{{ $v->brand->id }}/edit">{{ $v->brand->brand_name }}</a>]
            </div>
            <div class="col-md-2">{{ $v->shop_price }}</div>
            <div class="col-md-2">{{ $v->pivot->num }}</div>
            <div class="col-md-2">{{ $v->goods_quantity }}</div>
            <div class="col-md-2">{{ $v->is_promote?("是[$v->promote_price]"):'否[无]' }}</div>
            <div class="col-md-2">￥{{ sprintf("%.2f", $v->shop_price*$v->pivot->num) }}元</div>
        </div>
        @php($sum += $v->shop_price*$v->pivot->num)
    @endforeach
    <div class="col-md-12 text-right content-total">
        合计：{{ sprintf("%.2f", $sum) }}
    </div>
</div>
{{--TODO:弄完这个促销需要在写入时改变添加促销is_promote,promote_price--}}
<div class="col-md-12 every-content goods-content">
    <div class="text-center content-title">费用信息
        <button class="btn btn-sm btn-success">编辑</button>
    </div>
    <div class="content-detail">
        <div class="col-md-12 text-right">
            商品总金额：(
            @foreach($info->goods as $k => $v)
                @if($k == 0)
                    ￥{{ $v->pivot->total_price }}{{ $v->pivot->is_promote?'(促销价)':'' }}元
                @else
                    + ￥{{ $v->pivot->total_price }}{{ $v->pivot->is_promote?'(促销价)':'' }}元
                @endif
            @endforeach
            <span>)</span> * 折扣率：{{ sprintf("%.2f", $info->user->hasLevel->rate) }}%
            = 订单总金额：￥{{ sprintf("%.2f", $real_price) }}元
        </div>
    </div>
    <div class="col-md-12 text-right content-total">
        合计：￥{{ sprintf("%.2f", $real_price) }}元
    </div>
</div>
{{--TODO:需要添加操作记录表，并重构确认，付款，发货三个状态--}}
<div class="col-md-12 every-content goods-content operation-msg">
    <div class="text-center content-title">操作信息</div>
    <div class="content-detail">
        <div class="col-md-3 text-right">
            操作备注：
        </div>
        <div class="col-md-9 detail-second-col">
            <textarea name="" cols="5" rows="2" class="form-control" style="width: 600px;margin-bottom: 10px"
                      placeholder="请输入当前操作备注"></textarea>
        </div>
    </div>
    <div class="content-detail text-right">
        <div class="col-md-3">
            当前可执行操作：
        </div>
        <div class="col-md-9 detail-second-col detail-button">
            <button class="btn btn-sm btn-primary">确认</button>
            <button class="btn btn-sm btn-primary">付款</button>
            <button class="btn btn-sm btn-primary">取消</button>
            <button class="btn btn-sm btn-primary">无效</button>
            <button class="btn btn-sm btn-primary">售后</button>
        </div>
    </div>
</div>
<div class="col-md-12 every-content goods-content operation-detail">
    <div class="content-detail operation-title">
        <div class="col-md-2">操作者：</div>
        <div class="col-md-2">操作时间：</div>
        <div class="col-md-2">订单状态：</div>
        <div class="col-md-2">付款状态：</div>
        <div class="col-md-2">发货状态：</div>
        <div class="col-md-2">备注：</div>
    </div>
    @if(isset($order_operations) && count($order_operations->toArray()))
        <div class="content-detail">
            <div class="col-md-2">商品名称[品牌]</div>
            <div class="col-md-2">价格</div>
            <div class="col-md-2">数量</div>
            <div class="col-md-2">库存</div>
            <div class="col-md-2">促销[促销价]</div>
            <div class="col-md-2">小计</div>
        </div>
    @else
        <div class="content-detail text-center">
            暂无操作记录
        </div>
    @endif
</div>

{{--E=信息--}}


