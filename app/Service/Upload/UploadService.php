<?php
/**
 * 文件上传接口类
 */
namespace App\Service\Upload;

use Illuminate\Http\Request;

interface UploadService
{
    public function create(Request $request, $reqFileName, $prefixPath, $size = [], $quality = 60);

    public function update(Request $request);

    public function delete($newFile, $oldFile);
}