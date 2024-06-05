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

Route::prefix('dependency')->group(function () {
    Route::get('/', 'DependencyController@index');
    Route::get('/metas', 'DependencyController@view_meta_list');
    Route::get('/contents', 'DependencyController@view_content_list');
    Route::get('/content/{cid}', 'DependencyController@view_content_item');

});
