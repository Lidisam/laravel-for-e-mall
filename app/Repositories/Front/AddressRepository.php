<?php

namespace App\Repositories\Front;


use App\Models\UserAddress;
use DaveJamesMiller\Breadcrumbs\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressRepository
{

    protected $fields = [
        'name' => '',
        'mobile' => '',
        'province' => '',
        'city' => '',
        'county' => '',
        'address' => '',
        'other' => '',
    ];
    /**
     * 获取单个用户收货地址
     * @return mixed
     */
    public function returnAddressBy() {
        return Auth::guard('client')->user()->userAddresses()->get();
    }

    /**
     * 获取指定id的地址
     * @param $address_id
     * @return
     */
    public function returnAddressById($address_id)
    {
        return UserAddress::find($address_id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function updateAddress($request)
    {
        $userAddress = UserAddress::find(intval($request->get('id')));
        foreach (array_keys($this->fields) as $field) {
            $userAddress->$field = $request->get($field);
        }

        return $userAddress->save();
    }

    /**
     * 添加收获地址
     * @param $request
     * @return bool
     */
    public function createAddress($request)
    {
        $userAddress = new UserAddress();
        foreach (array_keys($this->fields) as $field) {
            $userAddress->$field = $request->get($field);
        }
        $userAddress->user_id = Auth::guard('client')->user()->id;

        return $userAddress->save();
    }

    /**
     * @param $addressId
     * @return bool
     */
    public function toggleSelected($addressId)
    {
        try{
            DB::beginTransaction();
            $this->returnAddressById($addressId)->where(['is_selected'=>1])->update(['is_selected' => 0]);
            $this->returnAddressById($addressId)->update(['is_selected' => 1]);
            DB::commit();
            return true;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }


}

