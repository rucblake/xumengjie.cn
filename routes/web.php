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

Route::post('/video/list', 'VideoController@list');

Route::post('/news/list', 'NewsController@list');