<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WebUploadController extends Controller
{
    public function index()
    {
        $data = [];
        return view('packages.webUpload.index', $data);
    }


    /**
     * 接收上传文件
     */
    public function up()
    {
        return response()->json(array($_FILES));

    }
}
