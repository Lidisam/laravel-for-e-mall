<?php

namespace App\Http\Controllers\Front;

use App\Repositories\Front\CartRepository;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cartRepository;

    function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * 购物车首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param $product_id
     */
    public function index()
    {

        $cartDatas = Cart::content();
        $totalPrice = Cart::subtotal();

        return view('front.cart.index', compact('cartDatas', 'totalPrice'));
    }

    /**
     * ajax请求添加入购物车
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxAdd(Request $request)
    {
        //为购物车添加单个商品
        $this->cartRepository->cartToggleSigle($request, '',
            ['mark_price' => $request->get('mark_price'), 'img' => $request->get('img')]);

        return response()->json(true);
    }

    /**
     * 减少货物数量
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxUpdate(Request $request)
    {
        $this->cartRepository->cartUpdate($request->get('rowId'), [
            'qty' => $request->get('qty')
        ]);
        return response()->json(true);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxRemove(Request $request)
    {
        $this->cartRepository->cartRemove($request->get('rowId'));

        return response()->json(true);
    }
}
