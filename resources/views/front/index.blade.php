@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script src="{{ asset('Front/js/swiper.min.js') }}"></script>
    <script src="{{ asset('Front/js/index.js') }}"></script>
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
                            <a class="addToCart" data-content-id="{{ $v->id }}" name="{{ $v->goods_name }}"
                               about="{{ $v->shop_price }}" data-num="{{ $v->market_price }}"
                               data-expand="{{ $v->sm_logo }}">&#126;</a>
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
                            <a class="addToCart" data-content-id="{{ $v->id }}" name="{{ $v->goods_name }}"
                               about="{{ $v->shop_price }}" data-num="{{ $v->market_price }}"
                               data-expand="{{ $v->sm_logo }}">&#126;</a>
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
                            <a class="addToCart" data-content-id="{{ $v->id }}" name="{{ $v->goods_name }}"
                               about="{{ $v->shop_price }}" data-num="{{ $v->market_price }}"
                               data-expand="{{ $v->sm_logo }}">&#126;</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </dd>
    </dl>
    <!--floatCart-->
    <div class="hoverCart">
        <a href="{{ route('front.cart.index') }}">0</a>
    </div>
    @include('front.layouts.mainFooter')
@stop
<!--floatCart-->
