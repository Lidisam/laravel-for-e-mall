<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    /**
     * 查询条件组装
     * @param $query [查询对象]
     * @param $map [查询数组]
     * @return mixed
     */
    public function getConditions($query, $map)
    {
        foreach ($map as $key => $value) {
            //数组情况下为and或or的连接
            if (is_array($value)) {
                if ($value['way'] == 'and')
                    $query = $query->where($key, $value['op'], $value['value']);
                else if ($value['way'] == 'or') {
                    $query = $query->orWhere($key, $value['op'], $value['value']);
                } else if ($value['way'] == 'between') {
                    $query = $query->whereBetween($key, [$value['value']['0'], $value['value']['1']]);
                }
            } else {
                $query = $query->where($key, 'like', $value);
            }
        }
        return $query;
    }


    /**
     * 获取首页的列表数据
     * @param $map
     * @param $model
     * @param $request
     * @param $search
     * @param null $map2
     * @return array
     * @internal param null $mode
     */
    public function showList($map, $model, $request, $search, $map2 = null)
    {
        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['recordsTotal'] = $model::count();
            //搜索
            if (strlen($search['value']) > 0) {
                $data['recordsFiltered'] = $model::where(function ($query) use ($search, $map) {
                    $this->getConditions($query, $map);
                })->count();
                $data['data'] = $model::where(function ($query) use ($search, $map) {
                    $this->getConditions($query, $map);
                })->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            } else {  //载入页面加载信息
                if ($map2 == null) {
                    $data['recordsFiltered'] = $model::count();
                    $data['data'] = $model::skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = $model::where(function ($query) use ($map2) {
                        $this->getConditions($query, $map2);
                    })->count();
                    $data['data'] = $model::where(function ($query) use ($map2) {
                        $this->getConditions($query, $map2);
                    })->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            }
            return $data;
        }
    }

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
