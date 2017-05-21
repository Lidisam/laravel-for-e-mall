<?php

namespace App\Repositories\Front;


use App\Models\Good;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartRepository
{
    /**
     * 修改商品(购物车)
     * @param Request $request
     * @param int|string $mode ''或  '-'即加1或减1
     * @param array $options 额外可选属性 'options' => ['size' => 'large']
     * @return
     */
    public function cartToggleSigle(Request $request, $mode = '', array $options = [])
    {
        $goods = Good::find((int)$request->get('id'));   //直接从商品中查出is_promote和promote_price
        $promote = [
            'is_promote' => $goods->is_promote,
            'promote_price' => $goods->promote_price,
            'jifen' => $goods->jifen,
            'jyz' => $goods->jyz
        ];
        if (!count($options)) {
            return Cart::add((int)$request->get('id'), $goods->goods_name, intval($mode . (1)), $goods->shop_price);
        }
        return Cart::add((int)$request->get('id'), $goods->goods_name, intval($mode . (1)), $goods->shop_price,
            array_merge($options, $promote));
    }

    /**
     * @param $rowId
     * @param array $options
     */
    public function cartUpdate($rowId, array $options)
    {
        return Cart::update($rowId, $options); // Will update the quantity
    }

    public function cartRemove($rowId)
    {
        return Cart::remove($rowId);
    }


}

