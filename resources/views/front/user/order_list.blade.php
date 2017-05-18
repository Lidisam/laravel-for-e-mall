@extends('front.layouts.base')

@section('title','首页')

@section('content')
    @include('front.partials.success')
    @include('front.partials.errors')

    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>订单列表</h1>
    </header>
    <div style="height:1rem;"></div>
    <!--异步处理，此处不做TAB形式,注意当前状态样式currStyle-->
    <aside class="orderSift">
        <a class="currStyle waitPay">待发货</a>
        <a class="waitDeliver">待收货</a>
        <a class="achieved">已完成</a>
    </aside>
    <!--订单列表-->
    {{--S=待发货订单--}}
    <ul class="orderList" id="waitPayList">
        <!--订单循环li-->
        @if(count($wait_pay_orders->toArray()))
            @foreach($wait_pay_orders as $k => $v)
                <li>
                    <dl>
                        <dt>
                            <span>订单：{{ $v->order_num }}</span>
                            <span>{{ $v->pay_status == 0?'待付款':'已付款' }}</span>
                        </dt>
                        <!--订单产品循环dd-->
                        @foreach($v->goods as $k1 => $v1)
                            <dd>
                                <h2><a href="{{ route('front.product.index', $v1->id) }}">{{ $v1->goods_name }}</a></h2>
                                <strong>
                                    <em>{{ $v1->shop_price }}</em>
                                    <span>{{ $v1->pivot->num }}</span>
                                </strong>
                            </dd>
                        @endforeach
                        <dd style="position: relative">
                            {{--<span style="position: absolute;left: 0;margin-left: 0">下单时间：<b>{{ $v->created_at }}</b></span>--}}
                            <span>商品数量：<b>{{ $v->goods->pluck('pivot')->sum('num') }}</b></span>
                            <span>实付：<b>{{ $v->real_price }}</b></span>
                        </dd>
                        <dd>
                            <a class="order_delBtn"
                               href="{{ route('front.user.abolish_order',['order_id'=>$v->id]) }}">取消订单</a>
                            <a class="order_payBtn">付款</a>
                        </dd>
                    </dl>
                </li>
            @endforeach
        @else
            <li class="text-center">
                <dl>
                    <dt>暂无该类订单</dt>
                </dl>
            </li>
        @endif
    </ul>
    {{--E=待发货订单--}}
    {{--S=待收货订单--}}
    <ul class="orderList" id="waitDeliverList" style="display: none">
        <!--订单循环li-->
        @if(count($wait_delivery_orders->toArray()))
            @foreach($wait_delivery_orders as $k => $v)
                <li>
                    <dl>
                        <dt>
                            <span>订单：{{ $v->order_num }}</span>
                            <span>{{ $v->pay_status == 0?'待付款':'已付款' }}</span>
                        </dt>
                        <!--订单产品循环dd-->
                        @foreach($v->goods as $k1 => $v1)
                            <dd>
                                <h2><a href="{{ route('front.product.index', $v1->id) }}">{{ $v1->goods_name }}</a></h2>
                                <strong>
                                    <em>{{ $v1->shop_price }}</em>
                                    <span>{{ $v1->pivot->num }}</span>
                                </strong>
                            </dd>
                        @endforeach
                        <dd>
                            <span>商品数量：<b>{{ $v->goods->pluck('pivot')->sum('num') }}</b></span>
                            <span>实付：<b>{{ $v->real_price }}</b></span>
                        </dd>
                        <dd>
                            <a class="order_payBtn">待收货</a>
                        </dd>
                    </dl>
                </li>
            @endforeach
        @else
            <li class="text-center">
                <dl>
                    <dt>暂无该类订单</dt>
                </dl>
            </li>
        @endif
    </ul>
    {{--E=待发货订单--}}
    {{--S=已完成订单--}}
    <ul class="orderList" id="achievedList" style="display: none">
        <!--订单循环li-->
        @if(count($achieved_orders->toArray()))
            @foreach($achieved_orders as $k => $v)
                <li>
                    <dl>
                        <dt>
                            <span>订单：{{ $v->order_num }}</span>
                            <span>{{ $v->pay_status == 0?'待付款':'已付款' }}</span>
                        </dt>
                        <!--订单产品循环dd-->
                        @foreach($v->goods as $k1 => $v1)
                            <dd>
                                <h2><a href="{{ route('front.product.index', $v1->id) }}">{{ $v1->goods_name }}</a></h2>
                                <strong>
                                    <em>{{ $v1->shop_price }}</em>
                                    <span>{{ $v1->pivot->num }}</span>
                                </strong>
                            </dd>
                        @endforeach
                        <dd>
                            <span>商品数量：<b>{{ $v->goods->pluck('pivot')->sum('num') }}</b></span>
                            <span>实付：<b>{{ $v->real_price }}</b></span>
                        </dd>
                        <dd>
                            <a class="order_delBtn">已完成</a>
                        </dd>
                    </dl>
                </li>
            @endforeach
        @else
            <li class="text-center">
                <dl>
                    <dt>暂无该类订单</dt>
                </dl>
            </li>
        @endif
    </ul>
    {{--E=已完成订单--}}

    <script>
        /**选项卡切换**/
        $(".orderSift").children('a').click(function () {
            var className = $(this).prop('className').trim();
            className = (className.split(/\s+/))[0];
            $(".orderList").hide();
            $("#" + className + "List").show();
            $(this).parent().children('a').removeClass("currStyle");
            $(this).addClass("currStyle");
        });
    </script>
    @include('front.layouts.mainFooter')
@stop
