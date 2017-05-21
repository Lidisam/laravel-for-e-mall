<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\Payment;
use App\Models\UserAddress;
use App\Http\Controllers\Controller;
use App\Repositories\Front\OrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    protected $orderRepository;

    function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        if (!Auth::guard('client')->check())
            return redirect('user/login')->withErrors('请登录');
        if (!count(Cart::content())) return back()->withErrors('购物车不能为空');  //购物车为空
        $addressMessage = $this->orderRepository->returnAddressMesssage();

        return view('front.order.confirm_order', compact('addressMessage'));
    }

    /**
     * 提交订单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Request $request)
    {
        $res = $this->orderRepository->createOrder($request);
        if ($res)
            return response()->json(true);
        return response()->json(false);
    }

    /**
     * 返回订单视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmRes()
    {
        $arr = $this->orderRepository->redirectConfirmView();
        return view('front.order.confirm', $arr);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function more_pay(Request $request)
    {
        $data = $this->orderRepository->returnAllPays();
        if ($request->isMethod('post')) {
            $pay_way = $request->get('pay_way');
            return redirect()->route('front.order.index')->with(['pay' => $pay_way]);
        }

        return view('front.order.more_pay', compact('data'));
    }


}

