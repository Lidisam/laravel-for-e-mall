<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Good extends Model
{
    /**
     * 在商品插入前操作
     * @param $request
     * @param null $fields
     * @return array
     * @internal param $fields
     * @internal param $field
     */
    public function before_insert($request,$fields = null) {
        //将时间转化为时间戳
        $data = $request->all();
        //如果促销价选中
        if(isset($data['is_promote'])) {
            if ($data['promote_start_time']) $data['promote_start_time'] = strtotime($data['promote_start_time']);
            else unset($fields['promote_start_time']);
            if ($data['promote_end_time']) $data['promote_end_time'] = strtotime($data['promote_end_time']);
            else unset($fields['promote_end_time']);
        }else{
            unset($fields['is_promote']);
            unset($fields['promote_price']);
            unset($fields['promote_start_time']);
            unset($fields['promote_end_time']);
        }
        if(!isset($data['goods_desc'])) unset($fields['goods_desc']);
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
     * @return array
     */
    public function after_insert($request, $model) {
        /***事务操作***/
        DB::beginTransaction();
        /***基本商品数据***/
        $res = $model->save();
        if(!$res){
            DB::rollback();
            return false;
        }
        $goods_id = $model->id;
        /***处理商品扩展分类***/
        if(isset($request["ext_cat_id"])) {
            $eci = $request["ext_cat_id"];
            $gcModel = new GoodsCategory();
            foreach ($eci as $v) {
                //如果分类为空则跳过
                if (empty($v)) continue;
                $gcModel->add(array(
                    'goods_id' => $goods_id,
                    'cat_id' => $v
                ));
            }
        }

        DB::commit();
        return [true];
    }
}
