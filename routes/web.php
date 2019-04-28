<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
//注册
Route::any('Login/reg','LoginController@reg');
Route::any('Login/sends','LoginController@sends');
Route::any('Login/regdo','LoginController@regdo');
Route::any('/test','LoginController@test');

//登录
Route::any('Login/login','LoginController@login');
Route::any('Login/logindo','LoginController@logindo');
//主页面
Route::any('/','IndexController@index');
Route::any('creatSonTree','IndexController@creatSonTree');
Route::any('/sends','IndexController@sends');

//个人中心
Route::any('/user','UserController@user');

//商品信息
Route::get('/goodslist','GoodsController@goodslist');

//商品详情
Route::any('/cart/{goods_id}','CartController@cart');
Route::any('/cartlist','CartController@cartlist');
Route::any('/addcart','CartController@addcart');
Route::any('/cart','CartController@cart');
Route::any('/countTotal','CartController@countTotal');
Route::any('/getSubTotal','CartController@getSubTotal');
Route::any('/changeBuyNumber','CartController@changeBuyNumber');
Route::any('/checkGoodsNumber','CartController@checkGoodsNumber');

Route::any('/bay{goods_id}','BayController@bay');

Route::any('/address','BayController@address');
Route::any('/getAreaInfo','BayController@getAreaInfo');
Route::any('/getArea','BayController@getArea');
Route::any('/addressdo','BayController@addressdo');
Route::any('/addresslist','BayController@addresslist');
Route::any('/addresscheck','BayController@addresscheck');
Route::any('/success/{id}','BayController@success');
Route::any('/returnpay','BayController@returnpay');

//测试
Route::any('/goodssadd','GoodssController@goodssadd');
Route::any('/goodssadddo','GoodssController@goodssadddo');
Route::any('/goodsslist','GoodssController@goodsslist');
Route::any('/list/{id}','GoodssController@list');
Route::any('/del/{id}','GoodssController@del');
Route::any('/goodssupdate/{id}','GoodssController@goodssupdate');
Route::any('/update','GoodssController@update');
