@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script src="/Front/js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            $(".formarea li:last input[type='button']").click(function () {
                alert("测试跳转效果，程序对接予以删除!");
                location.href = "login.html";
            });
        });
    </script>
    <!--header-->
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>注册</h1>
    </header>
    <div style="height:1rem;"></div>
    <mark class="formMark">若有疑问，请邮件到364362035@qq.com</mark>
    <form action="{{ route('front.auth.register') }}" method="post">
        {!! csrf_field() !!}
        <ul class="formarea">
            <li>
                <label class="lit">手机：</label>
                <input type="tel" placeholder="手机号码" class="textbox" name="mobile" value="{{ old('mobile') }}"
                       autofocus/>
            </li>
            @if ($errors->has('mobile'))
                <div class="help-block">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </div>
            @endif
            <li>
                <label class="lit">密码 ：</label>
                <input type="password" name="password" placeholder="设置密码" class="textbox"
                       value="{{ old('password') }}"/>
            </li>
            @if ($errors->has('password'))
                <div class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
            <li>
                <label class="lit">确认密码 ：</label>
                <input type="password" name="password_confirmation" placeholder="设置密码" class="textbox"
                       value="{{ old('password_confirmation') }}"/>
            </li>
            <li class="liLink">
                <a href="article.html" class="fl">《用户协议》</a>
                <a href="{{ route('front.auth.login') }}" class="fr">已有账号，登陆</a>
            </li>
            <li>
                <input type="submit" value="立即注册"/>
            </li>
        </ul>
    </form>

    @include('front.layouts.mainFooter')
    @include('front.partials.success')
    @include('front.partials.errors')
@stop
