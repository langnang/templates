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

use App\Support\Module;

Route::prefix(Module::currentConfig('web.prefix'))->group(function () {
    Route::get('/', 'HomeController@view_index');
    Route::get('/contents', 'HomeController@view_contents');
    Route::get('/content/{:cid}', 'HomeController@view_content_item');
});
