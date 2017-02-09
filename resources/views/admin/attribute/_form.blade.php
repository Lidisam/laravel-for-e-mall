<div class="form-group">
    <label for="tag" class="col-md-3 control-label">属性名</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="attr_name" id="tag" value="{{ $attr_name }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">属性类型</label>
    <div class="col-md-5">
        <input type="radio" class="radio-inline" name="attr_type" checked="checked"
               value="1">是
        <input type="radio" class="radio-inline" name="attr_type" value="0">否
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">属性可选值</label>
    <div class="col-md-5">
        <textarea name="attr_option_values" id="tag" class="form-control" rows="10"
                  placeholder="4g,8g,16g">{{ $attr_option_values }}</textarea>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">类型</label>
    <div class="col-md-5">
        <select name="type_id" id="tag" class="form-control">
            @foreach($types as $k => $v)
                <option value="{{ $v['id'] }}" @if($v['id'] == $type_id) selected @endif>{{ $v['type_name'] }}</option>
            @endforeach;
        </select>
    </div>
</div>






