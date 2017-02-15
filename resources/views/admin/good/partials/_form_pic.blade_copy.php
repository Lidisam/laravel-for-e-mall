
{{--设置token验证--}}
<meta name="_token" content="{{ csrf_token() }}"/>
{{--设置当前保存url--}}
<meta name="_url" content="/admin/good/webUpload"/>
<link rel="stylesheet" type="text/css" href="/packages/webUpload/css/webuploader.css"/>
<link rel="stylesheet" type="text/css" href="/packages/webUpload/css/style.css"/>
<div class="tab-pane" id="pics">
    {{--S=图片展示--}}
    <link rel="stylesheet"  href="/packages/gallery/css/zoom.css" media="all" />
    <div class="container">
        <div class="col-md-11">
            <div class="gallery">
                <div class="gallery-style">
                    <div>
                        <a href="/packages/gallery/img/gallery/DSC_0008-660x441.jpg">
                            <img src="/packages/gallery/img/gallery/DSC_0008-69x69.jpg"/>
                        </a>
                        <div><button class="btn btn-warning form-control">删除</button></div>
                    </div>
                </div>
            </div>
            <div class="gallery">
                <div class="gallery-style">
                    <div>
                        <a href="/packages/gallery/img/gallery/DSC_0008-660x441.jpg">
                            <img src="/packages/gallery/img/gallery/DSC_0008-69x69.jpg" width="100%"/>
                        </a>
                        <div><button class="btn btn-warning form-control">删除</button></div>
                    </div>
                </div>
            </div>
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