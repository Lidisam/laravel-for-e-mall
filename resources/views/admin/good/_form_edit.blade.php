<script src="/packages/layer/module/laydate/laydate.js"></script>
<style>
    .form-group {
        margin-bottom: 5px;
    }
</style>
<ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">基本信息</a></li>
    <li><a href="#desc" data-toggle="tab">商品描述</a></li>
    <li><a href="#memberLevel" data-toggle="tab">会员价格</a></li>
    <li><a href="#settings" data-toggle="tab">商品属性</a></li>
    <li><a href="#pics" data-toggle="tab">商品相册</a></li>
</ul>


<div class="tab-content" style="margin-top: 5px">
    {{--商品基本描述--}}
    @include('admin.good.partials.edit._form_base')
    {{--商品描述--}}
    @include('admin.good.partials.edit._form_desc')
    {{--会员价格--}}
    @include('admin.good.partials.edit._form_ml')
    {{--商品属性--}}
    @include('admin.good.partials.edit._form_set')
    {{--商品相册--}}
    @include('admin.good.partials.edit._form_pic')
</div>
