<?php

namespace Modules\Examples\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Support\Module;

class ExamplesController extends \App\Http\Controllers\Controller
{
    protected $module = "Examples";
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('examples::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('examples::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('examples::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('examples::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
    public function view_index(Request $request)
    {
        $return = [
            'view' => "examples::examples.index",
            // 'examples' => app('files')->directories('modules\\' . Module::currentConfig('packages.name') . '\\' . config('modules.paths.generator.views.path') . '\\' . Module::currentConfig('packages.slug')),
            'examples' => app('files')->directories(module_path(Module::currentConfig('name'), config('modules.paths.generator.views.path') . DIRECTORY_SEPARATOR . Module::currentConfig('packages'))),
        ];
        return self::view($return['view'], $return);
    }
    public function view_examples(Request $request, $path)
    {
        $return = [
            'view' => "examples::example-packages.index",
            'examples' => app('files')->directories(module_path(Module::currentConfig('name'), config('modules.paths.generator.views.path') . DIRECTORY_SEPARATOR . Module::currentConfig('packages'))),
            'path' => $path,
            'slug' => explode('/', $path)[0]
        ];
        $return['example_view'] = $example_view = module_path(Module::currentConfig('name'), config('modules.paths.generator.views.path') . DIRECTORY_SEPARATOR . Module::currentConfig('packages')) . DIRECTORY_SEPARATOR . $path;
        // var_dump(app('files')->exists($example_view));
        // var_dump($example_view);
        if (app('files')->isDirectory($example_view) && app('files')->isFile($example_view . DIRECTORY_SEPARATOR . 'index.blade.php')) {
            $return['isDirectory'] = true;
            $return['view'] = "examples::example-packages." . str_replace([DIRECTORY_SEPARATOR], ["."], $path) . ".index";
        } else if (app('files')->isFile($example_view . '.blade.php')) {
            $return['isFile'] = true;
            $return['view'] = "examples::example-packages." . str_replace([DIRECTORY_SEPARATOR], ["."], $path);
        } else {
            abort(404);
        }
        return self::view($return['view'], $return);
    }
}