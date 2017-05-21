<?php

namespace App\Repositories\Front;


use App\Models\Good;
use App\Models\GoodOrder;
use App\Models\Order;
use App\Models\Payment;
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
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function createOrder(Request $request)
    {
        if (!count(Cart::content())) return false;  //购物车为空
        /**
         * 循环遍历统计是否促销并且如果促销改成促销价
         */
        $total_price = 0;
        foreach (Cart::content() as $k => $v) {
            $total_price += ($v->options->is_promote ? (float)$v->options->promote_price : $v->price) * $v->qty;
        }

        try {
            DB::beginTransaction();
            $user = Auth::guard('client')->user();
            $discount = ($user->level_id != 0) ? $user->level()->first()->rate / 100 : 1;
            //创建订单
            $order = Order::create([
                'user_id' => $user->id,
                'order_num' => date('YmdHis', time()) . $user->id,
                'consigner' => $user->name,
                'total_price' => $total_price,
                'real_price' => $total_price * $discount,
                'user_desc' => $request->get('user_desc'),
                'pay_way_name' => $request->get('pay_way_name'),
                'pay_way_id' => $request->get('pay_way_id'),
                'user_address_id' => $user->currentUserAddress()->id
            ]);
            $order_id = $order->id;
            $good_orders = [];   //当前订单所有id
            $counter = 0;
            //从cart中取出商品id,然后查看是否促销，如果促销则该上面创建的xx?x:x;  减少库存，写入排它锁
            foreach (Cart::content() as $k => $v) {
                $goods = Good::find($v->id);
                $good_orders[$counter]['good_id'] = $v->id;
                $good_orders[$counter]['is_promote'] = $goods->is_promote;
                $good_orders[$counter]['total_price'] = ($goods->is_promote ? ((float)$goods->promote_price) : $v->price) * $v->qty;
                $good_orders[$counter]['num'] = $v->qty;   //数量
                $good_orders[$counter++]['order_id'] = $order_id;
                $goods->decrement('goods_quantity', (int)$v->qty);  //减少商品数量
                $goods->increment('sale_volume', (int)$v->qty);  //增加商品销量
                $goods->increment('jifen', (int)$v->options->jifen);  //增加积分
                $goods->increment('jyz', (int)$v->options->jyz);  //增加经验值
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

