@extends('front.layouts.base')

@section('title','商品分类')

@section('content')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('Front/css/category/base.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('Front/css/category/cation.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('Front/css/category/mui.min.css') }}">--}}
    <style>
        .content {
            margin-bottom: 10px;
        }
        .content .col-md-6 {
            background-color: white;
            border-bottom: 1px solid #ccc;
            border-right: 1px solid #ccc;
            height: 3.6rem;
        }
        .content .col-md-6 a{
            text-decoration: none;
        }
        .content .col-md-6 p{
            font-size: 15px;
            color: #333333;
            margin-top: 2px;
            margin-bottom: 5px;
        }
        .content .col-md-6 img{
            width: 118px;
            height: 118px;
        }
    </style>
    {{--S=头部--}}
    <header>
        <h1 class="logoIcon" style="font-size:.85rem;">&#35;</h1>
        <a href="{{ route('front.search.index') }}" class="rt_searchIcon">&#37;</a>
    </header>
    {{--E=头部--}}
    <div style="height:1rem;"></div>
    <div class="content">
        @php($count = 0)
        @foreach($cats as $k => $v)
            <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="{{ route('front.category.product_list',['cat_id'=>$v->id]) }}">
                    <p>{{ $v->cat_name }}</p>
                    <div style="text-align: center">
                        <img src="/{{ $v->cat_pic }}" alt="">
                    </div>
                </a>
            </div>
            @php($count++)
        @endforeach
        @if($count%2 != 0)
            <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="#">
                    <p>{{--奇数占位符--}}</p>
                    <div style="text-align: center">
                        {{--奇数占位符--}}
                    </div>
                </a>
            </div>
        @endif
    </div>


    @include('front.layouts.mainFooter')
@stop
<!--floatCart-->
