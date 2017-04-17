<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodOrder extends Model
{
    protected $table = 'good_order';
    protected $fillable = ['order_id', 'good_id'];

    protected $timestamp = false;
}
