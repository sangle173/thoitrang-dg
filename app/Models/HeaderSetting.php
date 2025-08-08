<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderSetting extends Model
{
    protected $fillable = [
        'logo', 'phone', 'email', 'address', 'working_hours',
        'facebook_url', 'youtube_url', 'zalo_url', 'tiktok_url',
        'slogan', 'footer_copyright'
    ];


}
