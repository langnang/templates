<?php

namespace Modules\Home\Http\Controllers;

use App\Models\Content;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller;
use Modules\Home\Models\HomeContent;

class HomeController extends \App\Http\Controllers\Controller
{
    use ViewTrait;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('home::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('home::create');
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
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('home::edit');
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

    public function select_latest_module_contents(Request $request)
    {
    }
}

trait ViewTrait
{
    public function view_index(Request $request)
    {
        $return = [
            'view' => 'index',
            "tabs" => [
                'home-latest' => \App\Models\Content::latest('updated_at')->paginate(30)
            ]
        ];
        foreach (\Module::all() ?? [] as $moduleName => $module) {
            $moduleSlug = config(strtolower($moduleName) . ".slug") ?? strtolower($moduleName);

            if (\Module::isEnabled($moduleName) && config($moduleSlug . ".home.index.visible")) {
                if ($moduleSlug == 'home')
                    continue;
                // $return['tabs'][$moduleSlug . '-toplist'] = new Paginator(Content::factory(30)->raw([], ), 30, 1);
                // $return['tabs'][$moduleSlug . '-latest'] = new Paginator(Content::factory(30)->raw([], ), 30, 1);
                // $return['tabs'][$moduleSlug . '-latest'] = \App\Models\Content::latest_updated(30);
                $return['tabs'][$moduleSlug . '-latest'] =
                    \App\Models\Field::whereHas('content', function ($query) {
                        $query->where([['type', 'post'], ['status', 'publish']]);
                    })
                        ->where([['name', 'module_' . $moduleSlug]])
                        ->latest('updated_at')
                        ->paginate(30);
                // $return['tabs'][$moduleSlug . '-hottest'] = new Paginator(Content::factory(30)->raw([], ), 30, 1);
                // $return['tabs'][$moduleSlug . '-recommend'] = new Paginator(Content::factory(30)->raw([], ), 30, 1);
                // $return['tabs'][$moduleSlug . '-collection'] = new Paginator(Content::factory(30)->raw([], ), 30, 1);
            }

        }



        return $this->view($return);
    }
    public function view_contents(Request $request)
    {
        $return = ['view' => 'contents', 'paginator' => HomeContent::paginate(15)];
        return $this->view($return);
    }

}