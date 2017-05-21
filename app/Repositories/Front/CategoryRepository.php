<?php

namespace App\Repositories\Front;


use App\Models\Brand;
use App\Models\Categorys;

class CategoryRepository
{

    /**
     * 返回所有分类
     */
    public function returnAllCats()
    {
        return Categorys::where('parent_id', 0)->orderBy('order_weight')->get();
    }

    public function returnById($id)
    {
        return Categorys::find($id);
    }

    public function returnAllBrands()
    {
        return Brand::all();
    }

    /**
     * @desc 获取数据列表
     * @param $conditions
     * @param $pageSize
     * @param $page
     * @param $cat_id
     * @return mixed
     */
    public function returnProductList($conditions, $pageSize, $page, $cat_id)
    {
        if ($conditions['brand_id'] != '') {
            $data = Good::where(['cat_id' => $cat_id, 'brand_id' => $conditions['brand_id'], 'is_on_sale' => '1'])
                ->orderBy('shop_price', $conditions['shop_price'])
                ->orderBy('sale_volume', $conditions['sale_volume'])
                ->skip($pageSize * $page)->take($pageSize)
                ->get();
        } else {   //不选择品牌情况下
            $data = Good::where(['cat_id' => $cat_id, 'is_on_sale' => '1'])
                ->orderBy('shop_price', $conditions['shop_price'])
                ->orderBy('sale_volume', $conditions['sale_volume'])
                ->skip($pageSize * $page)->take($pageSize)
                ->get();
        }
        return $data;
    }
}

