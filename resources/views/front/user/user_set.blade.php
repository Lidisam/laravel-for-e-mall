@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>设置</h1>
    </header>
    <div style="height:1rem;"></div>
    <ul class="inforList">
        <li><a href="{{ route('front.user.change_pwd') }}" class="isNext">修改密码</a></li>
        <li><a href="{{ route('front.address.index') }}" class="isNext">我的地址</a></li>
        <li><a href="{{ route('front.user.article') }}" class="isNext">关于我们</a></li>
        <li><a href="" class="lastBtn">安全退出</a></li>
    </ul>
    @include('front.layouts.mainFooter')
@stop
