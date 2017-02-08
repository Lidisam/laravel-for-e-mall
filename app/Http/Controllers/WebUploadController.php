<?php

namespace App\Http\Controllers;

use App\Models\Categorys;
use Illuminate\Http\Request;

use App\Http\Requests;
use stdClass;

class WebUploadController extends Controller
{
    public function index()
    {

        $model = new Categorys();
        dump($model->all());


        $arr = $model->sortOut($model->all()->toArray());
        $obj = [];
        foreach ($arr as $key => $value) {
            $obj[] = (object)$value;
        }
        dump($obj);
        dump($obj['0']->cat_name);
        dd('---');
    }

    /**
     * 接收上传文件
     */
    public function up()
    {
        return response()->json(array($_FILES));

    }
}
