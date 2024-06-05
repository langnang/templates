<?php

use Modules\Note\Models\NoteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Note\Models\NoteMeta;
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

Route::prefix('note')->group(function () {
    // Route::get('/', 'NoteController@index');
    Route::get('/', 'NoteController@view_index');
    Route::get('/metas', 'NoteController@view_meta_list');
    Route::get('/contents', 'NoteController@view_content_list');
    Route::get('/content/{cid}', 'NoteController@view_content_item');

});

// Route::prefix('admin')->group(function () {
//     Route::prefix(Module::currentConfig('web.prefix'))->group(function () {
//         Route::prefix('{table}')->where(['table' => '(metas|contents|comments|links)'])->group(function () {
//             Route::get('', function (Request $request, $table) {
//                 NoteContent::insert(['title' => '123']);
//                 $return = [
//                     'view' => 'admin::admin.modules.' . $table,
//                     'readonly' => true,
//                     'paginator' => NoteContent::paginate(15),
//                 ];

//                 return \Modules\Admin\Http\Controllers\AdminController::view($return['view'], $return);
//             });
//             Route::match(['get', 'post'], '/insert', function (Request $request, $table) {
//                 $return = [
//                     'view' => 'admin::admin.modules.' . substr($table, 0, -1),
//                     'readonly' => true,
//                     'detail' => new NoteContent,
//                 ];

//                 if ($request->method() == 'POST') {
//                     // $id = NoteContent::insertGetId($request->input());
//                     $return['detail']->fill($request->input());
//                     $return['detail']->save();
//                     $id = $return['detail']->{$return['detail']->getKeyName()};
//                     // var_dump($return['detail']->getPrimary());
//                     // var_dump($return['detail']->{$return['detail']->getKeyName()});
//                     return redirect("/admin/" . Module::currentConfig('web.prefix') . "/" . $table . '/' . $id);
//                 }

//                 return \Modules\Admin\Http\Controllers\AdminController::view($return['view'], $return);
//             });
//             Route::match(['get', 'post'], '/{id}', function (Request $request, $table, $id) {
//                 // var_dump(Route::current()->compiled);
//                 // var_dump(request()->route()->compiled->getRegex());
//                 // var_dump($request->path());
//                 // var_dump(preg_match(request()->route()->compiled->getRegex(), '/' . $request->path()));
//                 $return = [
//                     'view' => 'admin::admin.modules.' . substr($table, 0, -1),
//                     'readonly' => true,
//                     'detail' => NoteContent::find($id),
//                 ];
//                 if ($request->method() == 'POST') {
//                     $return['detail']->fill($request->input());
//                     $return['detail']->save();
//                 }

//                 return \Modules\Admin\Http\Controllers\AdminController::view($return['view'], $return);
//             });
//         });
//         Route::match(['get', 'post'], '/config', '\\Modules\\Admin\\Http\\Controllers\\AdminController@view_admin_modules_config');
//     });
// });
