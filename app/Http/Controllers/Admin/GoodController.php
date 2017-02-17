<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Categorys;
use App\Models\Good;
use App\Models\GoodsPic;
use App\Models\MemberLevel;
use App\Models\MemberPrice;
use App\Models\Type;
use App\Repositories\PicRepository;
use DaveJamesMiller\Breadcrumbs\Exception;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

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
        'logo' => '',  //
        'sm_logo' => '',  //
        'goods_desc' => '',
        'is_hot' => '',
        'is_new' => '',
        'is_best' => '',
        'is_on_sale' => '',
        'sec_keyword' => '',
        'sec_description' => '',
        'type_id' => '',
        'sort_num' => '',
        'addtime' => '',  //*
    ];


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = new Good();
        $search = $request->get('search');
        $searchAll = json_decode($search['value'], true);
        //组装新的查询条件数据
        $map = $model->search_map($searchAll);
        //列表数据获取
        $data = $this->showList($map, $model, $request, $search);
        if (count($data))
            return response()->json($data);
        //商品分类
        $catModel = new Categorys();
        //商品品牌
        $data['brandDatas'] = Brand::all();
        $data['catDatas'] = $catModel->changeObj($catModel->sortOut($catModel->all()->toArray()));
        return view('admin.good.index', $data);
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
        //会员价格
        $data['memberLevelDatas'] = MemberLevel::all();
        //商品类型属性
        $data['typeDatas'] = Type::all();

        return view('admin.good.create', $data);
    }

    /**
     * 添加保存函数
     * @param CategoryStoreRequest|BrandStoreRequest $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $info = new Good();
        $tmp_request = $request;
        /*****上传文件*****/
        $fileRes = $this->uploadFile($request, 'good', 'logo');
        if (!$fileRes['status'])
            return redirect()->back()->withErrors($fileRes['msg']);
        else {
            $thumb_setting = array(
                'size' => array(
                    'width' => 150,
                    'height' => 150
                ),
                'quality' => 60,
                'path' => $fileRes['savePath'] . '/' . $fileRes['path'],
                'thumb_path' => $fileRes['savePath'] . '/thumb_' . $fileRes['path']
            );
            //上传缩略图
            $thumbRes = $this->makeThumb($thumb_setting);
            if (!$thumbRes['status'])
                return redirect()->back()->withErrors($thumbRes['msg']);
        }
        /**插入前数据处理*/
        $data = $info->before_insert($request, $this->fields);
        $request = $data['data'];
        $this->fields = $data['fields'];
        /********保存数据*******/
        foreach (array_keys($this->fields) as $field) {
            $info->$field = $request[$field];
        }
        $info->logo = $fileRes['savePath'] . '/' . $fileRes['path'];
        $info->sm_logo = $fileRes['savePath'] . '/thumb_' . $fileRes['path'];
        /******插入后及其处理*******/
        $data = $info->after_insert($request, $info, $tmp_request);
        return redirect('/admin/good')->withSuccess('添加成功！');
    }

    /**
     * 修改显示页
     * @param $id
     * @return MemberLevelController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $info = Good::find((int)$id);
        if (!$info) return redirect('/admin/good')->withErrors("找不到该对象!");
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
        $data['all'] = Good::all()->toArray();
        $catModel = new Categorys();
        //商品分类
        $data['catDatas'] = $catModel->changeObj($catModel->sortOut($catModel->all()->toArray()));
        //商品品牌
        $data['brandDatas'] = Brand::all();
        //会员价格
        $data['memberLevelDatas'] = MemberLevel::all();
        //商品类型属性
        $data['typeDatas'] = Type::all();
        //当前拓展分类
        $data['gcDatas'] = DB::table('goods_cats')
            ->join('categorys', function ($join) {
                $join->on('goods_cats.cat_id', '=', 'categorys.id');
            })->select('categorys.*')
            ->where(array('goods_id' => $id))
            ->get();
        //当前用户的会员价格
        $data['currentMemberLevelDatas'] = MemberPrice::where(array('goods_id' => $id))
            ->groupBy("level_id")->get();
        //取出当前商品的属性数据
        $gaData = DB::table('goods_attrs')
            ->join('attributes', function ($join) {
                $join->on('goods_attrs.attr_id', '=', 'attributes.id');
            })->select('goods_attrs.*', 'attributes.attr_name', 'attributes.attr_option_values', 'attributes.attr_type')
            ->where(array('goods_id' => $id))
            ->get();
        //取出新添加的属性
        $attr_id = array();
        $tempArr = [];
        foreach ($gaData as $k => $v) {
            $attr_id[] = $v->attr_id;
            $tempArr[$k]['id'] = $v->id;
            $tempArr[$k]['goods_id'] = $v->goods_id;
            $tempArr[$k]['attr_id'] = $v->attr_id;
            $tempArr[$k]['attr_value'] = $v->attr_value;
            $tempArr[$k]['attr_price'] = $v->attr_price;
            $tempArr[$k]['attr_name'] = $v->attr_name;
            $tempArr[$k]['attr_option_values'] = $v->attr_option_values;
            $tempArr[$k]['attr_type'] = $v->attr_type;
        }
        $gaData = $tempArr;
        $attr_id = array_unique($attr_id);
        $allAttrId = Attribute::where(array('type_id' => $info->type_id))
            ->whereNotIn('id', $attr_id)->get();
        $data['gaData'] = array_merge($gaData, $allAttrId->toArray());
        //商品相册
        $data['gpDatas'] = GoodsPic::where(array('goods_id' => $id))->get();
        return view('admin.good.edit', $data);
    }

    /**
     * 修改操作页
     * @param CategoryUpdateRequest $request
     * @param $id
     * @return mixed
     * @internal param $MemberLevelUpdateRequest
     */
    public function update(Request $request, $id)
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

    /**
     * ajax获取属性根据类型的ID
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxGetAttr(Request $request)
    {
        $typeId = $request->get('type_id');
        $model = new Attribute();
        $info = $model::where(array('type_id' => $typeId))->get();
        return response()->json($info);
    }

    /**
     * 本地webUpload上传
     * @param Request $request
     * @param PicRepository $picRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function webUpload(Request $request, PicRepository $picRepository)
    {
        $res = $picRepository->uploadFileOfImg($_FILES, 'file', 'good_pics', ['size' => [150, 150]]);
        if ($res['status']) {
            $model = new GoodsPic();
            $model->pic = $res['savePath'] . '/' . $res['path'];
            $model->sm_pic = $res['savePath'] . '/thumb_' . $res['path'];
            $model->goods_id = intval($request->get('goods_id'));
            if ($model->save())
                return response()->json(true);
            die(1); //TODO：这个返回没效果
        } else {
            die(1);  //TODO：这个返回没效果
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delPic(Request $request)
    {
        $pic_id = $request->get('pic_id');
        $model = GoodsPic::find(intval($pic_id));
        if ($model->delete()) {
            unlink($model->pic);
            unlink($model->sm_pic);
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }


}
