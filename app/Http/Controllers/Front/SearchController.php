<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Front\SearchRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    protected $search;

    function __construct(SearchRepository $searchRepository)
    {
        $this->search = $searchRepository;
    }


    /**
     * 进入搜索显示页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $history = json_decode(session('search'), true);

        return view('front.search.index', compact('history'));
    }

    /**
     * 提交搜索表单信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function commit(Request $request)
    {
        $keyword = $request->get('keyword');
        //处理搜索的历史记录
        $this->search->dealSearchHistory($keyword);
        //使用elasticsearch搜索(TODO:这里返回的是全部)
        $data = $this->search->returnGoods($keyword);

        return view('front.search.list', compact('data'));
    }
}