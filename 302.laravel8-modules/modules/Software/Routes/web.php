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

Route::prefix('software')->group(function () {
    Route::get('/', 'SoftwareController@view_index');
    Route::get('/metas', 'SoftwareController@view_meta_list');
    Route::get('/contents', 'SoftwareController@view_content_list');
    Route::get('/content/{cid}', 'SoftwareController@view_content_item');
});
