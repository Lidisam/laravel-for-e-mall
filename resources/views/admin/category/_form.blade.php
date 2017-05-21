<div class="form-group">
    <label for="tag" class="col-md-3 control-label">分类名</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="cat_name" id="tag" value="{{ $cat_name }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">首页排序权重(0最大,依次递减)</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="order_weight" id="tag" value="{{ $order_weight }}" value="0"
               onkeyup="this.value=this.value.replace(/\D/g,'')" required>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">上级分类id</label>
    <div class="col-md-5">
        <select name="parent_id" id="" class="form-control">
            <option value="0">无</option>
            @foreach ($all as $single)
                <option value="{{ $single['id'] }}">{{ $single['cat_name'] }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">logo首页原图</label>
    <div class="col-md-5">
        <input type="file" class="form-control" name="cat_logo">
        <div class="col-md-5">
            @if(isset($cat_logo) && $cat_logo!= "")
                <img style="box-shadow: 0 2px 3px rgba(0,0,0,0.15);max-width: 250px;max-height: 250px"
                     src="/{{ $cat_logo }}" alt="{{ $cat_name }}">
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">分类显示原图</label>
    <div class="col-md-5">
        <input type="file" class="form-control" name="cat_pic">
        <div class="col-md-5">
            @if(isset($cat_pic) && $cat_pic!= "")
                <img style="box-shadow: 0 2px 3px rgba(0,0,0,0.15);max-width: 250px;max-height: 250px"
                     src="/{{ $cat_pic }}" alt="{{ $cat_name }}">
            @endif
        </div>
    </div>
</div>





