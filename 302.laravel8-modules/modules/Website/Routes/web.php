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

Route::prefix('website')->group(function () {
    Route::get('/', 'WebsiteController@index');
    Route::get('/content/{cid}', 'WebsiteController@view_content_item');
});
