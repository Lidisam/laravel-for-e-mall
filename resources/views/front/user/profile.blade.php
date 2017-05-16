@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>个人资料</h1>
    </header>
    <div style="height:1rem;"></div>
    <ul class="inforList">
        <li>
            <a href="{{ route('front.user.change_name') }}" class="isNext">
                <span>用户昵称</span>
                <span>未设置</span>
            </a>
        </li>
        <li>
            <a href="change_tel.html" class="isNext">
                <span>手机号码</span>
                <span>18309275673</span>
            </a>
        </li>
    </ul>
    @include('front.layouts.mainFooter')
@stop
