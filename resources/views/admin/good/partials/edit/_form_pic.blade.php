{{--设置token验证--}}
<meta name="_token" content="{{ csrf_token() }}"/>
{{--设置当前保存url--}}
<meta name="_url" content="/admin/good/webUpload?goods_id={{ $id }}"/>
<link rel="stylesheet" type="text/css" href="/packages/webUpload/css/webuploader.css"/>
<link rel="stylesheet" type="text/css" href="/packages/webUpload/css/style.css"/>
<div class="tab-pane" id="pics">
    {{--S=图片展示--}}
    <link rel="stylesheet" href="/packages/gallery/css/zoom.css" media="all"/>
    <div class="container">
        <div class="col-md-11" id="img_show">
            {{--这个作为伪提交--}}
            <div class="gallery" style="display: none">
                <div class="gallery-style">
                    <div>
                        <a href="/packages/gallery/img/gallery/DSC_0008-660x441.jpg">
                            <img src="/packages/gallery/img/gallery/DSC_0008-69x69.jpg"/>
                        </a>
                        <div>
                            <a href="javascript:void(0)" class="btn-sm btn-warning form-control">删除</a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($gpDatas as $key => $v)
                <div class="gallery">
                    <div class="gallery-style">
                        <div>
                            <a href="/{{ $v->pic }}">
                                <img src="/{{ $v->pic }}"/>
                            </a>
                            <div>
                                <button type="button" onclick="delPic({{ $v->id }},this)"
                                        class="btn-sm btn-warning form-control">删除
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="/packages/gallery/js/jquery-2.1.4.min.js"></script>
    <script src="/packages/gallery/js/zoom.min.js"></script>
    {{--E=图片展示--}}

    <div id="wrapper">
        <div id="container">
            <div id="uploader">
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                        <p>或将照片拖到这里，单次最多可选300张</p>
                    </div>
                </div>
                <div class="statusBar" style="display:none;">
                    <div class="progress">
                        <span class="text">0%</span>
                        <span class="percentage"></span>
                    </div>
                    <div class="info"></div>
                    <div class="btns">
                        <div id="filePicker2"></div>
                        <div class="uploadBtn">开始上传</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/packages/webUpload/js/jquery.js"></script>
<script type="text/javascript" src="/packages/webUpload/js/webuploader.js"></script>
{{--参数配置文件--}}
<script type="text/javascript" src="/packages/webUpload/js/upload.js"></script>
{{--layer弹出层--}}
<script src="/packages/layer/layer.js"></script>
<script>
    //删除图片
    function delPic(gid, obj) {
        layer.confirm('确定删除？', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            $.get("/admin/good/delPic?pic_id=" + gid, function (data, status) {
                if (data['status']) {
                    $(obj).parent().parent().parent().parent().remove();
                    layer.msg('删除成功', {icon: 1});
                } else
                    layer.msg('删除失败', {icon: 2});
            });
        }, function () {
            //取消删除的操作
        });
    }
</script>