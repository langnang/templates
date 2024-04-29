<?php

namespace Modules\Spider\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class SpiderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('spider::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('spider::create');
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
        return view('spider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('spider::edit');
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

    public function start(Request $request, $slug)
    {
        $configs = parse_ini_string('
[spider]
key1 = value1
key2[] = value2
key2[] = value2
fields.name[] = 1
fields.name[] = 1

[spider.fields\[\]]
name[] = 123
selector[] = 123
selector[] = 
selector[] = 
selector[] = 123
3[] = 123
[spider.fields[/]]
name[] = 1234
selector[] = 1234
3[] = 1234
[Section2]
key3 = 42
key4 = true', true);
        var_dump($configs);
    }
}
