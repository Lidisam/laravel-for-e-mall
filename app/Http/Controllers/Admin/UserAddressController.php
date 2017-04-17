<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserAddress;
use App\Http\Controllers\Controller;

class UserAddressController extends Controller
{


    /**
     * @param $user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @internal param Request $request
     */
    public function index($user_id)
    {
        $data['datas'] = UserAddress::where(['user_id' => $user_id])->get();
        $data['user_id'] = $user_id;

        return view('admin.user_address.index', $data);
    }

}
