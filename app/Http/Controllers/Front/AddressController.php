<?php

namespace App\Http\Controllers\Front;

use App\Repositories\Front\AddressRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    protected $addressRepository;
    function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
        $this->checkAuth();  //检查是否登录了
    }
    /**
     * 收获地址列表
     */
    public function index()
    {
        if (!Auth::guard('client')->check())
            return redirect('user/login')->withErrors('请登录');
        $user_address = $this->addressRepository->returnAddressBy();

        return view('front.address.index',compact('user_address'));
    }

    /**
     * 编辑收获地址
     * @param $address_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($address_id)
    {
        $user_address = $this->addressRepository->returnAddressById($address_id);
        return view('front.address.edit',compact('user_address'));
    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $this->addressRepository->updateAddress($request);
        return redirect('/address');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('front.address.create');
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->addressRepository->createAddress($request);
        return redirect('/address');
    }

    /**
     * 选择默认收货信息
     * @param Request $request
     * @return bool
     */
    public function select(Request $request)
    {
        $res = $this->addressRepository->toggleSelected(intval($request->get("addressId")));
        return response()->json($res);
    }

}
