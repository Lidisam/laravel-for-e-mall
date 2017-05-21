<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Admin\CategoryRepository;
use App\Service\Upload\LocalUploadService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $fields = [
        'cat_name' => '',
        'parent_id' => '',
        'order_weight' => '',
    ];
    protected $cat;
    protected $upload;

    function __construct(CategoryRepository $categoryRepository, LocalUploadService $localUploadService)
    {
        $this->cat = $categoryRepository;
        $this->upload = $localUploadService;
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
        if (count($data['data'])) {  //判断当前是否查询了数据并转换为无限极分类
            $data['data'] = $model->changeObj($model->sortOut($data['data']->toArray()));
        }
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
//        TODO:这里显示不可写，但是给了权限还是不行  但是隔壁目录brand可以。。。
        $res = $this->upload($request, 'cat_logo');
        if($res['status'] == 0) return redirect('/admin/category')->withErrors($res['msg']);
        else if ($res['status'] == 1){
            $info->cat_logo = $res['path'];
        }
        $res2 = $this->upload($request, 'cat_pic');
        if($res2['status'] == 0) return redirect('/admin/category')->withErrors($res2['msg']);
        else if ($res2['status'] == 1){
            $info->cat_pic = $res2['path'];
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
        $data['cat_logo'] = $info->cat_logo;
        $data['cat_pic'] = $info->cat_pic;
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
        $old_cat_logo = $info->cat_logo;
        $old_cat_pic = $info->cat_pic;
        //TODO:这里显示不可写，但是给了权限还是不行  但是隔壁文件目录brand可以。。。
        $logo_flag = 0;
        $pic_flag = 0;
        $res = $this->upload($request, 'cat_logo');
        if($res['status'] == 0) return redirect('/admin/category')->withErrors($res['msg']);
        else if ($res['status'] == 1){
            $info->cat_logo = $res['path'];
            $logo_flag = 1;
        }
        $res2 = $this->upload($request, 'cat_pic');
        if($res2['status'] == 0) return redirect('/admin/category')->withErrors($res2['msg']);
        else if ($res2['status'] == 1){
            $info->cat_pic = $res2['path'];
            $pic_flag = 1;
        }

        $this->cat->save($info);
        $logo_flag &&$this->upload->delete($info->cat_logo, $old_cat_logo);
        $pic_flag && $this->upload->delete($info->cat_pic, $old_cat_pic);

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
            @unlink($info->cat_logo);
            @unlink($info->cat_pic);
        } else {
            return redirect()->back()
                ->withErrors("删除失败");
        }
        return redirect()->back()
            ->withSuccess("删除成功");
    }


    /**
     * 上传判断
     * @param Request $request
     * @param $pic_name
     * @return array
     */
    private function upload(Request $request, $pic_name) {
        if($request->file($pic_name)) {
            $res2 = $this->upload->create($request, $pic_name, 'brand',[120,120]);
            if (!$res2['status']) {
                return [
                    'status' => 0,
                    'msg' => $res2['msg']
                ];
            } else {
                return [
                    'status' => 1,
                    'path' => $res2['savePath'] . '/' . $res2['path']
                ];
            }
        }
        return [
            'status' => 2
        ];
    }
}
