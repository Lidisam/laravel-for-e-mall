<?php

namespace App;

use App\Models\UserAddress;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function userAddresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }


    /**
     * 当前用户的收获地址
     * @return mixed
     */
    public function currentUserAddress()
    {
        return $this->userAddresses()->where(['is_selected' => 1])->first();
    }
}
