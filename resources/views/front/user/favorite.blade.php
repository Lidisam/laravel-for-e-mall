@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script>
        $(document).ready(function () {
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
    </head>
    <body style="background:white;">
    <!--header-->
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>常购清单</h1>
    </header>
    <div style="height:1rem;"></div>
    <section class="productList">
        <ul>
            <li>
                <a href="product.html" class="goodsPic">
                    <img src="upload/goods001.jpg"/>
                </a>
                <div class="goodsInfor">
                    <h2>
                        <a href="product.html">新鲜生菜两斤装特惠</a>
                    </h2>
                    <p>
                        <del>5.90</del>
                    </p>
                    <p>
                        <strong class="price">3.90</strong>
                    </p>
                    <a class="addToCart">&#126;</a>
                </div>
            </li>
        </ul>
        <a class="more_btn">加载更多</a>
    </section>
    <!--floatCart-->
    <div class="hoverCart">
        <a href="cart.html">0</a>
    </div>
    @include('front.layouts.mainFooter')
@stop
