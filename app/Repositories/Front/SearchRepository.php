<?php

namespace App\Repositories\Front;


use App\Models\Good;

class SearchRepository
{

    /**
     * 处理搜索记录
     * @param $keyword
     * @return array|mixed
     */
    public function dealSearchHistory($keyword)
    {
        $queue = (!empty(session('search')) ? json_decode(session('search'), true) : []);
        if (!in_array($keyword, $queue)) {
            if (count($queue) == 5) {
                array_splice($queue, 0, 1);
            }
            array_push($queue, $keyword);
        }
        session(['search' => json_encode($queue)]);
        return $queue;
    }

    /**返回搜索记录
     * @param $keyword
     * @return \Elasticquent\ElasticquentResultCollection
     */
    public function returnGoods($keyword)
    {
        return Good::searchByQuery(array('match' => array('goods_name' => $keyword)));
    }
}

