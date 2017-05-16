@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>个人中心</h1>
        <a href="{{ route('front.user.user_set') }}" class="iconfont setIcon">&#42;</a>
    </header>
    <div style="height:1rem;"></div>
    <div class="userInfor">
        <a class="userIcon">
            <img src="#" onerror="javascript:this.
                    src='{{ asset('/Front/images/DefaultAvatar.jpg') }}';"/>
        </a>
        <h2>{{ $user->name }}</h2>
    </div>
    <ul class="userList">
        <li><a href="{{ route('front.user.order_list') }}" class="orderListIcon">我的订单</a></li>
        <li><a href="{{ route('front.user.favorite') }}" class="collectionIcon">常购清单</a></li>
        <li><a href="{{ route('front.user.profile') }}" class="profileIcon">个人资料</a></li>
    </ul>
    @include('front.layouts.mainFooter')
@stop
