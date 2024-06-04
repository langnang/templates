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
    public function metas()
    {
        return $this
            ->hasMany(\App\Models\Relationship::class, $this->primaryKey, $this->primaryKey)
            ->leftJoin("metas", "relationships.mid", '=', "metas.mid");
    }

    public function links()
    {
        return $this
            ->hasMany(\App\Models\Relationship::class, $this->primaryKey, $this->primaryKey)
            ->leftJoin("links", "relationships.lid", '=', "links.lid");
    }

    public function relationships()
    {
        return $this->hasMany(\App\Models\Relationship::class, $this->primaryKey, $this->primaryKey);
    }
    public function fields()
    {
        return $this->hasMany(\App\Models\Field::class, $this->primaryKey, $this->primaryKey);
    }
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, $this->primaryKey, $this->primaryKey);
    }

    public function toArray()
    {
        $return = parent::toArray();

        foreach ($return['fields'] ?? [] as $index => $field) {
            $return['fields'][$field['name']] = (new \App\Models\Field($field))->toArray();
            unset($return['fields'][$index]);
        }
        return $return;
    }
}