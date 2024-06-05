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

Route::prefix('examples')->group(function () {
    Route::get('/', 'ExamplesController@view_index');
    // Route::get('/', function (Request $request) {
    //     $examples = app('files')->directories(module_path(Module::currentConfig('name'), config('modules.paths.generator.views.path') . '\\examples'));
    //     var_dump($examples);
    // });
    // Route::get('/{path}', 'ExamplesController@view_examples')->where(['path' => '.*']);
});
