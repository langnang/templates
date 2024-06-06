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

Route::prefix('novel')->group(function () {
    Route::get('/', 'NovelController@view_index');
    Route::get('/metas', 'NovelController@view_meta_list');
    Route::get('/contents', 'NovelController@view_content_list');
    Route::get('/content/{cid}', 'NovelController@view_content_item');

    Route::get('/discover', 'NovelController@view_discover');
});
