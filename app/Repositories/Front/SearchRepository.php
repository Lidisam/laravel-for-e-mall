<?php

namespace App\Repositories\Front;


class SearchRepository
{

    /**
     * 处理搜索记录
     * @param $keyword
     */
    public function dealSearchHistory($keyword)
    {
        dump(isset($_SESSION['search']));
        $queue = (isset($_SESSION['search']) ? json_decode($_SESSION['search'], true) : []);
        if (!in_array($keyword, $queue)) {
            if (count($queue) == 5) {
                array_pop($queue);
            } else {
                array_push($queue, $keyword);
            }
        }
        $_SESSION['search'] = json_encode($queue);
        dd($_SESSION['search']);
    }
}

