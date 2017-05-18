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

    function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
        $this->middleware(['auth:client']);
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
        $achieved_orders = $this->user->returnOrderMsgs($user->id, ['deliver_status' => 2]);

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function favorite()
    {
        return view('front.user.favorite');
    }


    /**
     * 个人资料
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return view('front.user.profile');
    }

    /**
     * 修改个人用户名
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function change_name()
    {
        return view('front.user.change_name');
    }

    /**
     * 设置
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user_set()
    {
        return view('front.user.user_set');
    }

    /**
     * 修改密码
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function change_pwd()
    {
        return view('front.user.change_pwd');
    }

    /**
     * 文章
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article()
    {
        return view('front.user.article');
    }

    /**
     * 登出
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout()
    {
        return redirect('/user/login')->withSuccess('安全退出成功');
    }


}