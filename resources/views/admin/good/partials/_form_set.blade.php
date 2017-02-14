<div class="tab-pane" id="settings">
    <label class="col-md-3 control-label">商品分类</label>
    <div class="col-md-5">
        @if(count($typeDatas))
            <select name="type_id" id="type_selected" class="form-control">
                @foreach($typeDatas as $key => $typeData)
                    <option value="{{ $typeData->id }}">{{ $typeData->type_name }}</option>
                @endforeach;
            </select>
        @else
            <span style="color: #ccc">商品类型为空</span>
        @endif
    </div>
    <div style="margin-top: 10px" class="col-md-12" id="goods_type_content"></div>
</div>

<script>
    document.getElementsByName('type_id')['0'].onchange = function () {
        getMes(this, null);
    };
    window.onload = function () {
        getMes(null, "{{ $typeDatas['0']->id }}");
    };
    function getMes(obj, $id) {
        if (!$id)
            var type_id = $(obj).val();
        else type_id = $id;
        if (type_id != "") {
            //ajax请求数据
            $.ajax({
                type: "GET",
                url: "/admin/good/ajaxGetAttr?type_id=" + type_id,
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    var html = "";
                    $(data).each(function (k, v) {
                        html += "<p style='margin-top: 2px'>";
                        html += v.attr_name + ":";
                        if (v.attr_type == 1)
                            html += "<a onclick='addnew(obj);' href='javascript:void(0);'>[+]</a>";
                        if (v.attr_option_values == "")
                            html += "<input type='text' name='ga[" + v.id + "][]' />";
                        else {
                            var _attr = v.attr_option_values.split(",");
                            html += "<select name='ga[" + v.id + "][]'>";
                            html += "<option value=''>请选择</option>";
                            for (var i = 0; i < _attr.length; i++) {
                                html += "<option value='" + _attr[i] + "'>" + _attr[i] + "</option>";
                            }
                            html += "</select>";
                        }
                        if (v.attr_type == 1)
                            html += "属性价格：￥<input size='0' name='attr_price[" + v.id + "][]' type='text'>";
                        html += "</p>";
                    });
                    $("#goods_type_content").html(html);
                }
            });
        } else {
            $("#goods_type_content").html("");
        }
    }
    //克隆
    function addnew(a) {
        var p = $(a).parent();
        if ($(a).html() == "[+]") {
            var newP = p.clone();
            newP.find("a").html("[-]");
            p.after(newP);
        } else {
            p.remove();
        }
    }
</script>
