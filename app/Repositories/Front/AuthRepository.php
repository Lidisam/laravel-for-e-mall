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

    /**
     * @param $user
     * @param $new_password
     * @return mixed
     */
    public function resetPwd($user, $new_password)
    {
        return $user->update(['password' => bcrypt($new_password)]);
    }
}

