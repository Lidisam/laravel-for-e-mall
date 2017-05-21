<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Front\UserRepository;
use DaveJamesMiller\Breadcrumbs\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $user;

    protected $redirectTo = '/';
    protected $guard = 'client';

    function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }


    /**
     * 用户首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::guard('client')->user();

        return view('front.user.index', compact('user'));
    }


    /**
     * 个人订单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order_list()
    {
        $user = Auth::guard('client')->user();
        $wait_pay_orders = $this->user->returnOrderMsgs($user->id, ['deliver_status' => 0]);
        $wait_delivery_orders = $this->user->returnOrderMsgs($user->id, ['deliver_status' => 1]);
        $achieved_orders = $this->user->returnOrderMsgs($user->id, ['order_status' => 1]);

        return view('front.user.order_list', compact('wait_pay_orders', 'wait_delivery_orders', 'achieved_orders'));
    }

    /**
     * 取消订单(视图及操作)
     * @param Request $request
     * @param $order_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function abolish_order(Request $request, $order_id)
    {
        if (!Auth::guard('client')->check()) return redirect()->route('front.auth.login')->withErrors('请登录');
        $order = $this->user->returnOrderById($order_id);
        if ($request->isMethod('post')) {  //提交数据

            $user = Auth::guard('client')->user();
            if ($user->id == $order->user_id) {
                try {
                    $this->user->delOrderByInfo($order, $request->get('reason'));
                    return redirect()->route('front.user.order_list')->withSuccess('订单取消成功');
                } catch (Exception $e) {
                    return back()->withErrors('订单取消失败');
                }
            }
            return back()->withErrors('抱歉，用户不存在该订单');
        }
        return view('front.user.abolish_order', compact('order'));
    }


    /**
     * 常购清单
     * @return \Illuminate\Http\RedirectResponse
     */
    public function favorite()
    {
        $auth = Auth::guard('client');
        if (!$auth->check()) return redirect()->route('front.auth.login')->withErrors('请登录');
        $data = $this->user->returnOrderMsgs($auth->user()->id, ['order_status' => 1]);

        return view('front.user.favorite', compact('data'));
    }


    /**
     * 个人资料
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profile()
    {
        $auth = Auth::guard('client');
        if (!$auth->check()) return redirect()->route('front.auth.login')->withErrors('请登录');
        $name = $auth->user()->name;

        return view('front.user.profile', compact('name'));
    }

    /**
     * 修改个人用户名
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change_name(Request $request)
    {
        $auth = Auth::guard('client');
        if (!$auth->check()) return redirect()->route('front.auth.login')->withErrors('请登录');
        if ($request->isMethod('post')) {
            try {
                $this->user->updateName($auth->user(), $request->get('name'));
                return back()->withSuccess('修改成功');
            } catch (\Exception $exception) {
                return back()->withErrors('修改失败');
            }
        }
        return view('front.user.change_name');
    }

    /**
     * 设置
     * @return \Illuminate\Http\RedirectResponse
     */
    public function user_set()
    {
        if (!Auth::guard('client')->check()) return redirect()->route('front.auth.login')->withErrors('请登录');
        return view('front.user.user_set');
    }

    /**
     * 修改密码
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change_pwd()
    {
        if (!Auth::guard('client')->check()) return redirect()->route('front.auth.login')->withErrors('请登录');
        return view('front.user.change_pwd');
    }

    /**
     * 文章
     * @return \Illuminate\Http\RedirectResponse
     */
    public function article()
    {
        if (!Auth::guard('client')->check()) return redirect()->route('front.auth.login')->withErrors('请登录');
        return view('front.user.article');
    }

    /**
     * 登出
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        if (!Auth::guard('client')->check()) return redirect()->route('front.auth.login')->withErrors('请登录');
        return redirect('/user/login')->withSuccess('安全退出成功');
    }


}