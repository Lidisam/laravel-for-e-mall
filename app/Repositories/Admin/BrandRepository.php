<?php

namespace App\Repositories\Admin;




use App\Models\Brand;

class BrandRepository
{
    protected $model;
    function __construct()
    {
        $this->model = new Brand();
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
        return Brand::find(intval($id));
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


}