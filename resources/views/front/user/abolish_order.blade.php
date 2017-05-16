@extends('front.layouts.base')

@section('title','首页')

@section('content')
    @include('front.partials.success')
    @include('front.partials.errors')
    <link rel="stylesheet" href="{{ asset('Front/css/user/abolish_order.css') }}">
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>取消订单</h1>
    </header>
    <div style="height:1rem;"></div>
    <ul class="orderList" id="waitPayList">
        <li>
            <dl>
                <dt>
                    <span>订单：{{ $order->order_num }}</span>
                    <span>金额：{{ $order->real_price }}</span>
                </dt>
            </dl>
        </li>
    </ul>
    {{--S=取消订单内容--}}
    <div class="col-md-12 abolish-content">
        <form action="{{ route('front.user.abolish_order',['order_id'=>$order->id]) }}" method="post" name="form1">
            {!! csrf_field() !!}
            <label for="reason" style="font-size: 16px">原因：</label>
            <textarea name="reason" id="" cols="30" rows="5" class="form-control"
                      placeholder="亲！请在此填写您取消订单的原因"></textarea>
            <input type="button" class="btn btn-success form-control order_delBtn" value="取消订单">
        </form>
    </div>
    {{--E=取消订单内容--}}

    <script>
        /**取消订单**/
        $(".order_delBtn").click(function () {
            layer.confirm('取消订单', {
                btn: ['确认取消', '撤销操作']
            }, function (index, layero) {
                $("[name=form1]").submit();
                layer.close(index);
            }, function (index) {
                layer.close(index);
            });
        });
    </script>
    @include('front.layouts.mainFooter')
@stop
