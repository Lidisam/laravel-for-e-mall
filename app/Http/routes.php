<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('admin/index', ['as' => 'admin.index', 'middleware' => ['auth', 'menu'], 'uses' => 'Admin\\IndexController@index']);

$this->group(['namespace' => 'Admin', 'prefix' => '/admin',], function () {
    Route::auth();
});

$router->group(['namespace' => 'Admin', 'middleware' => ['auth', 'authAdmin', 'menu']], function () {
    //权限管理路由
    Route::get('admin/permission/{cid}/create', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@create']);
    Route::get('admin/permission/{cid?}', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);
    Route::post('admin/permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']); //查询

    Route::resource('admin/permission', 'PermissionController');
    Route::put('admin/permission/update', ['as' => 'admin.permission.edit', 'uses' => 'PermissionController@update']); //修改
    Route::post('admin/permission/store', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@store']); //添加


    //角色管理路由
    Route::get('admin/role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::post('admin/role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::resource('admin/role', 'RoleController');
    Route::put('admin/role/update', ['as' => 'admin.role.edit', 'uses' => 'RoleController@update']); //修改
    Route::post('admin/role/store', ['as' => 'admin.role.create', 'uses' => 'RoleController@store']); //添加


    //用户管理路由
    Route::get('admin/user/manage', ['as' => 'admin.user.manage', 'uses' => 'UserController@index']);  //用户管理
    Route::post('admin/user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    Route::resource('admin/user', 'UserController');
    Route::put('admin/user/update', ['as' => 'admin.user.edit', 'uses' => 'UserController@update']); //修改
    Route::post('admin/user/store', ['as' => 'admin.user.create', 'uses' => 'UserController@store']); //添加


    //会员等级管理
    Route::get('admin/memberLevel/manage', ['as' => 'admin.memberLevel.manage', 'uses' => 'MemberLevelController@index']);  //用户管理
    Route::post('admin/memberLevel/index', ['as' => 'admin.memberLevel.index', 'uses' => 'MemberLevelController@index']);
    Route::resource('admin/memberLevel', 'MemberLevelController');
    Route::put('admin/memberLevel/update', ['as' => 'admin.memberLevel.edit', 'uses' => 'MemberLevelController@update']); //修改
    Route::post('admin/memberLevel/store', ['as' => 'admin.memberLevel.create', 'uses' => 'MemberLevelController@store']); //添加

    //品牌管理
    Route::get('admin/brand/manage', ['as' => 'admin.brand.manage', 'uses' => 'BrandController@index']);
    Route::post('admin/brand/index', ['as' => 'admin.brand.index', 'uses' => 'BrandController@index']);
    Route::resource('admin/brand', 'BrandController');
    Route::put('admin/brand/update', ['as' => 'admin.brand.edit', 'uses' => 'BrandController@update']); //修改
    Route::post('admin/brand/store', ['as' => 'admin.brand.create', 'uses' => 'BrandController@store']); //添加

    //商品分类管理
    Route::get('admin/category/manage', ['as' => 'admin.category.manage', 'uses' => 'CategoryController@index']);
    Route::post('admin/category/index', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index']);
    Route::resource('admin/category', 'CategoryController');
    Route::put('admin/category/update', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@update']); //修改
    Route::post('admin/category/store', ['as' => 'admin.category.create', 'uses' => 'CategoryController@store']); //添加

    //类型管理
    Route::get('admin/type/manage', ['as' => 'admin.type.manage', 'uses' => 'TypeController@index']);
    Route::post('admin/type/index', ['as' => 'admin.type.index', 'uses' => 'TypeController@index']);
    Route::resource('admin/type', 'TypeController');
    Route::put('admin/type/update', ['as' => 'admin.type.edit', 'uses' => 'TypeController@update']); //修改
    Route::post('admin/type/store', ['as' => 'admin.type.create', 'uses' => 'TypeController@store']); //添加

    //属性管理(类型下的属性)
    Route::get('admin/attribute/manage', ['as' => 'admin.attribute.manage', 'uses' => 'AttributeController@index']);
    Route::any('admin/attribute/index/{id}', ['as' => 'admin.attribute.index', 'uses' => 'AttributeController@index']);
    Route::resource('admin/attribute', 'AttributeController');
    Route::put('admin/attribute/update', ['as' => 'admin.attribute.edit', 'uses' => 'AttributeController@update']); //修改
    Route::post('admin/attribute/store', ['as' => 'admin.attribute.create', 'uses' => 'AttributeController@store']); //添加

    //商品管理
    Route::get('admin/good/ajaxGetAttr', ['as' => 'admin.good.ajaxGetAttr', 'uses' => 'GoodController@ajaxGetAttr']);//ajax获取类型的属性
    Route::get('admin/good/delPic', ['as' => 'admin.good.delPic', 'uses' => 'GoodController@delPic']);//编辑时删除图片
    Route::any('admin/good/webUpload', ['as' => 'admin.good.webUpload', 'uses' => 'GoodController@webUpload']);
    Route::get('admin/good/manage', ['as' => 'admin.good.manage', 'uses' => 'GoodController@index']);
    Route::post('admin/good/index', ['as' => 'admin.good.index', 'uses' => 'GoodController@index']);
    Route::resource('admin/good', 'GoodController');
    Route::put('admin/good/update', ['as' => 'admin.good.edit', 'uses' => 'GoodController@update']); //修改
    Route::post('admin/good/store', ['as' => 'admin.good.create', 'uses' => 'GoodController@store']); //添加

});


/*------
组件测试
----------*/
Route::get('webUpload', ['as' => 'packages.webUpload.index', 'uses' => 'WebUploadController@index']);  //图片上传
Route::any('webUpload2', ['as' => 'packages.webUpload.up', 'uses' => 'WebUploadController@up']);  //图片提交


Route::get('admin', function () {
    return redirect('/admin/index');
});

Route::auth();

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});

