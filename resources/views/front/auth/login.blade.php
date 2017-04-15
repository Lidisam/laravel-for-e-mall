@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script>
        $(document).ready(function () {
            $(".formarea li:last input[type='button']").click(function () {
                alert("测试跳转效果，程序对接予以删除!");
                location.href = "index.html";
            });
        });
    </script>
    <section class="formLogo">
        <h2>&#35;</h2>
    </section>
    <form action="{{ route('front.auth.login') }}" method="post">
        {!! csrf_field() !!}
        <ul class="formarea">
            <li>
                <label class="lit">手机：</label>
                <input type="text" placeholder="手机号码" class="textbox" name="mobile"/>
            </li>
            <li>
                <label class="lit">密码：</label>
                <input type="password" placeholder="登陆密码" class="textbox" name="password"/>
            </li>
            <li class="liLink lg_liLink">
                <span><label><input type="checkbox"/>记住密码</label></span>
                <span><a href="{{ route('front.auth.register') }}">新用户注册</a></span>
                <span><a href="find_pwd.html">忘记密码?</a></span>
            </li>
            <li>
                <input type="submit" value="立即登陆"/>
            </li>
        </ul>
    </form>
    @include('front.layouts.mainFooter')
    @include('front.partials.success')
    @include('front.partials.errors')
@stop
