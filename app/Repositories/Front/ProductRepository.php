<?php

namespace App\Repositories\Front;

use App\Models\Ad;
use App\Models\Good;

class ProductRepository
{
    /**
     * 返回商品详细信息
     * @param $product_id
     * @return mixed
     */
    public function returnProduct($product_id)
    {
        return Good::onSaled()->where(['id' => intval($product_id)])->first();
    }
}

