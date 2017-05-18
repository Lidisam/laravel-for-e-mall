<?php

namespace App\Repositories\Front;


use App\Models\GoodOrder;
use App\Models\Order;
use App\Models\Payment;
use App\Models\UserAddress;
use DaveJamesMiller\Breadcrumbs\Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed id
 */
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

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function returnAllPays()
    {
        return Payment::all();
    }

    /**
     * 创建订单
     * @param Request $request
     * @return bool
     */
    public function createOrder(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::guard('client')->user();
            $discount = ($user->level_id != 0) ? $user->level()->first()->rate / 100 : 1;
            //创建订单
            $order = Order::create([
                'user_id' => $user->id,
                'order_num' => date('YmdHis', time()) . $user->id,
                'consigner' => $user->name,
                'total_price' => Cart::subtotal(),
                'real_price' => Cart::subtotal() * $discount,
                'user_desc' => $request->get('user_desc'),
                'pay_way_name' => $request->get('pay_way_name'),
                'pay_way_id' => $request->get('pay_way_id'),
                'user_address_id' => $user->currentUserAddress()->id
            ]);
            $order_id = $order->id;
            $good_orders = [];   //当前订单所有id
            $counter = 0;
            foreach (Cart::content() as $k => $v) {
                $good_orders[$counter]['good_id'] = $v->id;
                $good_orders[$counter++]['order_id'] = $order_id;
            }
            GoodOrder::insert($good_orders);
            DB::commit();
            Cart::destroy();
            return true;
        } catch (Exception $exception) {
            DB::rollback();
            return false;
        }


    }

    /**
     * 返回订单成功视图
     */
    public function redirectConfirmView()
    {
        $arr = [];
        $user = Auth::guard('client')->user();
        $data = $user->orders()->latest()->first();
        $arr['order_num'] = $data['order_num'];
        $arr['id'] = $data['id'];
        $arr['real_price'] = $data['real_price'];
        $arr['created_at'] = $data['created_at'];
        if ($user->level()->first()) {
            $arr['discount'] = $user->level()->first()->rate / 10;  //订单默认普通会员
            $arr['level_name'] = $user->level()->first()->level_name;
        }
        return $arr;
    }
}

