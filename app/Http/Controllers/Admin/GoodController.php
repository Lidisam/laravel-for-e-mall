<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Brand;
use App\Models\Categorys;
use App\Models\Good;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class GoodController extends Controller
{
    protected $fields = [
        'goods_name' => '',
        'cat_id' => '',
        'brand_id' => '',
        'market_price' => '',
        'shop_price' => '',
        'jifen' => '',
        'jifen_price' => '',
        'jyz' => '',
        'is_promote' => '',
        'promote_price' => '',
        'promote_start_time' => '',
        'promote_end_time' => '',
        'logo' => '',
        'sm_logo' => '',
        'goods_desc' => '',
        'is_hot' => '',
        'is_new' => '',
        'is_best' => '',
        'is_on_sale' => '',
        'sec_keyword' => '',
        'sec_description' => '',
        'type_id' => '',
        'sort_num' => '',
        'is_delete' => '',
        'addtime' => '',
    ];


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = new Good();
        $search = $request->get('search');
        //搜索条件
        $map = array(
            'goods_name' => '%' . $search['value'] . '%',
            'is_delete' => array(
                'way' => 'and',
                'op' => '=',
                'value' => '0'
            )
        );
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search);
        if (count($data))
            return response()->json($data);
        return view('admin.good.index');
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
        $data['all'] = Good::all()->toArray();
        $catModel = new Categorys();
        //商品分类
        $data['catDatas'] = $catModel->changeObj($catModel->sortOut($catModel->all()->toArray()));
        //商品品牌
        $data['brandDatas'] = Brand::all();

        return view('admin.good.create', $data);
    }

    /**
     * 添加保存函数
     * @param CategoryStoreRequest|BrandStoreRequest $request
     * @return mixed
     */
    public function store(CategoryStoreRequest $request)
    {
        $info = new Categorys();
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        $info->save();   //保存
        return redirect('/admin/category')->withSuccess('添加成功！');
    }

    /**
     * 修改显示页
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $info = Categorys::find((int)$id);
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
        $data['all'] = Categorys::all()->toArray();
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
        $info = Categorys::find((int)$id);
        $logo = $info->logo;
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        unset($info->perms);
        $info->save();
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
        $info = Categorys::find((int)$id);
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
