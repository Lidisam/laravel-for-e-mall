<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersOperation extends Model
{
    protected $guarded = [];
    protected $table = 'orders_operations';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function admin()
    {
        return $this->hasOne(AdminUser::class, 'id', 'admin_id');
    }

}
