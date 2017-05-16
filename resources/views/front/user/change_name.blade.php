@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>用户昵称</h1>
    </header>
    <div style="height:1rem;"></div>
    <ul class="userForm">
        <li><input type="text" value="" placeholder="设置用户名"/></li>
        <li><input type="button" value="更新保存" class="formLastBtn"/></li>
    </ul>
    @include('front.layouts.mainFooter')
@stop
