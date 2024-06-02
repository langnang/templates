<?php

namespace App\Models;


class Content extends \App\Support\Model
{
    protected $table = "contents";

    protected $primaryKey = 'cid';

    protected $fillable = [
        'title',
        'slug',
        'ico',
        'url',
        // 'description',
        'text',
        'type',
        'status',
        'user',
        'parent',
        'count',
        'order',
        'options',
        'suggestion',
        'release_at',
        'download_urls',
    ];
    protected $casts = [
        'release_at' => 'datetime',
        'options' => 'array',
        'download_urls' => 'array',
    ];
    /**
     * Summary of latest
     * @param mixed $perPage
     * @param mixed $columns
     * @param mixed $pageName
     * @param mixed $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function latest_updated($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return self::latest("updated_at")->paginate($perPage, $columns, $pageName, $page);
    }
    public static function hottest($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return self::orderBy("views", "desc")->paginate($perPage, $columns, $pageName, $page);
    }

    public static function toplist($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return self::paginate($perPage, $columns, $pageName, $page);
    }
    public static function recommend($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return self::paginate($perPage, $columns, $pageName, $page);
    }
    public static function collection($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return self::paginate($perPage, $columns, $pageName, $page);
    }
}