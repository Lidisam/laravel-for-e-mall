<?php

namespace App\Http\Controllers\Admin\Order;


use App\Repositories\Admin\OperationRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{

    protected $op;

    public function __construct(OperationRepository $operationRepository)
    {
        $this->op = $operationRepository;
    }

    /**
     * 订单状态修改操作
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $data['admin_id'] = Auth::user()->id;
        $mode = $data['mode'];
        unset($data['mode']);
        return response()->json($this->op->updateOperation($data, $mode));
    }

}
