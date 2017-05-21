<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string cat_logo
 * @property string cat_pic
 */
class Categorys extends Model
{


    public function goods() {
        return $this->hasMany(Good::class, 'cat_id', 'id');
    }

    /**
     * 商品类别无限极分类,返回数组形式
     * @param $cate
     * @param int $pid
     * @param int $level
     * @param string $html
     * @return array
     */
    public function sortOut($cate, $pid = 0, $level = 0, $html = '--')
    {
        $tree = array();
        foreach ($cate as $v) {
            if ($v['parent_id'] == $pid) {
                $v['parent_id'] = $level + 1;
                $v['cat_name'] = str_repeat($html, $level) . $v['cat_name'];    //--- 分类名
                $tree[] = $v;
                $tree = array_merge($tree, self::sortOut($cate, $v['id'], $level + 1, $html));
            }
        }
        return $tree;
    }

    /**
     * 将数组转为laravel中的collections数据格式
     * @param $arr
     * @return array [collections]
     */
    public function changeObj($arr)
    {
        $obj = [];
        foreach ($arr as $key => $value) {
            $obj[] = (object)$value;
        }
        return $obj;
    }


}
