@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script src="{{ asset('Front/js/swiper.min.js') }}"></script>
    {{--加入购物车--}}
    <script src="{{ asset('Front/js/index.js') }}"></script>
    <!--header-->
    <header>
        {{--<a href="location.html" class="location">西安市</a>--}}
        <h1 class="logoIcon" style="font-size:.85rem;">&#35;</h1>
        <a href="{{ route('front.search.index') }}" class="rt_searchIcon">&#37;</a>
    </header>
    <div style="height:1rem;"></div>
    <!--S=广告slide-->

    <div id="slide">
        <div class="swiper-wrapper">
            @foreach($ads as $k => $v)
                <div class="swiper-slide" style="width: 100%">
                    <a href="{{ $v->ad_url }}">
                        <img src="/{{ $v->ad_sm_logo }}" alt="{{ $v->ad_name }}"/>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="pagination"></div>
    </div>
    {{--S=最前的几个分类--}}
    <ul class="categoryLiIcon">
        @foreach($cats as $k => $v)
            <li>
                <a href="{{ route('front.category.product_list',['cat_id'=>$v->id]) }}">
                    <img src="/{{ $v->cat_logo }}"/>
                    <em>{{ $v->cat_name }}</em>
                </a>
            </li>
        @endforeach
        <li>
            <a href="{{ route('front.category.index') }}">
                <img src="{{ asset('Front/images/index/menu_bg_15.png') }}"/>
                <em>更多分类</em>
            </a>
        </li>
    </ul>
    {{--E=最前的几个分类--}}
    <!--Tab:productList-->
    <dl class="tab_proList">
        <dt>
            <a>热销</a>
            <a onclick="javascript:$('#new').show()">新品</a>
            <a onclick="javascript:$('#best').show()">热销</a>
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
            <ul style="display: none;" id="new">
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
            <ul style="display: none" id="best">
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
