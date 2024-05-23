<?php

namespace App\Traits\Controller;

use Illuminate\Http\Request;
use App\Support\Module;

trait HasView
{
    public function view($view = null, $data = [], $mergeData = [])
    {
        $return = array_merge([
            '$route' => [
                'method' => request()->method(),
                'url' => request()->url(),
                'fullUrl' => request()->fullUrl(),
            ],
            'request' => request()->all(),
            'config' => $config = Module::currentConfig(),
            'layout' => "layouts.master",
        ], is_array($view) ? $view : [], $data);
        //
        $return['layout'] = empty($config) ? $return['layout'] : $config['slug'] . '::layouts.' . $config['layout'];
        //
        $return['view'] = is_array($view)
            ? (empty($config)
                ? $return['view']
                : $config['slug'] . '::' . $config['slug'] . '.' . $config['layout'] . '.' . $return['view'])
            : $view;

        if (env('WEB_CONSOLE')) {
            echo "<script>window.\$app=" . json_encode($return, JSON_UNESCAPED_UNICODE) . ";</script>";
            echo "<script>console.log(`window.\$app`, window.\$app);</script>";
        }
        // dump($view);
        if (is_array($view) ? !isset($view['view']) : empty($view))
            abort(404);

        return view($return['view'], $return, $mergeData);
    }
    // public function view_index(Request $request)
    // {
    //     $return = ['view' => 'home.index'];
    //     return $this->view($return);
    // }

}
