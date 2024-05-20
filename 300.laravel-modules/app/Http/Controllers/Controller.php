<?php

namespace App\Http\Controllers;

use App\Support\Helpers\ModuleHelper;
use Illuminate\Support\Facades\Config;
use App\Support\Module;
use Illuminate\Http\Request;

class Controller extends \Illuminate\Routing\Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests,
        \Illuminate\Foundation\Bus\DispatchesJobs,
        \Illuminate\Foundation\Validation\ValidatesRequests,
        \App\Traits\ActionSelectTrait;
    use \App\Traits\Controller\HasView,
        \App\Traits\Controller\HasResponse;

    public function from_admin()
    {
        return preg_match('/^admin*/', request()->route()->getPrefix());
    }
    /**
     * 检测API路由
     */
    public function isApiRoute()
    {
        $header = request()->header();
        // dump(request()->server('PHP_SELF'));
        // dump(request()->is("cli/*"));
        // dump(Route::currnet());
        if (request()->server('PHP_SELF') === 'artisan')
            return false;
        // $isFromOpenAPI=substr($header['refer']);
        return \Route::current()->computedMiddleware[0] === 'api';
    }
    public function getOriginalData($value)
    {
        $return = [];
        if ($value instanceof \Illuminate\Http\JsonResponse) {
            $return = ($value->getData(true))['data'];
        }
        return $return;
    }


}
