<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSetting extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'button_text',
        'button_link',
        'image',
    ];
}
