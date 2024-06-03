<?php

namespace App\Models;

class Field extends \App\Support\Model
{

    protected $table = "fields";

    // protected $primaryKey = 'id';

    protected $fillable = [

    ];


    public function content()
    {
        return $this->belongsTo(\App\Models\Content::class, 'cid', 'cid');
    }

    public function toArray()
    {
        $return = parent::toArray();
        switch ($return['type']) {
            case "float":
                $return['value'] = $return['float_value'];
                break;
            case "int":
                $return['value'] = $return['int_value'];
                break;
            case "str":
                $return['value'] = $return['str_value'];
                break;
            case "text":
                $return['value'] = $return['text_value'];
                break;
            case "object":
                $return['value'] = json_decode($return['object_value'], true);
                break;
        }
        return $return;
    }
}