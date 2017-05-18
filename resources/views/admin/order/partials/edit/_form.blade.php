{{--laydate时间插件--}}
<link rel="stylesheet" href="{{ asset('dist/css/order-edit.css') }}">
<script src="{{ asset('dist/js/tool/time.js') }}"></script>
<script src="{{ asset('packages/layer/layer.js') }}"></script>
<script>
    var order_status = null;
    var pay_status = null;
    var deliver_status = null;

    /**
     * @param mode 订单操作方式
     */
    function commitOperation(mode) {
        if (order_status != null || pay_status != null || deliver_status != null) {
            if (mode == 'order_status') {  //确认
                order_status = parseInt(order_status) ? 0 : 1;
                pay_status = parseInt(pay_status);
                deliver_status = parseInt(deliver_status);
            } else if (mode == 'pay_status') {  //付款
                order_status = parseInt(order_status);
                pay_status = parseInt(pay_status) ? 0 : 1;
                deliver_status = parseInt(deliver_status);
            } else if (mode == 'deliver_status') {  //发货
                order_status = parseInt(order_status);
                pay_status = parseInt(pay_status);
                deliver_status = parseInt(deliver_status) ? 0 : 1;
            }
        } else {
            if (mode == 'order_status') {  //确认
                order_status = parseInt("{{ $order_status}}") ? 0 : 1;
                pay_status = parseInt("{{ $pay_status }}");
                deliver_status = parseInt("{{ $deliver_status }}");
            } else if (mode == 'pay_status') {  //付款
                order_status = parseInt("{{ $order_status }}");
                pay_status = parseInt("{{ $pay_status }}") ? 0 : 1;
                deliver_status = parseInt("{{ $deliver_status }}");
            } else if (mode == 'deliver_status') {  //发货
                order_status = parseInt("{{ $order_status }}");
                pay_status = parseInt("{{ $pay_status }}");
                deliver_status = parseInt("{{ $deliver_status }}") ? 0 : 1;
            }
        }

        $.ajax({
            type: "POST",
            url: "{{ route('admin.order.operate.update') }}",
            data: {
                reason: $("[name=operate_reason]").val() + $("#" + mode + "").attr('about'),
                order_status: order_status,
                pay_status: pay_status,
                deliver_status: deliver_status,
                order_id: "{{ $id }}",
                mode: mode
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success: function (data) {
                if (data) {
                    var text = $("#" + mode + "").text();   //TODO：暂时切换着。。。。，正则匹配下有没未，如果有则去掉无则加上
                    if (parseInt(text.indexOf('未')) < 0) {
                        if (mode == 'order_status') {
                            $("#" + mode + "").text('未确认');
                        } else if (mode == 'pay_status') {
                            $("#" + mode + "").text('未付款');
                        } else if (mode == 'deliver_status') {
                            $("#" + mode + "").text('未发货');
                        }
                    } else {
                        if (mode == 'order_status') {
                            $("#" + mode + "").text('已确认');
                        } else if (mode == 'pay_status') {
                            $("#" + mode + "").text('已付款');
                        } else if (mode == 'deliver_status') {
                            $("#" + mode + "").text('已发货');
                        }
                    }
                    $("#operation-detail").append('' +
                        '<div class="content-detail"> ' +
                        '<div class="col-md-2">' + ("{{ \Illuminate\Support\Facades\Auth::user()->name }}") + '</div>' +
                        '<div class="col-md-2">' + (getNowFormatDate()) + '</div>' +
                        '<div class="col-md-2">' + (order_status ? "已确认" : "未确认") + '</div>' +
                        '<div class="col-md-2">' + (pay_status ? "已付款" : "未付款") + '</div>' +
                        '<div class="col-md-2">' + (deliver_status ? "已发货" : "未发货") + '</div>' +
                        '<div class="col-md-2">'
                        + $("[name=operate_reason]").val() + $("#" + mode + "").attr('about') + '&nbsp;</div>' +
                        '</div>')

                } else {
                    layer.msg('提交失败，请重新提交');
                }
            },
            error: function () {
                layer.msg('提交失败，请重新提交');
            }
        });
    }
</script>

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
            <div class="col-md-8">{{ $order_status?'已':'未' }}确认,{{ $pay_status?'已':'未' }}
                付款,{{ $deliver_status?'已':'未' }}发货
            </div>
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
    <div class="text-center content-title">费用信息</div>
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
<div class="col-md-12 every-content goods-content operation-msg">
    <div class="text-center content-title">操作信息</div>
    <div class="content-detail">
        <div class="col-md-3 text-right">
            操作备注：
        </div>
        <div class="col-md-9 detail-second-col">
            <textarea name="operate_reason" cols="5" rows="2" class="form-control"
                      style="width: 600px;margin-bottom: 10px"
                      placeholder="请输入当前操作备注"></textarea>
        </div>
    </div>
    <div class="content-detail text-right">
        <div class="col-md-3">
            当前可执行操作：
        </div>
        <div class="col-md-9 detail-second-col detail-button">
            <button type="button" class="btn btn-sm btn-primary" id="order_status"
                    onclick="commitOperation('order_status')" about="[确认]">{{ $order_status?'已':'未' }}确认
            </button>
            <button type="button" class="btn btn-sm btn-primary" id="pay_status"
                    onclick="commitOperation('pay_status')" about="[付款]">{{ $pay_status?'已':'未' }}付款
            </button>
            <button type="button" class="btn btn-sm btn-primary" id="deliver_status"
                    onclick="commitOperation('deliver_status')" about="[发货]">{{ $deliver_status?'已':'未' }}发货
            </button>
            <button type="button" class="btn btn-sm btn-default"
                    onclick="javascript:window.location.href='/admin/order'">返回订单页
            </button>
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
    <div id="operation-detail">
        @if(count($info->orders_operations->toArray()))
            @foreach($info->orders_operations as $k => $v)
                <div class="content-detail">
                    <div class="col-md-2">{{ isset($v->admin->name)?$v->admin->name:'该管理员不存在' }}</div>
                    <div class="col-md-2">{{ $v->created_at }}</div>
                    <div class="col-md-2">{{ $v->order_status?'已确认':'未确认' }}</div>
                    <div class="col-md-2">{{ $v->pay_status?'已付款':'未付款' }}</div>
                    <div class="col-md-2">{{ $v->deliver_status?($v->deliver_status == 1?'已发货':'已收货'):'待发货' }}</div>
                    <div class="col-md-2">{!! $v->reason !!}&nbsp;</div>
                </div>
            @endforeach
        @endif
    </div>
</div>

{{--E=信息--}}


