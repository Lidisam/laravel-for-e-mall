<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TypeUpdateRequest;
use App\Http\Requests\TypeStoreRequest;
use App\Models\Type;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    protected $fields = [
        'type_name' => '',
    ];


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = new Type();
        $search = $request->get('search');
        //搜索条件
        $map = array(
            'type_name' => '%' . $search['value'] . '%',
        );
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search);
        if (count($data))
            return response()->json($data);
        return view('admin.type.index');
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
        return view('admin.type.create', $data);
    }

    /**
     * 添加保存函数
     * @param  $request
     * @return mixed
     */
    public function store(TypeStoreRequest $request)
    {
        $info = new Type();
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        $info->save();   //保存
        return redirect('/admin/type')->withSuccess('添加成功！');
    }

    /**
     * 修改显示页
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $info = Type::find((int)$id);
        if (!$info) return redirect('/admin/type')->withErrors("找不到该对象!");
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
        return view('admin.type.edit', $data);
    }

    /**
     * 修改操作页
     * @param TypeUpdateRequest $request
     * @param $id
     * @return mixed
     * @internal param $MemberLevelUpdateRequest
     */
    public function update(TypeUpdateRequest $request, $id)
    {
        $info = Type::find((int)$id);
        $logo = $info->logo;
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        unset($info->perms);
        $info->save();
        return redirect('/admin/type')->withSuccess('修改成功！');
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
        $info = Type::find((int)$id);
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
