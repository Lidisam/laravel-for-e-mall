<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MemberLevelStoreRequest;
use App\Http\Requests\MemberLevelUpdateRequest;
use App\Models\MemberLevel;
use App\Repositories\Admin\MemberLevelRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class MemberLevelController extends Controller
{
    protected $fields = [
        'level_name' => '',
        'bottom_num' => '',
        'top_num' => '',
        'rate' => '',
    ];
    protected $ml;
    function __construct(MemberLevelRepository $memberLevelRepository)
    {
        $this->ml = $memberLevelRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = $this->ml->model();
        $search = $request->get('search');
        //搜索条件
        $map = array(
            'level_name' => '%' . $search['value'] . '%',
        );
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search);
        if (count($data))
            return response()->json($data);
        return view('admin.memberLevel.index');
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
        $data['all'] = $this->ml->returnAllMl();
        return view('admin.memberLevel.create', $data);
    }

    /**
     * 添加保存函数
     * @param MemberLevelStoreRequest $request
     * @return mixed
     */
    public function store(MemberLevelStoreRequest $request)
    {
        $info = $this->ml->model();
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        $this->ml->save($info);
        return redirect('/admin/memberLevel')->withSuccess('添加成功！');
    }

    /**
     * 修改显示页
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {

        $info = $this->ml->returnById($id);
        if (!$info) return redirect('/admin/memberLevel')->withErrors("找不到该对象!");
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
        return view('admin.memberLevel.edit', $data);
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
        $info = $this->ml->returnById($id);
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        unset($info->perms);
        $this->ml->save($info);
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
        $info = $this->ml->returnById($id);
        if ($info) {
            $this->ml->delete($info);
        } else {
            return redirect()->back()
                ->withErrors("删除失败");
        }
        return redirect()->back()
            ->withSuccess("删除成功");
    }

}
