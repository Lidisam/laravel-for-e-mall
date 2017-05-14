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
        return view('front.search.index');
    }

    /**
     * 提交搜索表单信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function commit(Request $request)
    {
        $keyword = $request->get('keyword');
//        $this->search->dealSearchHistory($keyword);

        return view('front.search.list')->withCookie('dd','ddd');
    }
}

