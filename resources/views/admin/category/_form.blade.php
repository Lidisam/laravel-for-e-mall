<div class="form-group">
    <label for="tag" class="col-md-3 control-label">分类名</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="cat_name" id="tag" value="{{ $cat_name }}" autofocus>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">上级分类id</label>
    <div class="col-md-5">
        <select name="parent_id" id="" class="form-control">
            @foreach ($all as $single)
                <option value="{{ $single['id'] }}">{{ $single['cat_name'] }}</option>
            @endforeach
        </select>
    </div>
</div>






