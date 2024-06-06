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

Route::prefix('spider')->group(function () {
    Route::get('/', 'SpiderController@view_index');
    Route::get('/metas', 'SpiderController@view_meta_list');
    Route::get('/contents', 'SpiderController@view_content_list');
    Route::get('/content/{cid}', 'SpiderController@view_content_item');
});
