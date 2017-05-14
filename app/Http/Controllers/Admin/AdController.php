<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Repositories\Admin\AdRepository;
use App\Repositories\PicRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AdController extends Controller
{
    protected $fields = [
        'ad_name' => '',
        'ad_weight' => '',
        'ad_start_time' => '',
        'ad_end_time' => '',
        'ad_url' => '',
        'is_open' => '',
        'linkman' => '',
        'lm_email' => '',
        'lm_num' => '',
    ];
    protected $ad;
    protected $picRepository;

    public function __construct(PicRepository $picRepository, AdRepository $adRepository)
    {
        $this->picRepository = $picRepository;
        $this->ad = $adRepository;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = $this->ad->model();
        $search = $request->get('search');
        //搜索条件
        $map = array(
            'ad_name' => '%' . $search['value'] . '%',
        );
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search);
        if (count($data))
            return response()->json($data);
        return view('admin.ad.index');
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
        $data['ad_logo'] = '';
        return view('admin.ad.create', $data);
    }

    /**
     * 添加保存函数
     * @param AdStoreRequest $request
     * @return mixed
     */
    public function store(AdStoreRequest $request)
    {
        $info = $this->ad->model();
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        /*****上传文件*****/
        $fileRes = $this->picRepository->uploadFileOfImg($_FILES, 'ad_logo', 'ad', ['size' => [352, 150]]);
        if (!$fileRes['status'])
            return redirect()->back()->withErrors($fileRes['msg']);
        /********保存*******/
        $this->ad->storeAd($info,$fileRes);

        return redirect('/admin/ad')->withSuccess('添加成功！');
    }

    /**
     * 修改显示页
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $info = $this->ad->returnById($id);
        if (!$info) return redirect('/admin/ad')->withErrors("找不到该对象!");
        $permissions = [];
        if ($info->perms) {
            foreach ($info->perms as $v) {
                $permissions[] = $v->id;
            }
        }
        $this->fields['ad_logo'] = null;
        $this->fields['sm_ad_logo'] = null;
        $info->perms = $permissions;
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $info->$field);
        }
        $data['id'] = $id;
        return view('admin.ad.edit', $data);
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
        $info = $this->ad->model();
        $logo = $info->ad_logo;
        $sm_logo = $info->ad_sm_logo;
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request->get($field);
        }
        unset($info->perms);
        /*****上传文件*****/
        if ($request->file('ad_logo')) {   //文件存在
            $fileRes = $this->picRepository->uploadFileOfImg($_FILES, 'ad_logo', 'ad', ['size' => [352, 150]]);
            if (!$fileRes['status'])
                return redirect()->back()->withErrors($fileRes['msg']);
            /********保存*******/
            is_file($logo) && unlink($logo) && unlink($sm_logo);  //判断是否存在且删除
            $info->ad_logo = $fileRes['savePath'] . '/' . $fileRes['path'];
            $info->ad_sm_logo = $fileRes['savePath'] . '/thumb_' . $fileRes['path'];
        }
        $this->ad->saveAd($info);
        return redirect('/admin/ad')->withSuccess('修改成功！');
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
        $info = $this->ad->returnById($id);
        if ($info) {
            $this->ad->deleteById($info);
        } else {
            return redirect()->back()
                ->withErrors("删除失败");
        }
        return redirect()->back()
            ->withSuccess("删除成功");
    }

}
