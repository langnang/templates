<?php

namespace Modules\Quote\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuoteContent extends \App\Models\Content
{
    protected static function newFactory()
    {
        return \Modules\Quote\Database\factories\QuoteContentFactory::new();
    }

    public function entries()
    {
        return $this->hasMany(QuoteEntry::class, $this->primaryKey, $this->primaryKey);
    }
}
