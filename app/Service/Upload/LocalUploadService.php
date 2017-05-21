<?php
/**
 * *本地*文件上传接口类
 */
namespace App\Service\Upload;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class LocalUploadService implements UploadService
{
    //过滤类型、文件类型、上传描述
    private $filter_type;
    private $upload_type;
    private $upload_desc;
    private $upload_size;

    function __construct()
    {
        //默认均为图片类型
        $this->filter_type = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
        $this->upload_type = 0;
        $this->upload_desc = '图片';
        $this->upload_size = null;
    }

    /**
     * 插入图片
     * @param Request $request [上传req]
     * @param $reqFileName [上传文件名]
     * @param $prefixPath [目录前缀]
     * @param array|null $size [图片尺寸 下标0，1]
     * @param int $quality [图片质量]
     * @return mixed
     */
    public function create(Request $request, $reqFileName, $prefixPath, $size = [], $quality = 60)
    {
        if ($request->hasFile($reqFileName)) {
            if ($request->file($reqFileName)->isValid()) {
                //构建文件上传目录
                $destPath = 'Uploads/' . $prefixPath . '/';
                $savePath = $destPath . '' . date('Y-m-d', time());
                is_dir($savePath) || true;  //如果不存在则创建目录
                $uniqid = uniqid() . '_' . date('s');
                $file = $request->file($reqFileName);
                $ext = $file->getClientOriginalExtension();
                //文件上传类型
                $check_ext = in_array($ext, $this->filter_type, true);
                if ($check_ext) {
                    $fileName = $uniqid . 'o.' . $ext;
                    //判断是否上传的是缩略图
                    if (count($size)) {
                        $thumb_img = Image::make($file->getRealPath())->resize($size['0'], $size['1']);
                        $thumb_img_res = $thumb_img->save($savePath . '/' . $fileName, (int)$quality);
                    } else {
                        $thumb_img = Image::make($file->getRealPath());
                        $thumb_img_res = $thumb_img->save($savePath . '/' . $fileName);
                    }
                    //判断是否上传成功
                    if (strlen($thumb_img_res->filename)) {
                        return $this->msgStyle(true, $this->upload_desc . '上传成功', $savePath, $fileName);
                    }
                    unlink($savePath . '/' . $fileName);   //删除原先的文件
                    return $this->msgStyle(false, $this->upload_desc . '上传失败');
                } else {
                    return $this->msgStyle(false, $this->upload_desc . '上传类型不允许');
                }
            } else {
                return $this->msgStyle(false, $this->upload_desc . '上传出错');
            }
        }
        return $this->msgStyle(false, '上传文件不存在');
    }

    public function update(Request $request)
    {

    }

    /**
     *
     * @param $newFile
     * @param $oldFile
     * @return bool
     */
    public function delete($newFile, $oldFile)
    {
        if (file_exists($newFile)) {
            @unlink($oldFile);
            return true;
        }
        return false;
    }

    public function setFilter($filter_type)
    {
        $this->filter_type = $filter_type;
    }

    public function getFilter()
    {
        return $this->filter_type;
    }

    public function setUploadType($upload_type)
    {
        $this->upload_type = $upload_type;
    }

    public function getUploadType()
    {
        return $this->upload_type;
    }

    public function setUploadDesc($upload_desc)
    {
        $this->upload_desc = $upload_desc;
    }

    public function getUploadDesc()
    {
        return $this->upload_desc;
    }


    /**
     * 上传文件格式
     * @param $status [状态:true/false]
     * @param $msg [错误信息]
     * @param $savePath [保存文件目录]
     * @param $filePath [保存文件名]
     * @return array
     */
    public function msgStyle($status, $msg, $savePath = null, $filePath = null)
    {
        return array(
            'status' => $status,
            'msg' => $msg,
            'savePath' => $savePath,
            'path' => $filePath,

        );
    }

}