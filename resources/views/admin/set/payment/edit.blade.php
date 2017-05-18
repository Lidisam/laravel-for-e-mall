@extends('admin.layouts.base')

@section('title','编辑')

@section('pageHeader','编辑')

@section('pageDesc','DashBoard')

@section('content')
    <div class="main animsition">
        <div class="container-fluid">

            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">编辑</h3>
                        </div>
                        <div class="panel-body">

                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{ route('admin.set.payment.store',['pay_id'=>$data['id']]) }}"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @if($data['id'] == 1)
                                    @include('admin.set.payment.partials.edit.alipay')
                                @elseif($data['id'] == 2)
                                    @include('admin.set.payment.partials.edit.wechat')
                                @elseif($data['id'] == 3)
                                    @include('admin.set.payment.partials.edit.cash')
                                @endif
                                <div class="form-group">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <button type="submit" class="form-control btn btn-success">提交编辑</button>
                                    </div>
                                    <div class="col-md-5">
                                        <button type="button" class="form-control btn btn-default"
                                                onclick="javascript:window.history.go(-1)">返回上一页
                                        </button>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop