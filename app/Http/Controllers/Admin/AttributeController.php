<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttributeStoreRequest;
use App\Http\Requests\AttributeUpdateRequest;
use App\Repositories\Admin\AttributeRepository;
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
    protected $attr;
    function __construct(AttributeRepository $attributeRepository)
    {
        $this->attr = $attributeRepository;
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request, $id)
    {
        $model = $this->attr->model();
        $search = $request->get('search');
        //搜索条件
        $map = array(
            'attr_name' => '%' . $search['value'] . '%',
            'type_id' => array(
                'way' => 'and',
                'op' => '=',
                'value' => intval($id),
            )
        );
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search,
            array(
            'type_id' => array(
            'way' => 'and',
            'op' => '=',
            'value' => intval($id),
        )));
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
        $data['types'] = $this->attr->returnAllTypes();
        return view('admin.attribute.create', $data);
    }

    /**
     * 添加保存函数
     * @param  $request
     * @return mixed
     */
    public function store(AttributeStoreRequest $request)
    {
        $info = $this->attr->model();
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
        $info = $this->attr->returnById($id);
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
        $data['types'] = $this->attr->returnAllTypes();
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
        $info = $this->attr->returnById($id);
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        unset($info->perms);
        $this->attr->save($info);
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
        $info = $this->attr->returnById($id);
        if ($info) {
            $this->attr->delete($info);
        } else {
            return redirect()->back()
                ->withErrors("删除失败");
        }
        return redirect()->back()
            ->withSuccess("删除成功");
    }

}
