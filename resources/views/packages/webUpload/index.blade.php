<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>演示：WebUploader大文件上传</title>
    <meta name="keywords" content="webupload大文件上传"/>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="description"
          content="我们在上传大文件时都遇到过这样或那样的问题,设置很大的maxRequestLength值并不能完全解决问题,除了允许你上传大文件外，还能实时显示上传进度并捕获上传中的错误信息"/>
    <link rel="stylesheet" type="text/css" href="packages/webUpload/css/webuploader.css"/>
    <link rel="stylesheet" type="text/css" href="packages/webUpload/css/style.css"/>
</head>
<body>
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
<script type="text/javascript" src="packages/webUpload/js/jquery.js"></script>
<script type="text/javascript" src="packages/webUpload/js/webuploader.js"></script>
<script type="text/javascript" src="packages/webUpload/js/upload.js"></script>
</body>
</html>

