@extends('admin.layouts.base')

@section('title','订单模板编辑')

@section('pageHeader','订单模板编辑')

@section('pageDesc','DashBoard')

@section('content')
    @include('UEditor::head')
    <div class="main animsition">
        <div class="container-fluid">

            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">订单模板编辑</h3>
                        </div>
                        <div class="panel-body" style="padding:0 0 0 0">

                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <div class="col-md-12">
                                <form role="form" method="POST" action="#" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group" style="padding-right: 20px">
                                        <script id="ue_container" name="order_template" type="text/plain"></script>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-success">提交修改</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 加载编辑器的容器 -->
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('ue_container', {
            initialFrameHeight: 330
        });
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
            //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
    </script>
@stop