@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script src="{{ asset('Front/js/order/index.js') }}"></script>

    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>确认订单</h1>
    </header>
    <div style="height:1rem;"></div>
    <aside class="confirmAddr">
        <p>
            <span>收货人：{{ $addressMessage->name }}</span>
            <span>{{ $addressMessage->mobile }}</span>
        </p>
        <address>
            {{ $addressMessage->province }}&nbsp;{{ $addressMessage->city }}
            {{ $addressMessage->county }}&nbsp;{{ mb_substr($addressMessage->address,0,10) }}......
        </address>
        <a href="{{ route('front.address.index') }}" class="iconfont">&#60;</a>
    </aside>
    <dl class="payment">
        <dt>选择支付方式</dt>
        <dd>
            <label><input type="radio" name="pay"/>支付宝支付</label>
            <label><input type="radio" name="pay"/>微信支付</label>
        </dd>
    </dl>
    <section class="order_msg">
        <h2>我要留言</h2>
        <textarea placeholder="选填(亲可以在这里添加想说的话)"></textarea>
    </section>
    <!--bottom nav-->
    <div style="height:1rem;"></div>
    <aside class="btmNav">
        <a style="background:#64ab5b;color:white;text-shadow:none;">合计：￥0.00</a>
        <a style="background:#6bc75f;color:white;text-shadow:none;">提交订单</a>
    </aside>
@stop
