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
        return view('packages.webUpload.index');
    }

    /**
     * 接收上传文件
     */
    public function up()
    {
        return response()->json(array($_FILES));

    }
}
