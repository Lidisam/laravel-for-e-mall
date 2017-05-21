<?php

namespace App\Repositories\Front;

use App\Models\Ad;
use App\Models\Categorys;
use App\Models\Good;

class IndexRepository
{
    /**
     * 返回热\推荐等销产品
     * @param $field
     * @return mixed
     */
    public function returnSpecialGoods($field)
    {
        return Good::where($field, '1')->where('is_on_sale', '1')->orderBy('id', 'desc')->get();
    }

    /**
     * 一次性返回热销、推荐、最新的产品
     */
    public function returnThirdGoods()
    {
        $goods = [];
        $goods['is_hot'] = $this->returnSpecialGoods('is_hot');
        $goods['is_new'] = $this->returnSpecialGoods('is_new');
        $goods['is_best'] = $this->returnSpecialGoods('is_best');
        return $goods;
    }

    /**
     *  获取广告
     */
    public function returnAds()
    {
        return Ad::where('is_open', '1')->limit(5)->orderBy('created_at', 'desc')->get();
    }

    /**
     * 获取四条信息在首页显示分类
     * @return mixed
     */
    public function returnCats()
    {
        return Categorys::where('parent_id',0)->take(3)->orderBy('id')->orderBy('order_weight')->get();
    }
}

