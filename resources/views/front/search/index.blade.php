@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script src="{{ asset('Front/js/search/index.js') }}"></script>
    <!--header-->
    <header>
        <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
        <h1>搜索</h1>
    </header>
    <div style="height:1rem;"></div>
    {{--S=搜索--}}
    <aside class="searchArea" style="margin-bottom: 10px">
        <form action="{{ route('front.search.commit') }}" method="post" name="form1">
            {!! csrf_field() !!}
            <input type="text" placeholder="寻找调料、食材..." name="keyword"/>
            <input type="button" value="&#63;" class="searchBtn"/>
        </form>
    </aside>
    {{--E=搜索--}}
    <dl class="searchHistory" style="padding-bottom: 10px">
        <dt>历史搜索</dt>
        <dd>
            <ul>
                <li><a href="category.html">白菜</a></li>
                <li><a href="category.html">菠菜</a></li>
                <li><a href="category.html">醋</a></li>
                <li><a href="category.html">东北大米</a></li>
            </ul>
        </dd>
        <dd>
            <a style="line-height: 25px">清空历史记录</a>
        </dd>
    </dl>
@stop
