<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Auth\RegisterRequest;
use App\Http\Requests\Front\Auth\ResetPwdRequest;
use Arcanedev\Support\Bases\Model;
use Illuminate\Http\Request;
use App\Repositories\Front\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            return redirect('/user/login')->withSuccess('注册成功！');
        } else {
            return back()->withErrors('注册失败');
        }
    }

    /**
     * 重新设置密码
     * @param ResetPwdRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postReSetPwd(ResetPwdRequest $request)
    {
        $auth = Auth::guard('client');
        $password = $auth->user()->password;
        if ($auth->check()) {
            $old_password = $request->get('old_password');
            $new_password = $request->get('new_password');
            if (Hash::check($old_password, $password)) {
                try {
                    $this->authRepository->resetPwd($auth->user(), $new_password);
                    Auth::guard('client')->attempt(['mobile' => $auth->user()->mobile, 'password' => $new_password]);
                    return back()->withSuccess('修改成功');
                } catch (\Exception $e) {
                    return back()->withSuccess('修改失败');
                }
            }
        }
        return redirect()->route('front.auth.login')->withErrors('请登录');
    }
}
