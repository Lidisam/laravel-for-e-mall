<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    /**
     * 购物车首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param $product_id
     */
    public function index()
    {

//        dump(Auth::guard('client')->user()->mobile);
        return view('front.cart');
    }

    public function logout()
    {
        Auth::guard('client')->logout();
    }
}
