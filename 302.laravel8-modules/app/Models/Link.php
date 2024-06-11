<?php

namespace App\Models;


class Link extends \App\Support\Model
{

    protected $table = "links";

    protected $primaryKey = 'lid';

    protected $fillable = [
        'title',
        'slug',
        'ico',
        'description',
        'type',
        'status',
        'parent',
        'count',
        'order',
        'created_at',
        'updated_at',
        'release_at',
        'deleted_at',
    ];

}