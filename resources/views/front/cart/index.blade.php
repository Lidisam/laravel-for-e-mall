@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script src="{{ asset('Front/js/cart/cart.js') }}"></script>

    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>购物车</h1>
    </header>
    <div style="height:1rem;"></div>
    <dl class="cart">
        <dt>
            <label><input type="checkbox" id="checkAll"/>全选</label>
            <a class="edit">编辑</a>
        </dt>
        @foreach($cartDatas as $key => $cartData)
            <dd>
                <input type="checkbox" title="点击勾选" class="singleCheck"/>
                <a href="{{ route('front.product.index',['product_id' => $cartData->id]) }}" class="goodsPic">
                    <img src="/{{ $cartData->options->img }}"/></a>
                <div class="goodsInfor">
                    <h2>
                        <a href="{{ route('front.product.index',['product_id' => $cartData->id]) }}">{{ $cartData->name }}</a>
                        <span class="singleCount">{{ $cartData->qty }}</span>
                    </h2>
                    <div class="priceArea">
                        <strong>{{ $cartData->price*$cartData->qty }}</strong>
                        <del>{{ $cartData->options->mark_price*$cartData->qty }}</del>
                    </div>
                    <div class="numberWidget">
                        <input type="button" value="-" class="minus"/>
                        <input type="text" value="{{ $cartData->qty }}" about="{{ $cartData->price }}"
                               data-expand="{{ $cartData->options->mark_price }}" data-icon="{{ $key }}" disabled
                               class="number"/>
                        <input type="button" value="+" class="plus"/>
                    </div>
                </div>
                <a class="delBtn">删除</a>
            </dd>
        @endforeach
    </dl>
    <div style="height:1rem;"></div>
    <aside class="btmNav">
        <a>合计：￥<span id="totalPrice">{{ $totalPrice }}</span></a>
        <a href="{{ route('front.order.index') }}"
           style="background:#64ab5b;color:white;text-shadow:none;">立即下单</a>
    </aside>
@stop
