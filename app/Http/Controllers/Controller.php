<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

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
            $query = $query->where($key, 'like', $value);
        }
        return $query;
    }

    /**
     * 获取首页的列表数据
     * @param $map
     * @param $model
     * @param $request
     * @param $search
     * @return array
     */
    public function showList($map, $model, $request, $search)
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
            } else {
                $data['recordsFiltered'] = $model::count();
                $data['data'] = $model::skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();

            }
            return $data;
        }
    }
}
