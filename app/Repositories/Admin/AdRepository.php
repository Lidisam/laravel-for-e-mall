<?php

namespace App\Repositories\Admin;



use App\Models\Ad;

class AdRepository
{
    protected $model;
    function __construct()
    {
        $this->model = new Ad();
    }

    public function model()
    {
        return $this->model;
    }

    /**
     * @param $info
     * @param $fileRes
     */
    public function storeAd($info, $fileRes)
    {
        $info->ad_logo = $fileRes['savePath'] . '/' . $fileRes['path'];
        $info->ad_sm_logo = $fileRes['savePath'] . '/thumb_' . $fileRes['path'];
        $info->save();   //保存
    }

    /**
     * @param $id
     * @return mixed
     */
    public function returnById($id)
    {
        return Ad::find(intval($id));
    }

    public function saveAd($info)
    {
        return $info->save();

    }

    /**
     * @param $info
     * @return mixed
     */
    public function deleteAd($info)
    {
        return $info->delete();
    }


}