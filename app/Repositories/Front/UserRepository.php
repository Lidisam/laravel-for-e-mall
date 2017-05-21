<?php

namespace App\Repositories\Front;


use App\Models\Order;
use Mews\Purifier\Facades\Purifier;

class UserRepository
{
    /**
     * 获取各状态的订单信息
     * @param $user_id
     * @param array $other_where
     * @return mixed
     */
    public function returnOrderMsgs($user_id, $other_where = [])
    {
        $where = array_merge(['user_id' => $user_id, 'is_del' => 0], $other_where);

        $order_ids = Order::where($where)->pluck('id');
        $orders = Order::where($where)->get();
        foreach ($orders as $k => $v) {
            $orders[$k]['goods'] = Order::find($order_ids[$k])->goods()->get();
        }
        return $orders;
    }


    public function returnOrderById($id)
    {
        return Order::find((int)$id);
    }


    /**
     * @param $info
     * @param $reason
     * @return mixed
     */
    public function delOrderByInfo($info, $reason)
    {
        return $info->update(['is_del' => 1, 'del_msg' => Purifier::clean($reason)]);
    }

    /**
     * @param $user
     * @param $name
     * @return mixed
     */
    public function updateName($user, $name)
    {
        return $user->update(['name' => $name]);
    }
}




