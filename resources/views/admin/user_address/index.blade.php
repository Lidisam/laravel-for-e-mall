@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

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
                    <th class="hidden-sm">昵称</th>
                    <th class="hidden-sm">手机号</th>
                    <th class="hidden-md">详细地址</th>
                </tr>
                </thead>
                <tbody>
                @if(count($datas))
                    @foreach($datas as $v)
                        <tr>
                            <td>{{ $v->id }}</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->mobile }}</td>
                            <td>{{ $v->province }} {{ $v->city }} {{ $v->county }} {{ $v->address }}</td>
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
