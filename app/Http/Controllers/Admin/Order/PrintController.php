<?php

namespace App\Http\Controllers\Admin\Order;


use App\Repositories\Admin\OperationRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PrintController extends Controller
{

    protected $print;

    public function __construct(OperationRepository $print)
    {
        $this->print = $print;
    }

    /**
     * 订单状态修改操作
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return view('admin.order.print.index');
    }

}
