<?php

namespace App\Models;


class Link extends \App\Support\Model
{

    protected $table = "_links";

    protected $primaryKey = 'lid';

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\LinkFactory::new();
    }
}