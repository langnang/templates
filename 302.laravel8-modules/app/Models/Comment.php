<?php

namespace App\Models;

class Comment extends \App\Support\Model
{
    protected $table = "comments";

    protected $primaryKey = 'coid';

    protected $fillable = [];

}