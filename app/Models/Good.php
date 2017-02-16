<?php

namespace App\Models;

use App\Repositories\PicRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class Good extends Model
{

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
}
