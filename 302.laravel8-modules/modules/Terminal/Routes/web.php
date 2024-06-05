<?php

use App\Support\Module;

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


Route::prefix(Module::currentConfig('web.prefix'))->group(function () {
    Route::match(['get', 'post'], '/', 'TerminalController@view_index');
});
