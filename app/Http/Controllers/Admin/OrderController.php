<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdUpdateRequest;
use App\Repositories\Admin\OrderRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $fields = [
        'user_id' => '',
        'order_num' => '',
        'consigner' => '',
        'total_price' => '',
        'real_price' => '',
        'user_desc' => '',
        'pay_status' => '',
        'order_status' => '',
        'deliver_status' => '',
        'pay_way_name' => '',
        'pay_way_id' => '',
        'user_address_id' => '',
    ];
    protected $order;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->order = $orderRepository;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = $this->order->model();
        $search = $request->get('search');
        $searchAll = json_decode($search['value'], true);
        //组装新的查询条件数据
        $map = $this->order->search_map($searchAll);
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search);
        if (count($data)) {
            return response()->json($this->order->transferOrders($data));
        }
        return view('admin.order.index');
    }

    public function create()
    {
    }

    public function store()
    {
    }

    /**
     * 修改显示页
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $info = $this->order->returnById($id);
        if (!$info) return redirect('/admin/order')->withErrors("找不到该对象!");
        $permissions = [];
        if ($info->perms) {
            foreach ($info->perms as $v) {
                $permissions[] = $v->id;
            }
        }
        $info->perms = $permissions;
        $this->fields['created_at'] = '';
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $info->$field);
        }
        $data['id'] = $id;
        $payments = $this->order->returnAllPayments();

        return view('admin.order.edit', $data, compact('payments', 'userAddress', 'info'));
    }

    /**
     * 修改操作页
     * @param AdUpdateRequest $request
     * @param $id
     * @return mixed
     * @internal param $MemberLevelUpdateRequest
     */
    public function update(AdUpdateRequest $request, $id)
    {
        $info = $this->order->model();
        $logo = $info->ad_logo;
        $sm_logo = $info->ad_sm_logo;
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        unset($info->perms);
        /*****上传文件*****/
        if ($request->file('ad_logo')) {   //文件存在
            $fileRes = $this->picRepository->uploadFileOfImg($_FILES, 'ad_logo', 'order', ['size' => [352, 150]]);
            if (!$fileRes['status'])
                return redirect()->back()->withErrors($fileRes['msg']);
            /********保存*******/
            is_file($logo) && unlink($logo) && unlink($sm_logo);  //判断是否存在且删除
            $info->ad_logo = $fileRes['savePath'] . ' / ' . $fileRes['path'];
            $info->ad_sm_logo = $fileRes['savePath'] . ' / thumb_' . $fileRes['path'];
        }
        $this->order->saveAd($info);
        return redirect(' / admin / order')->withSuccess('修改成功！');
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
        $info = $this->order->returnById($id);
        if ($info) {
            $this->order->deleteById($info);
        } else {
            return redirect()->back()
                ->withErrors("删除失败");
        }
        return redirect()->back()
            ->withSuccess("删除成功");
    }

}
