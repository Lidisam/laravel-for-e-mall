<?php

namespace App\Repositories\Admin;


use App\Models\Attribute;
use App\Models\Type;

class AttributeRepository
{
    protected $model;
    function __construct()
    {
        $this->model = new Attribute();
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
        return Attribute::find(intval($id));
    }

    public function save($info)
    {
        return $info->save();

    }

    /**
     * @param $info
     * @return mixed
     */
    public function delete($info)
    {
        return $info->delete();
    }

    /**
     * 返回所有类型数据
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function returnAllTypes()
    {
        return Type::all();
    }



}