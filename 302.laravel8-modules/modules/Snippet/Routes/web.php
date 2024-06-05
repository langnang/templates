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

Route::prefix('snippet')->group(function () {
    Route::get('/', 'SnippetController@index');
    Route::get('/metas', 'SnippetController@view_meta_list');
    Route::get('/contents', 'SnippetController@view_content_list');
    Route::get('/content/{cid}', 'SnippetController@view_content_item');
});
