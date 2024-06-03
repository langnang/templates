<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Option extends \App\Support\Model
{
    public $table = 'options';
    public $incrementing = false;
    protected $hidden = [
        'user',
        'id',
    ];
    protected $fillable = [
        'name',
        'user',
        'type',
        'value',
        'created_at',
        'updated_at',
        'release_at',
        'deleted_at'
    ];

    public function toArray()
    {
        $return = parent::{__FUNCTION__}();
        // dump(__FUNCTION__);
        if (in_array($return['type'], ['json', 'array', 'object'], )) {
            $return['value'] = unserialize($this->value);
        }
        return $return;
    }
}