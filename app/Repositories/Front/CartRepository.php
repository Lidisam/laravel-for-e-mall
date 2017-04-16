<?php

namespace App\Repositories\Front;


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
        if (!count($options)) {
            return Cart::add((int)$request->get('id'), $request->get('name'), intval($mode . (1)), $request->get('price'));
        }
        return Cart::add((int)$request->get('id'), $request->get('name'), intval($mode . (1)), $request->get('price'), $options);
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

