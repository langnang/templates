<?php

namespace Modules\Website\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebsiteField extends \App\Models\Field
{
    protected static function newFactory()
    {
        return \Modules\Website\Database\factories\WebsiteFieldFactory::new();
    }
}
