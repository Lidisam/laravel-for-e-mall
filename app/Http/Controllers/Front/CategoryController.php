<?php

namespace App\Http\Controllers\Front;

use App\Repositories\Front\CategoryRepository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $cat;
    protected $pageSize;

    function __construct(CategoryRepository $categoryRepository)
    {
        $this->cat = $categoryRepository;
        $this->pageSize = 10;  //每页十条数据
    }

    public function Index()
    {
        $cats = $this->cat->returnAllCats();

        return view('front.category.index', compact('cats'));
    }

    public function product_list(Request $request, $cat_id)
    {
        $data = $this->cat->returnById($cat_id);
        $brand = $this->cat->returnAllBrands();

        if ($request->ajax()) {
            $conditions = $request->get('conditions');
            $page = (int)$request->get('page');
            //获取数据列表
            $this->cat->returnProductList($conditions, $this->pageSize, $page, $cat_id);
            $arr = [];
            $arr['data'] = $data;
            $arr['total'] = count($data->toArray());
            $arr['pageSize'] = $this->pageSize;
            return response()->json($arr);
        }
        return view('front.category.product_list', compact('data', 'brand'));
    }
}
