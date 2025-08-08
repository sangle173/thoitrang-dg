<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'headline', 'subheadline', 'note', 'button_text',
    ];
}
