@extends('front.layouts.base')

@section('title','分类商品')

@section('content')
    <script src="{{ asset('Front/js/swiper.min.js') }}"></script>
    {{--加入购物车--}}
    <script src="{{ asset('Front/js/index.js') }}"></script>
    <script>
        $(function () {
            var conditions = {
                'shop_price': 'asc',
                'sale_volume': 'asc',
                'brand_id': ''
            };
            var page = 0;   //分页
            var is_append = 0;  //默认不是加载更多，1加载更多

            function ajax() {
                $.ajax({
                    url: "{{ route('front.category.product_list', $data->id) }}",// 跳转到 action
                    data: {
                        conditions: conditions,
                        page: page
                    },
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                    },
                    success: function (data) {
                        var html = '';
                        var dataPage = Math.ceil(parseInt(data['total']) / parseInt(data['pageSize']));
                        if (dataPage == (page + 1)) $(".more_btn").hide();  //隐藏加载更多
                        $(data['data']).each(function (i, val) {
                            html += '<li>' +
                                '<a href="/product/' + val.id + '" class="goodsPic">' +
                                '<img src="/' + val.sm_logo + '"/>' +
                                '</a>' +
                                '<div class="goodsInfor">' +
                                '<h2>' +
                                '<a href="/product/' + val.id + '">' + val.goods_name + '</a>' +
                                '</h2>' +
                                '<p><del>' + val.market_price + '</del></p>' +
                                '<p>' +
                                '<strong class="price">' + val.shop_price + '</strong>' +
                                '</p>' +
                                '<a class="addToCart" data-content-id="' + val.id + '" ' +
                                'name="' + val.goods_name + '" about="' + val.shop_price + '" data-num="' + val.market_price +
                                '" data-expand="' + val.sm_logo + '">&#126;' +
                                '</a></div></li>';
                        });
                        is_append == 0 ? $(".show-list").html(html) : $(".show-list").append(html);
                    },
                    error: function () {

                    }
                });
            }

            /**点击加载更多**/
            $(".more_btn").click(function () {
                page += 1;
                ajax();
            });
            /**搜索**/
            $(".des_icon").click(function () {
                if ($(this).attr('id') == 'shop_price') {
                    conditions.shop_price = (conditions.shop_price == 'asc') ? 'desc' : 'asc';
                } else {  //销量
                    conditions.sale_volume = (conditions.sale_volume == 'asc') ? 'desc' : 'asc';
                }
                page = 0;
                ajax();
                $(this).toggleClass("asc_icon");
            });
            $(".drop_icon").click(function () {
                $(".drop_list").toggle();
                $(".drop_list li a").click(function () {
                    conditions.brand_id = $(this).attr('about');
                    page = 0;
                    ajax();
                    $(this).parents(".drop_list").hide();
                    $(this).parents(".drop_list").parent().find('#brand').text($(this).text());
                });
            });
        });
    </script>
    {{--S=头部--}}
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1 class="logoIcon" style="font-size:.85rem;">&#35;</h1>
        <a href="{{ route('front.search.index') }}" class="rt_searchIcon">&#37;</a>
    </header>
    {{--E=头部--}}
    <div style="height:1rem;"></div>
    <ul class="sift_nav">
        <li><a class="des_icon" id="price">价格</a></li>
        <li><a class="des_icon" id="sales">销量优先</a></li>
        <li>
            <a class="nav_li drop_icon" id="brand">品牌筛选</a>
            <ul class="drop_list">
                @foreach($brand as $k => $v)
                    <li><a about="{{ $v->id }}">{{ $v->brand_name }}</a></li>
                @endforeach
            </ul>
        </li>
    </ul>
    {{--S=产品列表--}}
    <section class="productList">
        @if(count($data->goods->toArray()))

            <ul class="show-list">
                @foreach($data->goods as $k => $v)
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
            <a class="more_btn" style="display: none">加载更多</a>
        @else
            <div class="col-md-12 text-center" style="margin-top: 10px">该分类暂无商品</div>
        @endif
    </section>
    {{--E=产品列表--}}
    <div class="hoverCart">
        <a href="{{ route('front.cart.index') }}">0</a>
    </div>

    @include('front.layouts.mainFooter')
    <script>
        /**初始进入时判断是否隐藏加载更多**/
        if (Math.ceil(parseInt("{{ $data->goods->count() }}") / 10) != 1) {
            $(".more_btn").show();
        }
    </script>
@stop
<!--floatCart-->
