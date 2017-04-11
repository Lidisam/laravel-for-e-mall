<?php

namespace App\Http\Controllers\Front;

use App\Repositories\Front\IndexRepository;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    protected $indexRepository;

    function __construct(IndexRepository $indexRepository)
    {
        $this->indexRepository = $indexRepository;
    }

    /**
     * 前端首页
     */
    public function Index()
    {
        $thirdGoods = $this->indexRepository->returnThirdGoods();  //几种销量产品
        $ads = $this->indexRepository->returnAds();

        return view('front.index', compact('thirdGoods', 'ads'));
    }
}
