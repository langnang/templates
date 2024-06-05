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

Route::prefix('dictionary')->group(function () {
    Route::get('/', 'DictionaryController@index');
    Route::get('/metas', 'DictionaryController@view_meta_list');
    Route::get('/contents', 'DictionaryController@view_content_list');
    Route::get('/content/{cid}', 'DictionaryController@view_content_item');
});
