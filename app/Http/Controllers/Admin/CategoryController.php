<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Admin\CategoryRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $fields = [
        'cat_name' => '',
        'parent_id' => '',
    ];
    protected $cat;
    function __construct(CategoryRepository $categoryRepository)
    {
        $this->cat = $categoryRepository;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = $this->cat->model();
        $search = $request->get('search');
        //搜索条件
        $map = array(
            'cat_name' => '%' . $search['value'] . '%',
        );
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search);
        if (count($data['data']))   //判断当前是否查询了数据并转换为无限极分类
            $data['data'] = $model->changeObj($model->sortOut($data['data']->toArray()));
        if (count($data))
            return response()->json($data);
        return view('admin.category.index');
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
        $data['all'] = $this->cat->returnAllCats();
        return view('admin.category.create', $data);
    }

    /**
     * 添加保存函数
     * @param CategoryStoreRequest|BrandStoreRequest $request
     * @return mixed
     */
    public function store(CategoryStoreRequest $request)
    {
        $info = $this->cat->model();
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        $this->cat->save($info);   //保存
        return redirect('/admin/category')->withSuccess('添加成功！');
    }

    /**
     * 修改显示页
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $info = $this->cat->returnById($id);
        if (!$info) return redirect('/admin/category')->withErrors("找不到该对象!");
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
        $data['all'] = $this->cat->returnAllCats();
        return view('admin.category.edit', $data);
    }

    /**
     * 修改操作页
     * @param CategoryUpdateRequest $request
     * @param $id
     * @return mixed
     * @internal param $MemberLevelUpdateRequest
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $info = $this->cat->returnById($id);
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        unset($info->perms);
        $this->cat->save($info);
        return redirect('/admin/category')->withSuccess('修改成功！');
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
        $info = $this->cat->returnById($id);
        if ($info) {
            $this->cat->delete($info);
        } else {
            return redirect()->back()
                ->withErrors("删除失败");
        }
        return redirect()->back()
            ->withSuccess("删除成功");
    }

}
