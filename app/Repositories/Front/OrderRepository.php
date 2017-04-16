<?php

namespace App\Repositories\Front;


use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    /**
     * 返回收货地址
     * @return mixed
     */
    public function returnAddressMesssage()
    {
        return Auth::guard('client')->user()->currentUserAddress();
    }
}

