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

Route::prefix('book')->group(function () {
    Route::get('/', 'BookController@index');
    Route::get('/metas', 'BookController@view_meta_list');
    Route::get('/contents', 'BookController@view_content_list');
    Route::get('/content/{cid}', 'BookController@view_content_item');
});
