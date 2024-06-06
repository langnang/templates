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

Route::prefix('todo')->group(function () {
    Route::get('/', 'ToDoController@view_index');
    Route::get('/metas', 'ToDoController@view_meta_list');
    Route::get('/contents', 'ToDoController@view_content_list');
    Route::get('/content/{cid}', 'ToDoController@view_content_item');
});
