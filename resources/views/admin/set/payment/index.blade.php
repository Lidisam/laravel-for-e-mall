@extends('admin.layouts.base')

@section('title','支付方式')

@section('pageHeader','支付方式')

@section('pageDesc','DashBoard')

@section('content')

    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">
        </div>
    </div>
    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                @include('admin.partials.errors')
                @include('admin.partials.success')
                <div class="box-body">
                    <table id="tags-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th data-sortable="false" class="hidden-sm"></th>
                            <th class="hidden-sm">支付名称</th>
                            <th class="hidden-sm">支付方式描述</th>
                            <th class="hidden-md">￥费用</th>
                            <th class="hidden-md">开启</th>
                            <th class="hidden-md">货到付款</th>
                            <th class="hidden-md">线上支付</th>
                            <th class="hidden-md">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data))
                            @foreach($data as $v)
                                <tr>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->pay_name }}</td>
                                    <td>{{ mb_substr($v->pay_desc,0,20) }}...</td>
                                    <td>{{ $v->pay_fee }}</td>
                                    <td>{{ $v->enabled?'是':'否' }}</td>
                                    <td>{{ $v->is_cod?'是':'否' }}</td>
                                    <td>{{ $v->is_online?'是':'否' }}</td>
                                    <td><a href="{{ route('admin.set.payment.edit', ['pay_id'=>$v->id]) }}">编辑</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>暂无收获地址</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop