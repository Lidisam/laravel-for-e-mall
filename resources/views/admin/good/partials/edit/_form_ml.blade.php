<div class="tab-pane" id="memberLevel">
    <div class="form-group">
        <label class="col-md-3 control-label">会员价格</label>
        <div class="col-md-5">
            @if(count($memberLevelDatas))
                @foreach($memberLevelDatas as $key => $memberLevelData)
                    <?php $flag = 1;?>
                    @foreach($currentMemberLevelDatas as $k2 => $cmlData)
                        @if($memberLevelData->id == $cmlData->level_id)
                            <div class="col-md-12" style="margin-bottom: 5px">
                                ({{ $memberLevelData->level_name }})(<?=($memberLevelData->rate) / 10;?>折)：￥
                                <input type="text" value="{{ $cmlData->price }}" placeholder="会员价格"
                                       name="mp[{{  $memberLevelData->id }}]"
                                       onkeyup="this.value=this.value.replace(/[^\.\d]/g,'')"> 元
                            </div>
                            <?php $flag = 0;?>
                        @endif
                    @endforeach
                    @if($flag == 1)
                        <div class="col-md-12" style="margin-bottom: 5px">
                            ({{ $memberLevelData->level_name }})(<?=($memberLevelData->rate) / 10;?>折)：￥
                            <input type="text" placeholder="会员价格" name="mp[{{  $memberLevelData->id }}]"
                                   onkeyup="this.value=this.value.replace(/[^\.\d]/g,'')"> 元
                        </div>
                    @endif
                @endforeach
            @else
                <span style="color: #ccc">会员价格列表为空</span>
            @endif
        </div>
    </div>
    <div class="col-md-12 text-center" style="color: red;margin-bottom: 5px">
        注：如果没有填会员价格就按钮折扣率计算价格，如果填了就填的算价格不再打折
    </div>
</div>