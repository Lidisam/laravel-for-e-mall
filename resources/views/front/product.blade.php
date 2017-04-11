@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <link rel="apple-touch-icon-precomposed" sizes="57x57"
          href="/Front/images/icon/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
          href="/Front/images/icon/apple-touch-icon-120x120-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="196x196"
          href="/Front/images/icon/apple-touch-icon-196x196-precomposed.png">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/Front/css/style.css"/>
    <script src="/Front/js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            //效果测试，程序对接可将其删除
            $(".btmNav a:first").click(function () {
                $(".topCart em").html(parseInt($(".topCart em").html()) + 1);
            });
        });
    </script>
    <!--header-->
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>产品详情</h1>
        <a href="{{ route("front.cart.index", $product->id) }}" class="topCart"><em>0</em></a>
    </header>
    <div style="height:1rem;"></div>
    <div class="pro_bigImg">
        <img src="/{{ $product->logo }}"/>
    </div>
    <!--base information-->
    <section class="pro_baseInfor">
        <h2>{{ $product->goods_name }}</h2>
        <p>
            <strong>{{ $product->shop_price }}</strong>
            <del>{{ $product->market_price }}</del>
        </p>
    </section>
    <!--product attr-->
    <dl class="pro_attr">
        <dt>产品属性信息</dt>
        <dd>
            <ul>
                <li>
                    <span>上市时间</span>
                    <em>{{ date('Y年m月', $product->addtime) }}</em>
                </li>
                <li>
                    <span>产品规格</span>
                    <em>1斤装</em>
                </li>
                <li>
                    <span>产品重量</span>
                    <em>0.5kg</em>
                </li>
                <li>
                    <span>包装方式</span>
                    <em>散装</em>
                </li>
                <li>
                    <span>保质期</span>
                    <em>6个月</em>
                </li>
                <li>
                    <span>所属品牌</span>
                    <em>三星</em>
                </li>
            </ul>
        </dd>
    </dl>
    <!--bottom nav-->
    <div style="height:1rem;"></div>
    <aside class="btmNav">
        <a style="background:#64ab5b;color:white;text-shadow:none;">加入购物车</a>
        <a style="background:#87a983;color:white;text-shadow:none;">加入常购单</a>
    </aside>
@stop
