<?php

namespace App\Http\Controllers\Front;

use App\Models\UserAddress;
use App\Http\Controllers\Controller;
use App\Repositories\Front\OrderRepository;
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
        $addressMessage = $this->orderRepository->returnAddressMesssage();

        return view('front.order.confirm_order', compact('addressMessage'));
    }


}

