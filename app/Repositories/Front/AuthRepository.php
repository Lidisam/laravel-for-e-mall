<?php

namespace App\Repositories\Front;


use App\User;

class AuthRepository
{
    /**
     * @param $request
     * @return User
     */
    public function registerUser($request)
    {
        return User::create([
            'mobile' => $request->get('mobile'),
            'password' => bcrypt($request->get('password'))
        ]);
    }
}

