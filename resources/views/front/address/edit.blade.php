@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script>
        $(document).ready(function(){
            //测试返回页面，程序对接删除即可
            $(".userForm input[type='button']").click(function(){
                alert("地址修改成功！");
                location.href="user_set.html";
            });
        });
    </script>
    <!--header-->
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>我的地址</h1>
    </header>
    <div style="height:1rem;"></div>
    <form action="{{ route('front.address.update') }}" method="post">
        <ul class="userForm" data-toggle="distpicker">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $user_address->id }}">
            <li>
                <input type="text" value="{{ $user_address->name }}" name="name" placeholder="请输入收货人名称" required maxlength="50" autofocus>
            </li>
            <li>
                <input type="text" value="{{ $user_address->mobile }}" name="mobile" placeholder="请输入您的手机号码" maxlength="11" required>
            </li>
            <li>
                <select name="province" data-province="{{ $user_address->province }}"></select>
            </li>
            <li>
                <select name="city" data-city="{{ $user_address->city }}"></select>
            </li>
            <li>
                <select name="county" data-district="{{ $user_address->county }}"></select>
            </li>
            <li>
                <input name="address" value="{{ $user_address->address }}" type="text" placeholder="请输入你的详细地址" required/>
            </li>
            <li>
                <textarea name="other" placeholder="请输入其他要求(可空不填)" id="" cols="30"
                          rows="10" maxlength="250">{{ $user_address->other }}</textarea>
            </li>
        </ul>
        <input type="submit" class="btn btn-success form-control" style="margin-bottom: 20px" value="保存">
    </form>


    <script src="{{ asset('Front/js/address/distpicker.data.js') }}"></script>
    <script src="{{ asset('Front/js/address/distpicker.js') }}"></script>
@stop
