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

Route::prefix('audio')->group(function () {
    Route::get('/', 'AudioController@view_index');
    Route::get('/metas', 'AudioController@view_meta_list');
    Route::get('/contents', 'AudioController@view_content_list');
    Route::get('/content/{cid}', 'AudioController@view_content_item');
});
