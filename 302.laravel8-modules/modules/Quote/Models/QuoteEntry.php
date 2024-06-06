<?php

namespace Modules\Quote\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuoteEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        "cid",
        "name",
        "text",
        "type",
        "status",
    ];

    protected static function newFactory()
    {
        return \Modules\Quote\Database\factories\QuoteEntryFactory::new();
    }
}
