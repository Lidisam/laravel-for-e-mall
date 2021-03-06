<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_num', 'consigner', 'total_price', 'real_price',
        'pay_status', 'user_desc', 'pay_way_name', 'pay_way_id', 'user_address_id',
        'is_del', 'deliver_status', 'del_msg', 'is_promote', 'order_status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function goods()
    {
        return $this->belongsToMany(Good::class, 'good_order', 'order_id', 'good_id')
            ->withPivot('num', 'is_promote', 'total_price');
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class, 'id', 'user_address_id');
    }

    public function orders_operations()
    {
        return $this->hasMany(OrdersOperation::class, 'order_id', 'id');
    }


}
