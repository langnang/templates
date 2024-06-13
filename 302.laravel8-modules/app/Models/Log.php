<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    protected $table = "logs";

    protected $fillable = [
        'instance',
        'channel',
        'level',
        'level_name',
        'message',
        'context',
        'remote_addr',
        'user_agent',
        'created_by',
        'created_at',
    ];

    protected $casts = [
        "context" => "array",
        'created_at' => 'datetime',
    ];
}