<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_address';
    protected $fillable = ['is_selected','name','mobile','province','city','county'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
