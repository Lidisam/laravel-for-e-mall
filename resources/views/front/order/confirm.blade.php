@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>订单状态</h1>
    </header>
    <div style="height:1rem;"></div>
    <section class="return_state">
        <!--订单状态图标：0为成功；1为失败-->
        <h2 class="state_0">订单提交成功！</h2>
        <p>订单编号：{{ $order_num }}</p>
        <p>订单金额：<strong>{{ $real_price }}({{ $level_name }}--{{ $discount }}折)</strong></p>
        <p>创建时间：<time>{{ $created_at }}</time></p>
        <p>
            <a href="{{ route('front.user.order_list') }}">查看订单</a>
            <a href="{{ route('front.index.index') }}">返回首页</a>
        </p>
    </section>
@stop
