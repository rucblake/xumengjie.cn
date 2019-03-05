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

Route::get('/', 'IndexController@index');
Route::get('/pc', function () {
    return view('pc');
});


Route::get('/article/detail/{id}', 'ArticleController@detail');


Route::get('/{type}/list', function ($type) {
    return view('list.tpl', ['type' => $type]);
});

Route::post('/news/list', 'NewsController@list');
Route::post('/image/list', 'ImageController@list');
Route::post('/video/list', 'VideoController@list');

Route::get('/weibo/register', function (){
    return view("weibo.register");
});
Route::post('/weibo/register', 'WeiboController@register');