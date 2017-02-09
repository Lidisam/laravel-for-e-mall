<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests\AttributeUpdateRequest;
//use App\Http\Requests\AttributeStoreRequest;
use App\Http\Requests\AttributeStoreRequest;
use App\Http\Requests\AttributeUpdateRequest;
use App\Models\Attribute;
use App\Models\Type;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    protected $fields = [
        'attr_name' => '',
        'attr_type' => '',
        'attr_option_values' => '',
        'type_id' => '',
    ];


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request, $id)
    {
        $model = new Attribute();
        $search = $request->get('search');
        //搜索条件
        $map = array(
            'attr_name' => '%' . $search['value'] . '%',
            'attr_id' => array(
                'way' => 'and',
                'op' => '=',
                'value' => intval($id),
            )
        );
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search);
        if (count($data))
            return response()->json($data);
        $data['id'] = $id;
        return view('admin.attribute.index', $data);
    }


    /**
     * 添加显示界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $data['types'] = Type::all();
        return view('admin.attribute.create', $data);
    }

    /**
     * 添加保存函数
     * @param  $request
     * @return mixed
     */
    public function store(AttributeStoreRequest $request)
    {
        $info = new Attribute();
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        $info->save();   //保存
        return redirect('/admin/attribute/index/' . $info->id)->withSuccess('添加成功！');
    }

    /**
     * 修改显示页
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $info = Attribute::find((int)$id);
        if (!$info) return redirect('/admin/attribute/index/' . $id)->withInput()->withErrors("找不到该对象!");
        $permissions = [];
        if ($info->perms) {
            foreach ($info->perms as $v) {
                $permissions[] = $v->id;
            }
        }
        $info->perms = $permissions;
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $info->$field);
        }
        $data['id'] = $id;
        $data['types'] = Type::all();
        return view('admin.attribute.edit', $data);
    }

    /**
     * 修改操作页
     * @param AttributeUpdateRequest $request
     * @param $id
     * @return mixed
     * @internal param $MemberLevelUpdateRequest
     */
    public function update(AttributeUpdateRequest $request, $id)
    {
        $info = Attribute::find((int)$id);
        $logo = $info->logo;
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        unset($info->perms);
        $info->save();
        return redirect('/admin/attribute/index/' . $id)->withSuccess('修改成功！');
    }

    public function show()
    {

    }

    /**
     * 删除操作
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $info = Attribute::find((int)$id);
        if ($info) {
            $info->delete();
        } else {
            return redirect()->back()
                ->withErrors("删除失败");
        }
        return redirect()->back()
            ->withSuccess("删除成功");
    }

}
