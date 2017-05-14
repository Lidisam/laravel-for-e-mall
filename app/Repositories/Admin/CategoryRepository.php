<?php

namespace App\Repositories\Admin;




use App\Models\Categorys;

class CategoryRepository
{
    protected $model;
    function __construct()
    {
        $this->model = new Categorys();
    }

    public function model()
    {
        return $this->model;
    }

    /**
     * @param $info
     * @param $fileRes
     */
    public function store($info, $fileRes)
    {
        $info->logo = $fileRes['savePath'] . $fileRes['path'];
        $info->save();   //保存
    }

    /**
     * @param $id
     * @return mixed
     */
    public function returnById($id)
    {
        return Categorys::find(intval($id));
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

    public function returnAllCats()
    {
        return Categorys::all()->toArray();
    }


}