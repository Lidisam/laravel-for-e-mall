@extends('front.layouts.base')

@section('title','首页')

@section('content')
    {{--加入购物车--}}
    <script src="{{ asset('Front/js/index.js') }}"></script>
    <script src="{{ asset('Front/js/search/list.js') }}"></script>
    </head>
    <body style="background:white;">
    <!--header-->
    <header>
        <a href="javascript:self.location=document.referrer;" class="iconfont backIcon">&#60;</a>
        <h1>某类产品列表</h1>
        <a href="{{ route('front.search.index') }}" class="rt_searchIcon">&#63;</a>
    </header>
    <div style="height:1rem;"></div>
    <!--asc->1[升序asc_icon];des->0[降序des_icon]-->
    <ul class="sift_nav">
        <li><a class="des_icon" style="cursor: pointer;">价格</a></li>
        <li><a class="des_icon">销量优先</a></li>
        <li>
            <a class="nav_li drop_icon">品牌筛选</a>
            <ul class="drop_list">
                <li><a>品牌名</a></li>
                <li><a>品牌名</a></li>
                <li><a>品牌名</a></li>
                <li><a>品牌名</a></li>
            </ul>
        </li>
    </ul>
    {{--S=产品信息--}}
    <section class="productList">
        @if(count($data->toArray()))
            <ul>
                @foreach($data as $k => $v)
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
            <a class="more_btn">加载更多</a>
        @else
            <div class="text-center" style="color: #BBB5B5;margin-top: 20px">未搜到任何相关商品信息</div>
        @endif
    </section>
    {{--E=产品信息--}}
    <div class="hoverCart">
        <a href="{{ route('front.cart.index') }}">0</a>
    </div>
    @include('front.layouts.mainFooter')
@stop

