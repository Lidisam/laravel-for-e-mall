<?php

namespace App\Http\Controllers\Admin\Set;


use App\Repositories\Admin\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{

    protected $pay;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->pay = $paymentRepository;
    }

    public function index()
    {
        $data = $this->pay->returnAllPayments();
        return view('admin.set.payment.index', compact('data'));
    }

    public function edit($pay_id)
    {
        $data = $this->pay->returnById($pay_id);
        $data['pay_config'] = json_decode($data['pay_config'], true);

        return view('admin.set.payment.edit', compact('data'));
    }

    /**
     * @param Request $request
     * @param $pay_id
     */
    public function store(Request $request, $pay_id)
    {
        $pay_desc = $request->get('pay_desc');
        $cgf = $request->get('cgf');

        $model = $this->pay->returnById($pay_id);
        $model->pay_desc = $pay_desc;
        $model->pay_config = json_encode($cgf);
        $this->pay->save($model);

        return redirect()->route('admin.set.payment.index')->withSuccess('修改成功');
    }
}
