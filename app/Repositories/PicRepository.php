<?php
/**
 * Created by PhpStorm.
 * User: 迪山
 * Date: 2016/4/30
 * Time: 19:22
 */

namespace App\Repositories;


class PicRepository
{
    /**
     * 文件上传
     * @param $request [请求]
     * @param $prefixPath [保存前缀目录]
     * @param $reqFileName [上传文件名]
     * @param null $fileExt [上传文件类型 default=null]
     * @return Controller|array|bool|\Illuminate\Http\RedirectResponse
     */
    public function uploadFile($request, $prefixPath, $reqFileName, $fileExt = null)
    {
        if ($request->hasFile($reqFileName)) {
            if ($request->file($reqFileName)->isValid()) {
                //
                $destPath = 'Uploads/' . $prefixPath . '/';
                $savePath = $destPath . '' . date('Y-m-d', time());
                is_dir($savePath) || true;  //如果不存在则创建目录
                $uniqid = uniqid() . '_' . date('s');
                $file = $request->file($reqFileName);
                $name = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                //文件上传类型
                if ($fileExt == null)
                    $fileExt = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
                $check_ext = in_array($ext, $fileExt, true);
                if ($check_ext) {
                    $fileName = $uniqid . 'o.' . $ext;
                    $res = $file->move($savePath, $fileName);
                    if (count($res)) {
                        return $this->msgStyle(true, '文件上传成功', $savePath, $fileName);
                    }
                    return $this->msgStyle(false, '文件上传失败');
                } else {
                    return $this->msgStyle(false, '文件上传类型不允许');
                }
            } else {
                return $this->msgStyle(false, '文件上传出错');
            }
        }
        return $this->msgStyle(false, '上传文件不存在');
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

    /**
     * 生成缩略图
     * data参数为：
     * $thumb_setting = array(
     * 'size' => array(
     * 'width' => 150,
     * 'height' => 150
     * ),
     * 'quality' => 60,
     * 'path' => $fileRes['savePath'] . '/' . $fileRes['path'],
     * 'thumb_path' => $fileRes['savePath'] . '/thumb_' . $fileRes['path']
     * );
     * @param array $data
     * @return array
     */
    public function makeThumb(array $data)
    {
        $thumb_img = Image::make($data['path'])->resize($data['size']['width'], $data['size']['height']);
        $thumb_img_res = $thumb_img->save($data['thumb_path'], $data['quality']);
        if (!strlen($thumb_img_res->filename)) {   //如果上传失败
            unlink($data['path']);   //删除原先的文件
            return $this->msgStyle(false, '文件上传失败');
        } else {
            return $this->msgStyle(true, '', $data['thumb_path']);
        }
    }
}