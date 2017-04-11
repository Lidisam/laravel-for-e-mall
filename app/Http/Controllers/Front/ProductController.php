<?php

namespace App\Http\Controllers\Front;

use App\Models\Good;
use App\Models\GoodsCat;
use App\Repositories\Front\ProductRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    protected $productRepository;

    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     */
    function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * 返回单个商品详情
     * @param $product_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($product_id)
    {
        $product = $this->productRepository->returnProduct($product_id);
        return view('front.product', compact('product'));
    }
}
