<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\MemberLevelUpdateRequest;
use App\Models\Brand;
use App\Models\MemberLevel;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    protected $fields = [
        'brand_name' => '',
        'site_url' => '',
        'logo' => '',
    ];


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = new Brand();
        $search = $request->get('search');
        //搜索条件
        $map = array(
            'brand_name' => '%' . $search['value'] . '%',
        );
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search);
        if (count($data))
            return response()->json($data);
        return view('admin.brand.index');
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
        $data['all'] = Brand::all()->toArray();
        return view('admin.brand.create', $data);
    }

    /**
     * 添加保存函数
     * @param BrandStoreRequest $request
     * @return mixed
     */
    public function store(BrandStoreRequest $request)
    {
        $info = new Brand();
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        /*****上传文件*****/
        $fileRes = $this->uploadFile($request, 'brand', 'logo');
        if (!$fileRes['status'])
            return redirect()->back()->withErrors($fileRes['msg']);
        /********保存*******/
        $info->logo = $fileRes['savePath'] . $fileRes['path'];
        $info->save();   //保存
        return redirect('/admin/brand')->withSuccess('添加成功！');
    }

    /**
     * 修改显示页
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $info = Brand::find((int)$id);
        if (!$info) return redirect('/admin/brand')->withErrors("找不到该对象!");
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
        return view('admin.brand.edit', $data);
    }

    /**
     * 修改操作页
     * @param MemberLevelUpdateRequest $request
     * @param $id
     * @return mixed
     * @internal param $MemberLevelUpdateRequest
     */
    public function update(MemberLevelUpdateRequest $request, $id)
    {
        $info = MemberLevel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        unset($info->perms);
        $info->save();
        return redirect('/admin/memberLevel')->withSuccess('修改成功！');
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
        $info = MemberLevel::find((int)$id);
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
