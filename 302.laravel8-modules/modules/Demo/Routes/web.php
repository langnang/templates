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

Route::prefix('demo')->group(function () {
    Route::get('/', 'DemoController@view_index');
    Route::get('/metas', 'DemoController@view_meta_list');
    Route::get('/contents', 'DemoController@view_content_list');
    Route::get('/content/{cid}', 'DemoController@view_content_item');
});
