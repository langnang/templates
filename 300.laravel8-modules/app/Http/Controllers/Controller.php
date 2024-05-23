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

class Controller extends \Illuminate\Routing\Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use \Illuminate\Foundation\Bus\DispatchesJobs;
    use \Illuminate\Foundation\Validation\ValidatesRequests;

    // use \App\Traits\Modules\BaseTrait;
    use \App\Traits\Crud\BaseCrudTrait;
    use \App\Traits\Crud\MetaCrudTrait;
    use \App\Traits\Crud\ContentCrudTrait;
    use \App\Traits\Crud\LinkCrudTrait;
    use \App\Traits\Crud\FieldCrudTrait;
    use \App\Traits\Crud\RelationshipCrudTrait;

    use BaseResponse, BaseRequest, BaseClauses, BaseDecouple, BaseCall, BaseImportTree, BaseView, BaseCron, BaseGetViewShared;

    use \App\Traits\Controller\HasView;
    protected $BaseModel;
    protected $MetaModel = \App\Models\Base\Meta::class;
    protected $ContentModel = \App\Models\Base\Content::class;
    protected $FieldModel = \App\Models\Base\Field::class;
    protected $CommentModel = \App\Models\Base\Comment::class;
    protected $LinkModel = \App\Models\Base\Link::class;
    protected $RuleModel = \App\Models\Base\Rule::class;
    protected $RelationshipModel = \App\Models\Relationship::class;
    protected $UserModel = \App\Models\User::class;
    protected $OptionModel = \App\Models\Option::class;
    protected $LogModel = \App\Models\Base\Log::class;
    /**
     * 函数组对象
     */
    protected $keyMap = [
        'mid' => 'upsert_meta_item',
        'meta' => 'upsert_meta_item',
        'mids' => 'upsert_meta_list',
        'metas' => "upsert_meta_list",
        'cid' => 'upsert_content_item',
        'content' => 'upsert_content_item',
        'cids' => 'upsert_content_list',
        'contents' => "upsert_content_list",
        'lid' => 'upsert_link_item',
        'link' => 'upsert_link_item',
        'lids' => 'upsert_link_list',
        'links' => "upsert_link_list",
        'relationships' => '',
        'coid' => 'upsert_comment_item',
        'comment' => 'upsert_comment_item',
        'coids' => 'upsert_comment_list',
        'comments' => 'upsert_comment_list',
        'uid' => 'upsert_user_item',
        'user' => 'upsert_user_item',
        'uids' => 'upsert_user_list',
        'users' => 'upsert_user_list',
        'id' => 'upsert_field_item',
        'field' => 'upsert_field_item',
        'ids' => 'upsert_field_list',
        'fields' => 'upsert_field_list',
    ];
    /**
     * 导入映射关系
     * @var $key
     * @var $value [$func, $type in [primaryKey,object,array], $default]
     * @var array
     */
    protected $importMapping = [
        "meta" => ["upsert_meta_item", "object",],
        "metas" => ["upsert_meta_list", "array",],
        "tag" => ["upsert_meta_item", "object", ["type" => "tag"]],
        "tags" => ["upsert_meta_list", "array", ["type" => "tag"]],
        "category" => ["upsert_meta_item", "object", ["type" => "category"]],
        "categories" => ["upsert_meta_list", "array", ["type" => "category"]],
        "collection" => ["upsert_meta_item", "object", ["type" => "collection"]],
        "collections" => ["upsert_meta_list", "array", ["type" => "collection"]],

        "link",
        "links",

        "content" => ["upsert_content_item", "object"],
        "contents" => ["upsert_content_list", "array"],
        "post" => ["upsert_content_item", "object", ["type" => "post"]],
        "posts" => ["upsert_content_list", "array", ["type" => "post"]],
        "template" => ["upsert_content_item", "object", ["type" => "post"]],
        "templates" => ["upsert_content_list", "array", ["type" => "template"]],

        "field" => ["upsert_field_item", "object"],
        "fields" => ["upsert_field_list", "array"],

        "comment",
        "comments",

        "user",
        "users",

        "option",
        "options",

        "relationship" => ['upsert_relationship_item', 'object'],
        "relationships" => ['upsert_relationship_list', 'array'],
    ];
    protected $extendImportMapping = [];

    protected $_logs = [];

    function get_logs()
    {
        return $this->_logs;
    }

    function append_logs($logs)
    {
        array_push($this->_logs, $logs);
    }
    public function from_admin()
    {
        return preg_match('/^admin*/', request()->route()->getPrefix());
    }
    public function getOriginalData($value)
    {
        $return = [];
        if ($value instanceof \Illuminate\Http\JsonResponse) {
            $return = ($value->getData(true))['data'];
        }
        return $return;
    }
    /**
     * 导入映射
     *
     * @return void
     */
    function getImportMapping()
    {
        return array_merge($this->importMapping, $this->extendImportMapping);
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
        return Route::current()->computedMiddleware[0] === 'api';
    }

    public function isArtisanCli()
    {
        return request()->server('PHP_SELF') === 'artisan';
    }

    public function getKeyMap($key = null)
    {
        $return = [];
        $parent = get_parent_class($this);
        // 调用的控制器非当前控制器
        // 且
        //
        if (__CLASS__ !== get_class($this) && get_class($this) !== $parent) {
            $return = array_merge($return, (new $parent)->getKeyMap());
        }
        $return = array_merge($return, $this->keyMap);
        return $return;
    }

    public function getModelPrefix()
    {
    }

    /**
     * @description 检测类中是否定义 Model
     * @param string $name
     * @return bool|string
     * @throws Exception
     */
    public function issetModel(string $name)
    {
        switch ($name) {
            case 'base':
            case $this->BaseModel:
                if (!$this->BaseModel) {
                    throw new \Exception(Lang::get('validation.unset_model.base'));
                }

                return $this->BaseModel;
                break;
            case 'meta':
            case $this->MetaModel:
                if (!$this->MetaModel) {
                    throw new \Exception(Lang::get('validation.unset_model.meta'));
                }

                return $this->MetaModel;
                break;
            case 'content':
            case $this->ContentModel:
                if (!$this->ContentModel) {
                    throw new \Exception(Lang::get('validation.unset_model.content'));
                }

                return $this->ContentModel;
                break;
            case 'link':
            case $this->LinkModel:
                if (!$this->LinkModel) {
                    throw new \Exception(Lang::get('validation.unset_model.link'));
                }

                return $this->LinkModel;
                break;
            case 'relationship':
            case $this->RelationshipModel:
                if (!$this->RelationshipModel) {
                    throw new \Exception(Lang::get('validation.unset_model.relationship'));
                }

                return $this->RelationshipModel;
                break;
            case 'field':
            case $this->FieldModel:
                if (!$this->FieldModel) {
                    throw new \Exception(Lang::get('validation.unset_model.relationship'));
                }

                return $this->FieldModel;
                break;
            default:
                break;
        }
        return true;
    }

    /**
     * @description 检测类中是否使用 Trait
     * @param string $name
     * @return bool
     * @throws Exception
     */
    public function isuseCrudTrait(string $name)
    {
        $traits = class_uses($this);
        switch ($name) {
            case 'base':
                if (!in_array('App\Traits\Crud\BaseCrudTrait', $traits)) {
                    throw new \Exception(Lang::get('validation.unset_model.base'));
                }

                break;
            case 'meta':
                if (!in_array('App\Traits\Crud\MetaCrudTrait', $traits)) {
                    throw new \Exception(Lang::get('validation.unset_model.meta'));
                }

                break;
            case 'content':
                if (!in_array('App\Traits\Crud\ContentCrudTrait', $traits)) {
                    throw new \Exception(Lang::get('validation.unset_model.content'));
                }

                break;
            case 'link':
                if (!in_array('App\Traits\Crud\LinkCrudTrait', $traits)) {
                    throw new \Exception(Lang::get('validation.unset_model.link'));
                }

                break;
            default:
                break;
        }
        return true;
    }
}

trait BaseResponse
{
    public function success($data = [], $message = '成功')
    {
        // var_dump(debug_backtrace());
        // Log::info('[' . request()->method() . '] ' . request()->fullUrl(), [
        //   // "attributes" => request()->attributes(),
        //   "request" => request()->all(),
        //   "query" => request()->query(),
        //   "server" => request()->server(),
        //   // "files" => request()->files() ?? [],
        //   "cookies" => request()->cookie(),
        //   "headers" => request()->header(),
        //   'response' => $data,
        //   'debug' => array_map(function ($item) {
        //     return ($item['class'] ?? '') . '::' . $item['function'] . '->' . $item['line'];
        //   }, debug_backtrace()),
        // ]);
        if ($this->isApiRoute()) {
            $return = [
                'status' => 200,
                'message' => $message,
                'data' => $data,
            ];
            // if ($data instanceof \Illuminate\Pagination\Paginator || $data instanceof \Illuminate\Contracts\Pagination\Paginator) {
            //     $return = array_merge($return, $data->toArray());
            //     unset($return['first_page_url']);
            //     unset($return['next_page_url']);
            //     unset($return['path']);
            //     unset($return['prev_page_url']);
            //     unset($return['last_page_url']);
            //     unset($return['links']);
            //     unset($return['prev_page_url']);
            // }
            return response()->json($return);
        } else {
            return $data;
        }
    }

    public function error($message = '失败')
    {
        var_dump($message);
        artisan_dump($message);
        // Log::info('[' . request()->method() . '] ' . request()->fullUrl(), [
        //   // "attributes" => request()->attributes(),
        //   "request" => request()->all(),
        //   "query" => request()->query(),
        //   "server" => request()->server(),
        //   // "files" => request()->files() ?? [],
        //   "cookies" => request()->cookie(),
        //   "headers" => request()->header(),
        //   'response' => $message,
        //   'debug' => array_map(function ($item) {
        //     return ($item['class'] ?? '') . '::' . $item['function'] . '->' . $item['line'];
        //   }, debug_backtrace()),
        // ]);
        if ($this->isApiRoute() && $message instanceof \Exception) {
            //            $message = '[' . $message->getFile() . '::' . $message->getCode() . '::' . $message->getLine() . ']  ' . $message->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message->getMessage(),
                'file' => $message->getFile(),
                'code' => $message->getCode(),
                'line' => $message->getLine(),
            ]);
        }
        return $message;
    }

    public function debug($data = [], $message = '调试')
    {
        Log::debug(request()->fullUrl());
        return response()->json([
            'status' => 500,
            'message' => $message,
            'data' => $data,
            // 'debug' => debug_backtrace(),
            // 'debug' => array_map(function ($item) {
            //     return ($item['class'] ?? '') . '::' . $item['function'] . '->' . $item['line'];
            // }, debug_backtrace()),
        ]);
    }
}

trait BaseRequest
{
}

/**
 * 生成语句
 */
trait BaseClauses
{
    public function selectClauses(Request $request)
    {
        return $request->input('$select', []);
    }

    /**
     * @description with 语句
     * @param Request $request
     * @return mixed
     */
    public function withClauses(Request $request)
    {
        [
            '$with',
            '$without',
            '$withCount',
            '$withPivot',
            '$withTimestamps',
            '$morphWith',
            '$morphWithCount',
            '$withDefault',
            '$syncWithoutDetaching',
            // 获取包括软删除模型在内的模型
            '$withTrashed',
            '$onlyTrashed',
            // 对当前查询取消全局作用域
            '$withoutGlobalScope',
            // 暂时「禁用」模型触发的所有事件
            '$withoutEvents',
        ];
        return $request->input('$with', []);
    }

    /**
     * @description where 语句
     * @param Request $request
     * * $where [[key, value]]
     * * $orWhere
     * * $whereIn [key => value]
     * * $orWhereIn
     * * $whereNotIn
     * * $orWhereNotIn
     * * $whereBetween
     * * $whereNotBetween
     * @param $return
     * @param array $ignores 过滤的列
     * @return mixed
     */
    public function whereClauses(Request $request, $return, array $ignores = [])
    {
        foreach (['$where', '$orWhere', '$whereBetween', '$orWhereBetween', '$whereNotBetween', '$orWhereNotBetween', '$whereIn', '$orWhereIn', '$whereNotIn', '$orWhereNotIn', '$whereNull', '$whereNotNull', '$orWhereNull', '$orWhereNotNull', '$whereDate', '$whereMonth', '$whereDay', '$whereYear', '$whereTime', '$whereColumn', '$orWhereColumn', '$whereHasMorph',] as $clause) {
            if (!$request->filled($clause)) {
                continue;
            }

            if (empty($request->input($clause))) {
                continue;
            }

            $args = $request->input($clause, []);
            if (in_array($clause, ['$where'])) {
                $args = $request->input($clause, []);
                // dump($args);
                foreach ($args as $index => $arg) {
                    // dump($arg[0]);
                    if (in_array($arg[0], $ignores)) {
                        unset($args[$index]);
                    }
                }
                // dump($args);
                $args = [$args];
            }
            if (in_array($clause, ['$whereIn'])) {
                foreach ($request->input($clause) as $key => $value) {
                    $return = $return->{substr($clause, 1)}($key, $value);
                }
            } else {
                $return = $return->{substr($clause, 1)}(...$args);
            }
        }
        // 存在 relationships 并非前置方法存入的空数据
        if ($request->filled('relationships') && !empty($request->input('relationships'))) {
            $return = $return->whereHas('relationships', function (Builder $query) use ($request) {
                foreach ($request->input('relationships') as $key => $value) {
                    if (is_array($value)) {
                        $query = $query->whereIn($key, $value);
                    } else {
                        $query = $query->where($key, $value);
                    }
                }
            });
        }
        return $return;
    }

    public function orderByClauses(Request $request, $return)
    {
        if ($request->filled('$order') && !empty($request->input('$order'))) {
            $order = $request->input('$order');
            if (is_array($order)) {
                foreach ($order as $args) {
                    if (is_string($args)) {
                        $return = $return->orderBy($args, 'desc');
                    } else {
                        $return = $return->orderBy(...$args);
                    }
                }
            } else {
                $return = $return->orderBy($order);
            }
            unset($order);
        }
        return $return;
    }

    public function groupByClauses(Request $request, $return)
    {
        return $return;
    }
}

/**
 * 解耦
 */
trait BaseDecouple
{
    /**
     * 由于请求接口调用的方法，可能嵌套调用，会造成多层结构，需清除
     */
    public function getReturn($return)
    {
        if ($this->isApiRoute() && $return instanceof JsonResponse) {
            if (isset($return->original['data'])) {
                return $return->original['data'];
            } else {
                return null;
            }
        }
        // if ($return instanceof Model) return $return->toArray();
        return $return;
    }
}

trait BaseCall
{
    public function each_key_method()
    {
    }

    public function call_self_method($key, ...$values)
    {
        if (!array_key_exists($key, $this->getKeyMap())) {
            return;
        }

        $method = $this->getKeyMap()[$key];
        if (!method_exists($this, $method)) {
            return;
        }

        return $this->{$method}(...$values);
    }

    public function each_item_func($method, Request $request)
    {
        try {
            // dump(__METHOD__);
            $model = $this->issetModel($request->input('$model', $this->BaseModel));
            $primaryKey = (new $model())->getKeyName();
            $parentColumn = (new $model())->parentColumn;
            // dump(__METHOD__, $primaryKey, $parentColumn);
            // dump(__METHOD__, $method);
            $return = [
                'data' => [],
                'success_count' => 0,
                'failed_count' => 0,
            ];
            foreach ($request->input('data', []) as $item) {
                $result = $this->getReturn($this->$method(new Request(array_merge($item, ['$model' => $model]))));
                if (isset($item['children']) && sizeof($item['children']) > 0 && !empty($parentColumn)) {
                    // var_dump(["call children each_item_func", $item['children']]);
                    // 递归调用 传参为子类数据
                    $resultChildren = $this->getReturn($this->each_item_func($method, new Request([
                        '$model' => $model,
                        'data' => array_map(function ($child) use ($result, $primaryKey, $parentColumn) {
                            return array_merge($child, [
                                $parentColumn => $result[$primaryKey],
                            ]);
                        }, $item['children']),
                    ])));
                    $result['children'] = $resultChildren['data'];
                }
                if (empty($result)) {
                    array_push($return['data'], null);
                    $return['failed_count']++;
                } else {
                    array_push($return['data'], $result);
                    $return['success_count']++;
                }
                unset($result);
            }
            return $this->success($return);
        } catch (Exception $e) {
            $this->error($e);
        }
    }
}


trait BaseSpiderSource
{
    function spider_source_search()
    {
    }

    function spider_source_discover()
    {
    }

    function spider_source_category()
    {
    }

    function spider_source_detail()
    {
    }

    function spider_source_item()
    {
    }

    function spider_source_download()
    {
    }
}

trait BaseView
{

    /**
     * OPEN /{prefix}
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view_index(Request $request)
    {
        // dump(Auth::check());
        // Auth::loginUsingId(1, true);
        $_logs = [__METHOD__, $request->all()];
        // $user = $this->UserModel::find(1);
        // dump($user);
        // Auth::login($user, true);
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "query" => $request->all(),
            "view" => View::exists($this->prefix . '.index') ? $this->prefix . '.index' : '_view.index',
            "current_page" => request()->input('page', '1'),
            "last_page" => 1,
        ], $request->input('$return', []), );
        $query = $return['$query'] ?? [];
        unset($return['query']['$return']);
        // 清除分页，便于生成分页地址
        unset($return['query']['page_size'], $return['query']['page']);
        if (!isset($return['categories'])) {
            array_push($_logs, "parent not set categories.");
            $query['categories'] = array_merge([], $query['categories'] ?? []);
            $return['categories'] = $this->get_view_categories(new Request([]));
        }
        if (!isset($return['tags'])) {
            $query['tags'] = array_merge([], $query['tags'] ?? []);
            $return['tags'] = $this->get_view_tags(new Request([]));
        }
        if ($request->hasAny(['mid', 'mids'])) {
            $query['metas'] = array_merge([
                'mid' => $request->input('mid'),
                'mids' => explode(',', $request->input('mids')),
                "page_size" => PHP_INT_MAX
            ], $query['metas'] ?? []);
            $return['metas'] = $this->getReturn($this->select_meta_list(new Request($query['metas'])));
        }
        if (isset($return['content']) || $request->filled('cid')) {
            array_push($_logs, "parent set content or filled cid.");
            if (!isset($return['content']) && $request->filled('cid')) {
                $query['content'] = array_merge(['cid' => $request->input('cid')], $query['metas'] ?? []);
                $return['content'] = $this->getReturn($this->select_content_item(new Request($query['content'])));
            }
            unset($return['current_page'], $return['last_page']);
        } else if (!isset($return['contents'])) {
            array_push($_logs, "parent not set contents.");
            $query['contents'] = array_merge([
                'title' => $request->input('title'),
                'type' => $request->input('type', 'post'),
                'mid' => $request->input('mid'),
                'mids' => explode(',', $request->input('mids', '')),
                'status' => $request->input('status'),
                'page_size' => $request->input('page_size', 30),
                '$order' => ['updated_at'],
            ], $query['contents'] ?? []);
            $return['contents'] = $this->getReturn($this->select_content_list(new Request($query['contents'])));
            unset($return['query']['mid'], $return['query']['mids']);
            // var_dump($return['contents']);
        }
        if (isset($return['contents']) && $return['contents'] instanceof Paginator) {
            $return['last_page'] = $return['contents']->lastPage();
        }
        if (!isset($return['latest_contents'])) {
            $query['latest_contents'] = array_merge([], $query['latest_contents'] ?? []);
            $return['latest_contents'] = $this->get_view_latest_contents(new Request([]));
            // var_dump($return['latest_contents']);
        }
        if (!isset($return['toplist_contents'])) {
            $query['toplist_contents'] = array_merge([], $query['toplist_contents'] ?? []);
            $return['toplist_contents'] = $this->get_view_toplist_contents(new Request([]));
            // var_dump($return['toplist_contents']);
        }
        if (!isset($return['links'])) {
            $query['links'] = array_merge([], $query['links'] ?? []);
            $return['links'] = $this->getReturn($this->select_link_list(new Request()));
        }
        $return['$query'] = $query;
        echo "<script>window.\$data=" . json_encode($return, JSON_UNESCAPED_UNICODE) . "</script>";
        return view($return['view'], $return);
    }


    /**
     * OPEN /{prefix}/meta/{mid}
     * @param Request $request
     * @param $mid
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view_meta_item(Request $request, $mid)
    {
        $request->merge(['mid' => $mid]);
        return $this->view_index($request);
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.meta') ? $this->prefix . '.meta' : '_view.meta',
        ], $request->input('$return', []), );
        $return = array_merge($this->view_index($request)->getData(), $return);
        echo "<script>window.\$data=" . json_encode($return, JSON_UNESCAPED_UNICODE) . "</script>";
        return view($return['view'], $return);
    }

    public function view_meta_item_form(Request $request, $mid = 0)
    {
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.meta-form') ? $this->prefix . '.meta-form' : '_view.meta-form',
        ], $request->input('$return', []), );
        if ($request->method() === "GET") {
            $return['meta'] = $this->getReturn($this->select_meta_item(new Request(['mid' => $mid])));
        } elseif ($request->method() === "POST") {
            $return['meta'] = $this->getReturn($this->upsert_meta_item($request));
        }
        echo "<script>window.\$data=" . json_encode($return, JSON_UNESCAPED_UNICODE) . "</script>";
        return view($return['view'], $return);
    }

    /**
     * OPEN /{prefix}/content/{cid}
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view_content_item(Request $request, $cid = 0)
    {
        $_logs = [__METHOD__, ['$request->all()', $request->all()], $cid];
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.content') ? $this->prefix . '.content' : '_view.content',
        ], $request->input('$return', []), );
        if ((int) $cid === 0) {
            // 发现
            if (request()->filled('source') && request()->filled('url')) {
                array_push($_logs, "requset filled source and url");
                $source = (new SpiderController)->select_content_item(new Request(['cid' => request()->input('source')]));
                $return['source'] = $source;
                $content = $this->select_content_item(new Request(['slug' => request()->input('url')]));
                $spider = new PhpSpiderHelper;
                $url = $spider->fill_url(request()->input('url'), $source['slug']);
                $fields = $source->get_source_fields($source->text['detail'] ?? [], [], ["{{url}}" => $url]);
                // dump($fields);
                $return['fields'] = $fields;
                $return['config_fields'] = $fields;
                $spider::$configs['fields'] = $fields;
                // $spider = new PhpSpiderHelper(["fields" => $fields]);
                $fields = $spider->unit($url);
                $return['extracted_fields'] = $fields;
                // dump($fields);
                // exit;
                $content = $content->fill($fields['content'] ?? [])->toArray();
                if (sizeof($this->ContentModel::$fields) > 0) {
                    foreach (array_keys($this->ContentModel::$fields) as $field_key) {
                        $content[$field_key] = $fields['content'][$field_key] ?? [];
                    }
                }
                $fields['content'] = $content;
                // dump($fields);
                $return = array_merge($return, $fields, $this->import_tree(new Request((array) $fields, ["status" => $source['status']])));
                // exit;
            } else if ($request->has('random')) {
                $return['content'] = $this->getReturn($this->select_random_content_item(new Request(['status' => 'publish'])));
                $return['content']['_random'] = true;
                // var_dump($return);
                // var_dump($return);
            }
        } else {
            $request->merge(['cid' => $cid]);
            // $return = array_merge($this->view_index($request)->getData(), $return);
            // unset($return['current_page'], $return['last_page']);
        }
        $return["_logs"] = $_logs;
        $request->merge(['$return' => $return]);
        return $this->view_index($request);
        // dump($return);
        // exit;
        // echo "<script>window.\$data=" . json_encode($return, JSON_UNESCAPED_UNICODE) . "</script>";
        return view($return['view'], $return);
    }

    public function view_content_item_form(Request $request, $cid = 0)
    {
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.content-item-form') ? $this->prefix . '.content-item-form' : '_view.content-item-form',
        ], $request->input('$return', []), );
        if ((int) $cid === 0) {
            $return['content'] = new $this->ContentModel(['parent' => null]);
        }
        // $return['options'] = $this->get_view_options(new Request(['names' => [
        //   'content.form.default',
        //   'content.form.' . $this->prefix,
        //   'content.type.default',
        //   'content.type.' . $this->prefix,
        //   'content.type.options.default',
        //   'content.type.options.' . $this->prefix,
        //   'content.status.default',
        //   'content.status.' . $this->prefix,
        //   'content.status.options.default',
        //   'content.status.options.' . $this->prefix,
        //   'content.text.default',
        //   'content.text.' . $this->prefix,
        // ]]));
        $return['options'] = [
            'content.form.default' => config('options.content.form.default'),
            'content.form.' . $this->prefix => config('options.content.form.' . $this->prefix),
            'content.type.default' => config('options.content.type.default'),
            'content.type.' . $this->prefix => config('options.content.type.' . $this->prefix),
            'content.type.options.default' => config('options.content.type.options.default'),
            'content.type.options.' . $this->prefix => config('options.content.type.options.' . $this->prefix),
            'content.status.default' => config('options.content.status.default'),
            'content.status.' . $this->prefix => config('options.content.status.' . $this->prefix),
            'content.status.options.default' => config('options.content.status.options.default'),
            'content.status.options.' . $this->prefix => config('options.content.status.options.' . $this->prefix),
            'content.text.default' => config('options.content.text.default'),
            'content.text.' . $this->prefix => config('options.content.text.' . $this->prefix),
        ];
        $request->merge(['$return' => $return, 'cid' => $cid]);
        return $this->view_index($request);
    }
    public function view_content_list_form(Request $request)
    {
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.content-list-form') ? $this->prefix . '.content-list-form' : '_view.content-list-form',
        ], $request->input('$return', []), );
        $request->merge(['$return' => $return]);
        return $this->view_index($request);
    }
    public function view_field_item(Request $request, $field, $id)
    {
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.' . $field) ? $this->prefix . '.' . $field : '_view.' . $field,
        ], $request->input('$return', []), );
        if (request()->filled('source') && request()->filled('url')) {
            $source = (new SpiderController)->select_content_item(new Request(['cid' => request()->input('source')]));
            $return['source'] = $source;
            $field = $source->text[$field] ?? [];
            $spider = new PhpSpiderHelper;
            $url = $spider->fill_url(request()->input('url'), $source['slug']);

            $fields = $source->get_source_fields($field, [], ["{{url}}" => $url]);

            $spider = new PhpSpiderHelper(["fields" => $fields]);

            $fields = $spider->unit($url);
            $return['extracted_fields'] = $fields;
            $return = array_merge($return, $fields, $this->import_tree(new Request((array) $fields)) ?? []);
        } else {
        }
        $return['latest_contents'] = $this->get_view_latest_contents(new Request());
        $return['toplist_contents'] = $this->get_view_latest_contents(new Request());
        // var_dump($return);
        echo "<script>window.\$data=" . json_encode($return, JSON_UNESCAPED_UNICODE) . "</script>";
        return view($return['view'], $return);
    }

    /**
     * OPEN /{prefix}/discover/{cid}
     *
     * @param Request $request
     * @return void
     */
    public function view_spider_discover_list(Request $request)
    {
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.discover') ? $this->prefix . '.discover' : '_view.discover',
        ], $request->input('$return', []), );
        $return['sources'] = (new SpiderController)->select_content_list(new Request(['$where' => [], 'type' => "post_" . $this->prefix]));
        return view($return['view'], $return);
    }

    public function view_spider_search_list(Request $request)
    {
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.list') ? $this->prefix . '.list' : '_view.list',
        ], $request->input('$return', []), );
        $sources = (new SpiderController)->select_content_list(new Request(['$where' => [], 'type' => "post_" . $this->prefix]));
        $return['sources'] = [];
        foreach ($sources as $index => $source) {
            // var_dump($source);
            $search = $source['text']['search'] ?? null;
            if (empty($search))
                continue;
            // var_dump($search);
            $fields = $source->get_source_fields($search, ['url', '_url', 'urls', '_urls', 'groups', '_groups']);
            if (empty($fields))
                continue;
            // var_dump($fields);
            $spider = new PhpSpiderHelper(["fields" => $fields]);
            $url = $spider->fill_url($search['url'], $source['slug']);
            $url = str_replace(['{{search}}'], [$request->input('search', '')], (string) $url);
            // dump($url);
            $fields = $spider->unit($url);
            // dump($fields);
            // $sources[] = array_merge($source->toArray(), $fields, $this->import_tree(new Request((array)$fields)) ?? []);
            array_push($return['sources'], array_merge($source->toArray(), $fields, $this->import_tree(new Request((array) $fields)) ?? []));
        }
        echo "<script>window.\$data=" . json_encode($return, JSON_UNESCAPED_UNICODE) . "</script>";
        return view($return['view'], $return);
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function view_spider_discover_item(Request $request, $spider_cid, $discover_index = 0)
    {
        // dump(__METHOD__);
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.index') ? $this->prefix . '.index' : '_view.index',
            "current_page" => request()->input('page', '1'),
            "discover_index" => $discover_index,
            "last_page" => 1,
        ], $request->input('$return', []), );
        $source = (new SpiderController)->select_content_item(new Request(['cid' => $spider_cid]));
        $source->get_source_discover_urls();
        $return['source'] = $source;
        $discover = $source->text['discover'];
        $return['discover'] = $discover;
        $fields = $source->get_source_fields($discover, ['url', '_url', 'urls', '_urls', 'groups', '_groups', "_view"]);
        // var_dump($fields);
        // dump($fields,);

        $spider = new PhpSpiderHelper(["fields" => $fields]);
        $url = $source->get_source_discover_url($discover_index);
        $url = $spider->fill_url($url, $source['slug']);
        $url = str_replace('{{page}}', $return['current_page'], (string) $url);
        $fields = $spider->unit($url);
        // var_dump($fields);
        // exit;
        $fields['collection'] = [
            "name" => $source['title'],
            "description" => explode("::", $discover['urls'][$discover_index])[0],
            "slug" => $url,
            "ico" => $source['ico'],
            'type' => "collection",
            'status' => $source['status']
        ];
        // $result = $this->import_tree(new Request((array)$fields)) ?? [];
        // if ($result instanceof Exception) throw $result;

        // $collection = $this->import_tree(new Request(["meta" => $collection]));
        // dump($fields, $collection);
        // $contents = $source->unit();
        // dump($fields);
        $return = array_merge($return, $fields, $this->import_tree(new Request((array) $fields ?? []), ["type" => "post", "status" => $source['status']]));
        if ($return instanceof Exception)
            throw $return;
        // var_dump($return);
        // var_dump($return['contents']);
        $relationships = array_map(function ($content) use ($return) {
            return [
                $this->prefix . "_mid" => $return['collection']['mid'],
                $this->prefix . "_cid" => $content['cid'],
            ];
        }, $return['contents'] ?? []);
        // dump($relationships);
        if ($return['current_page'] == 1) {
            $this->RelationshipModel::where($this->prefix . "_mid", $return['collection']['mid'])->delete();
            $this->import_tree(new Request(["relationships" => $relationships]));
        }
        // $return = array_merge($return, []);
        // $return = array_merge($return, $fields);
        // $paginator = new Paginator($contents['data'] ?? [], 999, 1, []);
        // dump($paginator);
        // return view('video.list', [
        //   "spider" => $spider,
        //   "discover_index" => $discover_index,
        //   "contents" => $paginator,
        // ]);
        // dump($return);
        $request->merge(['$return' => $return]);
        return $this->view_index($request);
        // <!-- echo "<script>window.\$data=" . json_encode($return, JSON_UNESCAPED_UNICODE) . "</script>"; -->
        // return view($return['view'], $return);
    }
    public function view_options(Request $request)
    {
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.options') ? $this->prefix . '.options' : '_view.options',
        ], $request->input('$return', []), );
        echo "<script>window.\$data=" . json_encode($return, JSON_UNESCAPED_UNICODE) . "</script>";
        return view($return['view'], $return);
    }

    /**
     * OPEN /{prefix}/404
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view_404(Request $request)
    {
        $return = array_merge([
            "prefix" => $this->prefix ?? 'home',
            "view" => View::exists($this->prefix . '.404') ? $this->prefix . '.404' : '_view.404',
        ], $request->input('$return', []), );
        echo "<script>window.\$data=" . json_encode($return, JSON_UNESCAPED_UNICODE) . "</script>";
        return view($return['view'], $return);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view_exists(Request $request)
    {
    }

    /**
     * OPEN /{prefix}/tree/{slug}
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view_tree(Request $request)
    {
    }
}

trait BaseImportTree
{
    public function import_tree(Request $request, $global_default = [])
    {
        // var_dump($global_default);
        // TODO 集中其它方法至此方法
        try {
            $_logs = [__METHOD__, $request->all()];
            // dump($_logs);
            $mapping = $this->getImportMapping();
            // dump(__METHOD__);
            $return = [];

            foreach ($mapping as $key => $funcs) {
                $func = '';
                $type = 'object';
                $default = [];
                if (is_string($funcs))
                    $func = $funcs;
                if (is_array($funcs)) {
                    $func = $funcs[0];
                    $type = $funcs[1] ?? $type;
                    $default = $funcs[2] ?? $default;
                }
                if ($request->filled($key)) {
                    // var_dump($key);
                    // var_dump($func);
                    // var_dump($type);
                    // var_dump($default);
                    $data = new Request();
                    switch ($type) {
                        // 主键
                        case 'primaryKey':
                            $request->merge($default);
                            $data = new Request(array_merge($global_default, $request->all()));
                            $return = method_exists($this, $func) ? $this->getReturn($this->{$func}($data)) : $return;
                            if ($return instanceof Exception)
                                throw $return;
                            break;
                        case 'object':
                            $data = $request->input($key, []);
                            // var_dump($data);
                            $data = new Request(array_merge($global_default, $data, $default));
                            $return[$key] = method_exists($this, $func) ? $this->getReturn($this->{$func}($data)) : $return;
                            if ($return[$key] instanceof Exception)
                                throw $return[$key];
                            break;
                        case 'array':
                            $data = $request->input($key, []);
                            $data = new Request([
                                "data" => array_map(function ($item) use ($default, $global_default) {
                                    return array_merge($global_default, $item, $default);
                                }, $data)
                            ]);
                            // var_dump($global_default);
                            // var_dump($data->input('data'));
                            $return[$key] = method_exists($this, $func) ? $this->getReturn($this->{$func}($data)) : $return;
                            if ($return[$key] instanceof Exception)
                                throw $return[$key];
                            $return[$key] = $return[$key]['data'];
                            break;
                        default:
                            break;
                    }
                }
            }
            return $this->success($return);
            // if ($request->hasAny(['mid', 'mids', 'meta', 'metas'])) {
            // }
            // if ($request->hasAny(['cid', 'cids', 'content', 'contents'])) {
            //   $this->import_content_tree($request);
            // }
            if ($request->hasAny(['id', 'ids', 'field', 'fields'])) {
            }
            if ($request->filled('mid')) {
                array_push($_logs, 'request filled mid.');
                $return = array_merge($return, $this->getReturn($this->upsert_meta_item($request)));
            } elseif ($request->filled('cid')) {
                if ($request->filled('id')) {
                    // Field
                    $return = array_merge($return, $this->getReturn($this->upsert_field_item($request)));
                } else {
                    // Content
                    $return = array_merge($return, $this->getReturn($this->upsert_content_item($request)));
                }
            } elseif ($request->filled('lid')) {
                array_push($_logs, 'request filled lid.');
                $return = $request->input('lid');
            }
            if ($request->filled('relationships')) {
                array_push($_logs, 'request filled relationships.');
                $return['relationships'] = [];
            }
            if ($request->filled('meta')) {
                array_push($_logs, 'request filled meta.');
                $return['meta'] = $this->getReturn($this->upsert_meta_item(new Request($request->input('meta'))));
            }
            if ($request->filled('metas')) {
                array_push($_logs, 'request filled metas.');
                $return['metas'] = $this->getReturn($this->upsert_meta_list(new Request(["data" => $request->input('metas')])))['data'];
            }
            if ($request->filled('content')) {
                array_push($_logs, 'request filled key(content).');
                $return['content'] = $this->getReturn($this->upsert_content_item(new Request($request->input('content'))));
            }
            if ($request->filled('contents')) {
                $upserted_content_list = $this->getReturn($this->upsert_content_list(new Request(["data" => $request->input('contents')])));
                // dump($_logs);
                // dump($upserted_content_list);
                if ($upserted_content_list instanceof Exception)
                    throw $upserted_content_list;
                array_push($_logs, [
                    'request filled key(contents).',
                    '$this->upsert_content_list',
                    $upserted_content_list['_logs'],
                ]);
                // dump($_logs);
                $return['contents'] = $upserted_content_list['data'];
                // if (isset($return['mid'])) {
                //   $relationships = array_map(function ($content) use ($return) {
                //     return [
                //       $this->prefix . '_cid' => $content['cid'],
                //       $this->prefix . '_mid' => $return['mid'],
                //     ];
                //   }, $return['contents']);
                //   $this->RelationshipModel::insertOrIgnore($relationships);
                // }
                // if (isset($return['lid'])) {
                // }
            }
            if ($request->filled('link')) {
                array_push($_logs, 'request filled link.');
                $return['link'] = [];
            }
            if ($request->filled('links')) {
                array_push($_logs, 'request filled links.');
                $return['links'] = [];
            }
            // dump($_logs);
            // artisan_dump($_logs);
            return $this->success($return);
        } catch (Exception $e) {
            // var_dump($_logs);

            $this->error($e);
        }
    }

    public function import_meta_tree()
    {
    }

    public function import_content_tree(Request $request)
    {
        try {
            dump(__METHOD__, $request);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function import_field_tree()
    {
    }
}

trait BaseCron
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function cron(Request $request)
    {
    }
}

trait BaseGetViewShared
{
    function get_view_categories(Request $request)
    {
        return $this->getReturn($this->select_meta_tree(new Request([
            'parent' => 0,
            'type' => 'category'
        ])));
    }

    function get_view_tags(Request $request)
    {
        return $this->getReturn($this->select_meta_list(new Request([
            'type' => 'tag',
            'page' => 1,
            'page_size' => PHP_INT_MAX,
        ])));
    }

    function get_view_latest_contents(Request $request)
    {
        return $this->getReturn($this->select_content_list(new Request([
            'type' => 'post',
            '$order' => ['updated_at'],
            'page' => 1,
            'page_size' => 10
        ])));
    }

    function get_view_toplist_contents(Request $request)
    {
        return $this->getReturn($this->select_content_list(new Request([
            'type' => 'post',
            '$order' => ['views'],
            'page' => 1,
            'page_size' => 10
        ])));
    }
    function get_view_options(Request $request)
    {
        $result = $this->OptionModel::whereIn('name', $request->input('names', []))->get();
        $result = $result->map(function ($item) {
            return $item->toArray();
        });
        return $result->pluck('value', 'name');
    }
}
