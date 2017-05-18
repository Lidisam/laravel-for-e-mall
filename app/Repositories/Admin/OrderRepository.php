<?php

namespace App\Repositories\Admin;


use App\Models\Order;
use App\Models\Payment;
use App\Models\UserAddress;

class OrderRepository
{
    protected $model;

    function __construct()
    {
        $this->model = new Order();
    }

    public function model()
    {
        return $this->model;
    }

    /**
     * @param $info
     * @param $fileRes
     */
    public function storeOrder($info, $fileRes)
    {
        $info->ad_logo = $fileRes['savePath'] . '/' . $fileRes['path'];
        $info->ad_sm_logo = $fileRes['savePath'] . '/thumb_' . $fileRes['path'];
        $info->save();   //保存
    }

    /**
     * @param $id
     * @return mixed
     */
    public function returnById($id)
    {
        return Order::find(intval($id));
    }


    public function saveOrder($info)
    {
        return $info->save();

    }

    public function returnAllPayments()
    {
        return Payment::all();
    }

    /**
     * @param $info
     * @return mixed
     */
    public function deleteOrder($info)
    {
        return $info->delete();
    }


    /**
     * 转换订单的数据
     * @param $data
     * @return mixed
     */
    public function transferOrders($data)
    {
        foreach ($data['data'] as $k => $v) {
            if ($v->pay_status == 0) {
                $data['data'][$k]['pay_status'] = '未付款';
            } elseif ($v->pay_status == 1) {
                $data['data'][$k]['pay_status'] = '已付款';
            }
        }
        return $data;
    }

    /**
     * 首页搜索条件组装
     * @param $searchAll
     * @return mixed
     */
    public function search_map($searchAll)
    {
        if (count($searchAll)) {
            $map = [];
            if ($searchAll['order_start_price'] && $searchAll['order_end_price']) {
                $map['real_price'] = array(
                    'way' => 'between',
                    'op' => '',
                    'value' => array(
                        $searchAll['order_start_price'],
                        $searchAll['order_end_price'],
                    )
                );
            } else if ($searchAll['order_start_price']) {
                $map['real_price'] = array(
                    'way' => 'and',
                    'op' => '>=',
                    'value' => $searchAll['order_start_price']
                );
            } else if ($searchAll['order_end_price']) {
                $map['real_price'] = array(
                    'way' => 'and',
                    'op' => '<=',
                    'value' => $searchAll['order_end_price']
                );
            }
            if ($searchAll['order_start_time'] && $searchAll['order_end_time']) {
                $map['created_at'] = array(
                    'way' => 'between',
                    'op' => '',
                    'value' => array(
                        $searchAll['order_start_time'],
                        $searchAll['order_end_time'],
                    )
                );
            } else if ($searchAll['order_start_time']) {
                $map['created_at'] = array(
                    'way' => 'and',
                    'op' => '>=',
                    'value' => $searchAll['order_start_time']
                );
            } else if ($searchAll['order_end_time']) {
                $map['created_at'] = array(
                    'way' => 'and',
                    'op' => '<=',
                    'value' => $searchAll['order_end_time']
                );
            }
            unset($searchAll['order_start_price']);
            unset($searchAll['order_end_price']);
            unset($searchAll['order_start_time']);
            unset($searchAll['order_end_time']);
            foreach ($searchAll as $k => $v) {
                //将单选按钮所有提取出
                if (strpos($k, 'is_')) {
                    $map[$k] = array(
                        'way' => 'and',
                        'op' => '=',
                        'value' => $searchAll[$k]
                    );
                } else {
                    $map[$k] = '%' . $v . '%';
                }
            }
            return $map;
        }
        return [];
    }

}