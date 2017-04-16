<div class="form-group">
    <label for="name" class="col-md-3 control-label">用户名</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="name" id="tag" value="{{ $name }}" required autofocus>
    </div>
</div>

<div class="form-group">
    <label for="mobile" class="col-md-3 control-label">手机号</label>
    <div class="col-md-5">
        <input type="tel" class="form-control" name="mobile" id="tag" value="{{ $mobile }}" required>
    </div>
</div>
@if(!strpos(\Route::current()->getActionName(),'edit'))
    <div class="form-group">
        <label for="password" class="col-md-3 control-label">密码</label>
        <div class="col-md-5">
            <input type="password" class="form-control" name="password" id="tag" value="" required>
        </div>
    </div>

    <div class="form-group">
        <label for="password_confirmation" class="col-md-3 control-label">确认密码</label>
        <div class="col-md-5">
            <input type="password" class="form-control" name="password_confirmation" id="tag"
                   value="{{ $password_confirmation }}" required>
        </div>
    </div>
@endif