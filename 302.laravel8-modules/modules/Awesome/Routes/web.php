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

Route::prefix('awesome')->group(function () {
    Route::get('/', 'AwesomeController@view_index');
    Route::get('/metas', 'AwesomeController@view_meta_list');
    Route::get('/contents', 'AwesomeController@view_content_list');
    Route::get('/content/{cid}', 'AwesomeController@view_content_item');
});
