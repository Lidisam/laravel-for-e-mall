@extends('front.layouts.base')

@section('title','首页')

@section('content')

    <script src="/Front/js/jquery.js"></script>
    <script src="/Front/js/swiper.min.js"></script>
    <script>
        $(document).ready(function () {
            var mySwiper = new Swiper('#slide', {
                autoplay: 5000,
                visibilityFullFit: true,
                loop: true,
                pagination: '.pagination',
            });
            //product list:Tab
            $(".tab_proList dd").eq(0).show().siblings(".tab_proList dd").hide();
            $(".tab_proList dt a").eq(0).addClass("currStyle");
            $(".tab_proList dt a").click(function () {
                var liindex = $(".tab_proList dt a").index(this);
                $(this).addClass("currStyle").siblings().removeClass("currStyle");
                $(".tab_proList dd").eq(liindex).fadeIn(150).siblings(".tab_proList dd").hide();
            });
            //飞入动画，具体根据实际情况调整
            $(".addToCart").click(function () {
                $(".hoverCart a").html(parseInt($(".hoverCart a").html()) + 1);
                /*测试+1*/
                var shopOffset = $(".hoverCart").offset();
                var cloneDiv = $(this).parent().siblings(".goodsPic").clone();
                var proOffset = $(this).parent().siblings(".goodsPic").offset();
                cloneDiv.css({"position": "absolute", "top": proOffset.top, "left": proOffset.left});
                $(this).parent().siblings(".goodsPic").parent().append(cloneDiv);
                cloneDiv.animate({
                    width: 0,
                    height: 0,
                    left: shopOffset.left,
                    top: shopOffset.top,
                    opacity: 1
                }, "slow");
            });
        });
    </script>
    <!--header-->
    <header>
        <a href="location.html" class="location">西安市</a>
        <h1 class="logoIcon" style="font-size:.85rem;">&#35;</h1>
        <a href="search.html" class="rt_searchIcon">&#37;</a>
    </header>
    <div style="height:1rem;"></div>
    <!--S=广告slide-->
    <div id="slide">
        <div class="swiper-wrapper">
            @foreach($ads as $k => $v)
                <div class="swiper-slide">
                    <a href="{{ $v->ad_url }}">
                        <img src="/{{ $v->ad_sm_logo }}" alt="{{ $v->ad_name }}"/>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="pagination"></div>
    </div>
    <!--categoryList-->
    <ul class="categoryLiIcon">
        <li>
            <a href="category.html">
                <img src="/Front/upload/menu_bg_01.png"/>
                <em>蔬菜水果</em>
            </a>
        </li>
        <li>
            <a href="category.html">
                <img src="/Front/upload/menu_bg_06.png"/>
                <em>禽蛋肉类</em>
            </a>
        </li>
        <li>
            <a href="category.html">
                <img src="/Front/upload/menu_bg_10.png"/>
                <em>水产火锅</em>
            </a>
        </li>
        <li>
            <a href="category.html">
                <img src="/Front/upload/menu_bg_14.png"/>
                <em>熟食豆制</em>
            </a>
        </li>
        <li>
            <a href="category.html">
                <img src="/Front/upload/menu_bg_03.png"/>
                <em>米面粮油</em>
            </a>
        </li>
        <li>
            <a href="category.html">
                <img src="/Front/upload/menu_bg_07.png"/>
                <em>调料干货</em>
            </a>
        </li>
        <li>
            <a href="category.html">
                <img src="/Front/upload/menu_bg_11.png"/>
                <em>餐厨用品</em>
            </a>
        </li>
        <li>
            <a href="category.html">
                <img src="/Front/upload/menu_bg_15.png"/>
                <em>常购品</em>
            </a>
        </li>
    </ul>
    <!--Tab:productList-->
    <dl class="tab_proList">
        <dt>
            <a>热销</a>
            <a>新品</a>
            <a>热销</a>
        </dt>
        <dd>
            <ul>
                @foreach($thirdGoods['is_hot'] as $k => $v)
                    <li>
                        <a href="{{ route('front.product.index', $v->id) }}" class="goodsPic">
                            <img src="/{{ $v->sm_logo }}"/>
                        </a>
                        <div class="goodsInfor">
                            <h2>
                                <a href="{{ route('front.product.index', $v->id) }}">{{ $v->goods_name }}</a>
                            </h2>
                            <p>
                                <del>{{ $v->market_price }}</del>
                            </p>
                            <p>
                                <strong class="price">{{ $v->shop_price }}</strong>
                            </p>
                            <a class="addToCart">&#126;</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </dd>
        <dd>
            <ul>
                @foreach($thirdGoods['is_new'] as $k => $v)
                    <li>
                        <a href="{{ route('front.product.index', $v->id) }}" class="goodsPic">
                            <img src="/{{ $v->sm_logo }}"/>
                        </a>
                        <div class="goodsInfor">
                            <h2>
                                <a href="{{ route('front.product.index', $v->id) }}">{{ $v->goods_name }}</a>
                            </h2>
                            <p>
                                <del>{{ $v->market_price }}</del>
                            </p>
                            <p>
                                <strong class="price">{{ $v->shop_price }}</strong>
                            </p>
                            <a class="addToCart">&#126;</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </dd>
        <dd>
            <ul>
                @foreach($thirdGoods['is_best'] as $k => $v)
                    <li>
                        <a href="{{ route('front.product.index', $v->id) }}" class="goodsPic">
                            <img src="/{{ $v->sm_logo }}"/>
                        </a>
                        <div class="goodsInfor">
                            <h2>
                                <a href="{{ route('front.product.index', $v->id) }}">{{ $v->goods_name }}</a>
                            </h2>
                            <p>
                                <del>{{ $v->market_price }}</del>
                            </p>
                            <p>
                                <strong class="price">{{ $v->shop_price }}</strong>
                            </p>
                            <a class="addToCart">&#126;</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </dd>
    </dl>
    @include('front.layouts.mainFooter')
@stop
<!--floatCart-->
