<?php

namespace App\Models;

use App\Repositories\PicRepository;
use DaveJamesMiller\Breadcrumbs\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class Good extends Model
{

    /**
     * 自定义orm连接
     * @param $query
     */
    public function scopeOnSaled($query)
    {
        return $query->where('is_on_sale', 1);
    }


    /**
     * 取出商品的编辑数据
     * @param $data
     * @param $id
     * @param $info
     */
    public static function data_of_edit($data, $id, $info)
    {
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
//        dump($allAttrId->toArray());
//        $allAttr = [];
//        foreach ($allAttrId->toArray() as $k => $v) {
//            $allAttr[$k]['attr_id'] = -1;
//            $allAttr[$k]['attr_name'] = '####';
//            $allAttr[$k]['attr_type'] = '####';
//            $allAttr[$k]['attr_option_values'] = '####';
//
//        }
        $data['gaData'] = array_merge($gaData, $allAttrId->toArray());
        //商品相册
        $data['gpDatas'] = GoodsPic::where(array('goods_id' => $id))->get();
        return $data;
    }

    /**
     * 首页搜索条件组装
     * @param $searchAll
     * @return mixed
     */
    public function search_map($searchAll)
    {
        if (count($searchAll)) {
            $map = [];
            if ($searchAll['goods_start_price'] && $searchAll['goods_end_price']) {
                $map['shop_price'] = array(
                    'way' => 'between',
                    'op' => '',
                    'value' => array(
                        $searchAll['goods_start_price'],
                        $searchAll['goods_end_price'],
                    )
                );
            } else if ($searchAll['goods_start_price']) {
                $map['shop_price'] = array(
                    'way' => 'and',
                    'op' => '>=',
                    'value' => $searchAll['goods_start_price']
                );
            } else if ($searchAll['goods_end_price']) {
                $map['shop_price'] = array(
                    'way' => 'and',
                    'op' => '<=',
                    'value' => $searchAll['goods_end_price']
                );
            }
            if ($searchAll['promote_start_time'] && $searchAll['promote_end_time']) {
                $map['addtime'] = array(
                    'way' => 'between',
                    'op' => '',
                    'value' => array(
                        strtotime($searchAll['goods_start_price']),
                        strtotime($searchAll['goods_end_price']),
                    )
                );
            } else if ($searchAll['promote_start_time']) {
                $map['addtime'] = array(
                    'way' => 'and',
                    'op' => '>=',
                    'value' => strtotime($searchAll['promote_start_time'])
                );
            } else if ($searchAll['promote_end_time']) {
                $map['addtime'] = array(
                    'way' => 'and',
                    'op' => '<=',
                    'value' => strtotime($searchAll['promote_end_time'])
                );
            }
            unset($searchAll['goods_start_price']);
            unset($searchAll['goods_end_price']);
            unset($searchAll['promote_start_time']);
            unset($searchAll['promote_end_time']);
            unset($searchAll['odby']);
            foreach ($searchAll as $k => $v) {
                //将单选按钮所有提取出
                if (strpos($k, 'is_')) {
                    $map[$k] = array(
                        'way' => 'and',
                        'op' => '=',
                        'value' => $searchAll[$k]
                    );
                } else {
                    $map[$k] = '%' . $v . '%';
                }
            }
            return $map;
        }
        return [];
    }

    /**
     * 在商品插入前操作
     * @param $request
     * @param null $fields
     * @return array
     * @internal param $fields
     * @internal param $field
     */
    public function before_insert($request, $fields = null)
    {
        //将时间转化为时间戳
        $data = $request->all();
        //如果促销价选中
        if (isset($data['is_promote'])) {
            if ($data['promote_start_time']) $data['promote_start_time'] = strtotime($data['promote_start_time']);
            else unset($fields['promote_start_time']);
            if ($data['promote_end_time']) $data['promote_end_time'] = strtotime($data['promote_end_time']);
            else unset($fields['promote_end_time']);
        } else {
            unset($fields['is_promote']);
            unset($fields['promote_price']);
            unset($fields['promote_start_time']);
            unset($fields['promote_end_time']);
        }
        if (!isset($data['goods_desc'])) unset($fields['goods_desc']);
        unset($fields['logo']);
        unset($fields['sm_logo']);
        $data['addtime'] = time();
        return array(
            'data' => $data,
            'fields' => $fields
        );
    }

    /**
     * 插入后及其处理
     * @param $request
     * @param $model
     * @param $tmp_request
     * @return array
     */
    public function after_insert($request, $model, $tmp_request)
    {
        /***事务操作********************************/
        DB::beginTransaction();
        /***基本商品数据***/
        $res = $model->save();
        if (!$res) {
            DB::rollback();
            return false;
        }
        $goods_id = $model->id;
        $correct = true;
        /***处理商品扩展分类***/
        if (isset($request["ext_cat_id"])) {
            $eci = $request["ext_cat_id"];
            foreach ($eci as $v) {
                //如果分类为空则跳过
                $gcModel = new GoodsCat();
                if (empty($v)) continue;
                $gcModel->goods_id = $goods_id;
                $gcModel->cat_id = $v;
                //判断插入出错
                if (!$correct) {
                    $correct = false;
                    break;
                }
                $correct = $gcModel->save();
            }
        }
//        dump($request);
        /************处理会员价格***********/
        if (isset($request['mp'])) {
            $mp = $request['mp'];
            if ($mp) {
                foreach ($mp as $k => $v) {
                    $mpModel = new MemberPrice();
                    if (empty($v)) continue;
                    $mpModel->goods_id = $goods_id;
                    $mpModel->level_id = $k;
                    $mpModel->price = $v;
                    if (!$correct) {
                        $correct = false;
                        break;
                    }
                    $mpModel->save();
                }
            }
        }
        /*********处理商品属性的数据********/
        if (isset($request['ga'])) {
            $ga = $request['ga'];
            $ap = $request['attr_price'];
            if ($ga) {
                foreach ($ga as $k => $v) {
                    foreach ($v as $k1 => $v1) {
                        $gaModel = new GoodsAttr();
                        if (empty($v1)) continue;
                        $gaModel->goods_id = $goods_id;
                        $gaModel->attr_id = $k;
                        $gaModel->attr_value = $v1;
                        $gaModel->attr_price = $ap[$k][$k1];
                        if (!$correct) {
                            $correct = false;
                            break;
                        }
                        $correct = $gaModel->save();
                    }
                }
            }
        }
        /***********处理商品相册***********/
        if (count($tmp_request->file('pics'))) {
            //批量上传之后的图片数组，改造成每个图片一个一维数组的形式
            $pics = array();
            foreach ($_FILES['pics']['name'] as $k => $v) {
                if ($_FILES['pics']['size'][$k] == 0) continue;
                $pics[] = array(
                    'name' => $v,
                    'type' => $_FILES['pics']['type'][$k],
                    'tmp_name' => $_FILES['pics']['tmp_name'][$k],
                    'error' => $_FILES['pics']['error'][$k],
                    'size' => $_FILES['pics']['size'][$k],
                );
            }
            //存储图片
            foreach ($pics as $k => $v) {
                $gpModel = new GoodsPic();
                $file_path = 'Uploads/good_pics/';
                $file_name = md5(time() . $v['tmp_name']) . '.' . pathinfo($v['name'], PATHINFO_EXTENSION);
                $img = Image::make($v['tmp_name'])->save($file_path . $file_name);
                $thumb_img = Image::make($v['tmp_name'])->resize(150, 150)->save($file_path . 'thumb_' . $file_name);
                if (!$correct) {
                    $correct = false;
                    break;
                }
                $gpModel->goods_id = $goods_id;
                $gpModel->pic = $file_path . $file_name;
                $gpModel->sm_pic = $file_path . 'thumb_' . $file_name;
                $correct = $gpModel->save();
            }
        }
        if (!$correct) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return [true];
    }


    /**
     * 在商品插入前操作
     * @param $request
     * @param null $fields
     * @return array
     * @internal param $fields
     * @internal param $field
     */
    public function before_update($request, $fields = null)
    {
        //将时间转化为时间戳
        $data = $request->all();
        //如果促销价选中
        if (isset($data['is_promote'])) {
            $data['promote_start_time'] = strtotime($data['promote_start_time']);
            $data['promote_end_time'] = strtotime($data['promote_end_time']);
        }
        unset($fields['logo']);
        unset($fields['sm_logo']);
        unset($fields['addtime']);
        return array(
            'data' => $data,
            'fields' => $fields
        );
    }

    /**
     * @param $request
     * @param $id
     * @param $model
     * @param PicRepository $picRepository
     * @return array
     */
    public function after_update($request, $id, $model, PicRepository $picRepository)
    {
        $data = $request->toArray();
        /***事务操作********************************/
        try {
            DB::beginTransaction();
            $goods_id = $id;
            $correct = true;
            /***处理商品扩展分类***/
            $correct = GoodsCat::where(['goods_id' => $goods_id])->delete();  //先删除原来的
            if (isset($data["ext_cat_id"])) {
                $eci = $data["ext_cat_id"];
                foreach ($eci as $v) {
                    //判断插入出错
                    if (!$correct) {
                        $correct = false;
                        break;
                    }
                    //如果分类为空则跳过
                    $gcModel = new GoodsCat();
                    if (empty($v)) continue;
                    $gcModel->goods_id = $goods_id;
                    $gcModel->cat_id = $v;
                    $correct = $gcModel->save();
                }
            }
            /**处理商品图片**/
            if (strlen($_FILES['logo']['name'])) {
                $picRes = $picRepository->uploadFileOfImg($_FILES, 'logo', 'good', ['size' => [150, 150]]);
                if (is_file($model->logo)) {
                    @unlink($model->logo);
                    @unlink($model->sm_logo);
                }
            } else $picRes = [];
            /************处理会员价格***********/
            $correct = MemberPrice::where(['goods_id' => $goods_id])->delete();  //先删除原来的
            if (isset($request['mp'])) {
                $mp = $request['mp'];
                if ($mp) {
                    foreach ($mp as $k => $v) {
                        $mpModel = new MemberPrice();
                        if (empty($v)) continue;
                        $mpModel->goods_id = $goods_id;
                        $mpModel->level_id = $k;
                        $mpModel->price = $v;
                        if (!$correct) {
                            $correct = false;
                            break;
                        }
                        $mpModel->save();
                    }
                }
            }
            /*********处理商品属性的数据********/
            GoodsAttr::where(['goods_id' => $goods_id])->delete();  //先删除原来的
            if (isset($request['ga'])) {
                $ga = $request['ga'];
                $ap = $request['attr_price'];
                if ($ga) {
                    foreach ($ga as $k => $v) {
                        foreach ($v as $k1 => $v1) {
                            $gaModel = new GoodsAttr();
                            if (empty($v1)) continue;
                            $gaModel->goods_id = $goods_id;
                            $gaModel->attr_id = $k;
                            $gaModel->attr_value = $v1;
                            $gaModel->attr_price = $ap[$k][$k1];
                            if (!$correct) {
                                $correct = false;
                                break;
                            }
                            $correct = $gaModel->save();
                        }
                    }
                }
            }

            if (!$correct) {
                DB::rollback();
                return [];
            }
            DB::commit();
            return [
                'picRes' => $picRes
            ];
        } catch (Exception $e) {
            DB::rollback();
            return [];
        }
    }

}
