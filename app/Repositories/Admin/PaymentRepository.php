<?php

namespace App\Repositories\Admin;


use App\Models\Payment;

class PaymentRepository
{
    protected $model;

    function __construct()
    {
        $this->model = new Payment();
    }

    public function model()
    {
        return $this->model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function returnById($id)
    {
        return Payment::find(intval($id));
    }

    public function returnAllPayments()
    {
        return Payment::all();
    }

    public function save($model)
    {
        return $model->save();
    }

}