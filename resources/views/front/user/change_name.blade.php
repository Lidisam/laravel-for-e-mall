@extends('front.layouts.base')

@section('title','用户名修改')

@section('content')
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>用户昵称</h1>
    </header>
    <div style="height:1rem;"></div>
    <form action="{{ route('front.user.change_name') }}" method="post">
        {!! csrf_field() !!}
        <ul class="userForm">
            <li><input type="text" name="name" placeholder="设置用户名"
                       value="{{ Auth::guard('client')->user()->name }}"/></li>
            <li><input type="submit" value="更新保存" class="formLastBtn"/></li>
        </ul>
    </form>

    @include('front.layouts.mainFooter')
    @include('front.partials.success')
    @include('front.partials.errors')
@stop

