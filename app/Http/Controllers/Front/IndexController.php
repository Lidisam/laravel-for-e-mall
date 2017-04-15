<?php

namespace App\Http\Controllers\Front;

use App\Repositories\Front\IndexRepository;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    protected $indexRepository;

    function __construct(IndexRepository $indexRepository)
    {
//        $this->middleware('auth:client');
        $this->indexRepository = $indexRepository;
    }

    /**
     * 前端首页
     */
    public function Index()
    {
//        $admin = Auth::guard('client')->user();
//        dump($admin);
//        return $admin->name;
        $thirdGoods = $this->indexRepository->returnThirdGoods();  //几种销量产品
        $ads = $this->indexRepository->returnAds();

        return view('front.index', compact('thirdGoods', 'ads'));
    }
}
