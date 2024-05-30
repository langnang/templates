<?php

namespace App\Http\Controllers;

use App\Models\Model;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Support\Helpers\PhpSpiderHelper;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Arr;

class ApiController extends \Illuminate\Routing\Controller
{

  public function select_content_list()
  {
  }
  public function select_meta_list()
  {
  }
}
