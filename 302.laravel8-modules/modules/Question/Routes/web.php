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

Route::prefix('question')->group(function () {
    Route::get('/', 'QuestionController@view_index');
    Route::get('/metas', 'QuestionController@view_meta_list');
    Route::get('/contents', 'QuestionController@view_content_list');
    Route::get('/content/{cid}', 'QuestionController@view_content_item');
});
