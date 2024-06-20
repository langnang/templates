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

Route::prefix('quote')->group(function () {
    Route::get('/', 'QuoteController@view_index');
    Route::get('/metas', 'QuoteController@view_meta_list');
    Route::get('/contents', 'QuoteController@view_content_list');
    Route::get('/content/{cid}', 'QuoteController@view_content_item');
});
