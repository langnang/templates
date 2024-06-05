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

Route::prefix('openapi')->group(function () {
    Route::get('/', 'OpenAPIController@index');
    Route::get('/metas', 'OpenAPIController@view_meta_list');
    Route::get('/contents', 'OpenAPIController@view_content_list');
    Route::get('/content/{cid}', 'OpenAPIController@view_content_item');
});
