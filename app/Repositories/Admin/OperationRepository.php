<?php

namespace App\Repositories\Admin;


use App\Models\OrdersOperation;
use DaveJamesMiller\Breadcrumbs\Exception;
use Illuminate\Support\Facades\DB;

class OperationRepository
{
    protected $model;

    function __construct()
    {
        $this->model = new OrdersOperation();
    }

    public function model()
    {
        return $this->model;
    }

    /**
     * @param $data
     * @param $mode
     * @return bool
     */
    public function updateOperation($data, $mode)
    {
        try {
            DB::beginTransaction();
            $res = OrdersOperation::create($data);
            $res->order()->update([$mode => $data[$mode]]);  //更新状态
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollback();
            return false;
        }
    }
}