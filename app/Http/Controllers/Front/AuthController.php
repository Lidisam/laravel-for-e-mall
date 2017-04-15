<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Repositories\Front\AuthRepository;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authRepository;

    /**
     * AuthController constructor.
     * @param AuthRepository $authRepository
     */
    function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('front.auth.login');
    }

    /**
     *
     */
    public function postLogin()
    {
        $credentials = ['mobile' => request('mobile'), 'password' => request('password')];
        if (Auth::guard('client')->attempt($credentials)) {
            return redirect('/')->withSuccess('登陆成功');
        }
        return back()->withErrors('登录失败');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        return view('front.auth.register');
    }

    /**
     * @param RegisterRequest|Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegisterRequest $request)
    {
        $registerUserRes = $this->authRepository->registerUser($request);
        if ($registerUserRes) {
            return redirect('/user/login')->withSuccess('修改成功！');
        } else {
            return back()->withErrors('注册失败');
        }
    }
}
