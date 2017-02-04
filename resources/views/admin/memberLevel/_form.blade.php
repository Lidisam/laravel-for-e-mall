<div class="form-group">
    <label for="tag" class="col-md-3 control-label">用户名</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="level_name" id="tag" value="{{ $level_name }}" autofocus>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">积分下限</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="bottom_num" id="tag" value="{{ $bottom_num }}">
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">积分上限</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="top_num" id="tag" value="{{ $top_num }}">
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">折扣率</label>
    <div class="col-md-5">
        <input type="text" placeholder="折扣率，以百分比，如9折=90" class="form-control" name="rate"
               id="tag" value="{{ $rate }}">
    </div>
</div>




