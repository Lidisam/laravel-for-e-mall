<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdStoreRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    protected $fields = [
        'id' => '',
        'name' => '',
        'mobile' => '',
        'created_at' => '',
        'updated_at' => '',
    ];


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = new User();
        $search = $request->get('search');
        //搜索条件
        $map = array(
            'mobile' => '%' . $search['value'] . '%',
        );
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search);
        if (count($data))
            return response()->json($data);
        return view('admin.customer.index');
    }

    /**
     * 添加显示界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data = [];
        $this->fields['password'] = '';
        $this->fields['password_confirmation'] = '';
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $data['all'] = User::all()->toArray();
        return view('admin.customer.create', $data);
    }

    /**
     * 添加保存函数
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $info = new User();
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        $info->password = bcrypt($request->get('password'));
        unset($info->created_at);
        unset($info->updated_at);

        $info->save();   //保存
        return redirect('/admin/customer')->withSuccess('添加成功！');
    }

    /**
     * 修改显示页
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $info = User::find((int)$id);
        if (!$info) return redirect('/admin/customer')->withErrors("找不到该对象!");
        $this->fields['password'] = '';
        $this->fields['password_confirmation'] = '';
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
        return view('admin.customer.edit', $data);
    }

    /**
     * 修改操作页
     * @param Request $request
     * @param $id
     * @return mixed
     * @internal param $MemberLevelUpdateRequest
     */
    public function update(Request $request, $id)
    {
        $info = User::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        unset($info->password);
        unset($info->created_at);
        unset($info->updated_at);
        unset($info->perms);
        $info->save();
        return redirect('/admin/customer')->withSuccess('修改成功！');
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
        $info = User::find((int)$id);
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
