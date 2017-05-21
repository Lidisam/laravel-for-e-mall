@extends('front.layouts.base')

@section('title','密码修改')

@section('content')

    <script>
        $(document).ready(function () {
            //测试返回页面，程序对接删除即可
            $(".userForm input[type='button']").click(function () {
                $("[name=form1]").submit();

            });
        });
    </script>
    <!--header-->
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>修改密码</h1>
    </header>
    <div style="height:1rem;"></div>
    <form action="{{ route('front.auth.reset_pwd') }}" method="post" name="form1">
        {!! csrf_field() !!}
        <ul class="userForm">
            <li class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                <label class="formName">旧密码：</label>
                <input type="password" required maxlength="100" placeholder="旧密码..." name="old_password"/>
                @if ($errors->has('old_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('old_password') }}</strong>
                    </span>
                @endif
            </li>
            <li class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                <label class="formName">新密码：</label>
                <input type="password" required maxlength="100" placeholder="新密码..." name="new_password"/>
                @if ($errors->has('new_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('new_password') }}</strong>
                    </span>
                @endif
            </li>
            <li class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                <label class="formName">确认新密码：</label>
                <input type="password" required maxlength="100" placeholder="确认新密码..."
                       name="new_password_confirmation"/>
                @if ($errors->has('new_password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                    </span>
                @endif
            </li>
            <li><input type="button" value="确认修改密码" class="formLastBtn"/></li>
        </ul>
    </form>

    @include('front.partials.success')
    @include('front.layouts.mainFooter')
@stop
