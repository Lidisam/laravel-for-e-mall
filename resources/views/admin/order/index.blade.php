@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')

    <div class="row page-title-row" style="margin:5px;">
        {{--S=搜索部分--}}
        @include('admin.order.partials.index_search')
        {{--E=搜索部分--}}
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
                            <th class="hidden-sm">订单号</th>
                            <th class="hidden-sm">收货人</th>
                            <th class="hidden-sm">订单收价</th>
                            <th class="hidden-sm">订单状态</th>
                            <th class="hidden-md">创建时间</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="modal fade" id="modal-delete" tabIndex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">提示</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i>
                        确认要删除吗?
                    </p>
                </div>
                <div class="modal-footer">
                    <form class="deleteForm" method="POST" action="/admin/order">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i>确认
                        </button>
                    </form>
                </div>

            </div>
            @stop

            @section('js')
                <script>
                    $(function () {
                        var table = $("#tags-table").DataTable({
                            language: {
                                "sProcessing": "处理中...",
                                "sLengthMenu": "显示 _MENU_ 项结果",
                                "sZeroRecords": "没有匹配结果",
                                "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                                "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                                "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                                "sInfoPostFix": "",
                                "sSearch": "搜索:",
                                "sUrl": "",
                                "sEmptyTable": "表中数据为空",
                                "sLoadingRecords": "载入中...",
                                "sInfoThousands": ",",
                                "oPaginate": {
                                    "sFirst": "首页",
                                    "sPrevious": "上页",
                                    "sNext": "下页",
                                    "sLast": "末页"
                                },
                                "oAria": {
                                    "sSortAscending": ": 以升序排列此列",
                                    "sSortDescending": ": 以降序排列此列"
                                }
                            },
                            order: [[1, "desc"]],
                            serverSide: true,
                            ajax: {
                                url: '/admin/order/index',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            },
                            "columns": [
                                {"data": "id"},
                                {"data": "order_num"},
                                {"data": "consigner"},
                                {"data": "real_price"},
                                {"data": "order_status"},
                                {"data": "created_at"},
                                {"data": "action"}
                            ],
                            columnDefs: [
                                {
                                    'targets': -1, "render": function (data, type, row) {
                                    var caozuo = '<a style="margin:3px;" href="/admin/order/' + row['id'] + '/edit" class="X-Small btn-xs text-success "><i class="fa fa-edit"></i> 查看</a>';
                                    caozuo += '<a style="margin:3px;" href="#" attr="' + row['id'] + '" class="delBtn X-Small btn-xs text-danger "><i class="fa fa-times-circle-o"></i> 删除</a>';
                                    return caozuo;
                                }
                                }
                            ]
                        });
                        //隐藏原有的搜索框
                        $(".dataTables_filter label input[type=search]").hide();
                        $(".search_example").on('keyup change', function () {
                            var val1 = $("[name=order_num]").val();
                            var val2 = $("[name=order_status]:checked").val();
                            var val3 = $("[name=deliver_status]:checked").val();
                            var val4 = $("[name=is_del]:checked").val();
                            var val5 = $("[name=order_start_price]").val();
                            var val6 = $("[name=order_end_price]").val();
                            var val7 = $("[name=order_start_time]").val();
                            var val8 = $("[name=order_end_time]").val();
                            var val9 = $("[name=consigner]").val();
                            //自带的那个搜索框
                            table.search(
                                '{"order_num":"' + val1 + '",' +
                                '"order_status":"' + val2 + '",' +
                                '"deliver_status":"' + val3 + '",' +
                                '"is_del":"' + val4 + '",' +
                                '"order_start_price":"' + val5 + '",' +
                                '"order_end_price":"' + val6 + '",' +
                                '"order_start_time":"' + val7 + '",' +
                                '"order_end_time":"' + val8 + '",' +
                                '"consigner":"' + val9 + '"}'
                            ).draw();
                        });

                        table.on('preXhr.dt', function () {
                            loadShow();
                        });

                        table.on('draw.dt', function () {
                            loadFadeOut();
                        });

                        table.on('order.dt search.dt', function () {
                            table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                                cell.innerHTML = i + 1;
                            });
                        }).draw();

                        $("table").delegate('.delBtn', 'click', function () {
                            var id = $(this).attr('attr');
                            $('.deleteForm').attr('action', '/admin/order/' + id);
                            $("#modal-delete").modal();
                        });

                    });
                </script>
@stop