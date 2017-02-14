@include('UEditor::head')
<div class="tab-pane" id="desc">
    <!-- 加载编辑器的容器 -->
    <script id="container" name="content" type="text/plain"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container',{
//                serverUrl: "php/controller.php",//服务器请求地址
            initialFrameHeight:280
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
            //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
    </script>
</div>