@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script>
        $(document).ready(function(){
            //测试返回页面，程序对接删除即可
            $(".userForm input[type='button']").click(function(){
                alert("密码修改成功！");
                location.href="user_set.html";
            });
        });
    </script>
    </head>
    <body>
    <!--header-->
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>修改密码</h1>
    </header>
    <div style="height:1rem;"></div>
    <ul class="userForm">
        <li>
            <label class="formName">旧密码：</label>
            <input type="password" required placeholder="旧密码..."/>
        </li>
        <li>
            <label class="formName">新密码：</label>
            <input type="password" required placeholder="新密码..."/>
        </li>
        <li>
            <label class="formName">确认新密码：</label>
            <input type="password" required placeholder="确认新密码..."/>
        </li>
        <li><input type="button" value="确认修改密码" class="formLastBtn"/></li>
    </ul>
    @include('front.layouts.mainFooter')
@stop
