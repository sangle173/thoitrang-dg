<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'short_description',
        'order',
        'slug',
        'thumbnail',
    ];

    protected static function booted()
    {
        static::saving(function ($service) {
            if (empty($service->slug)) {
                $service->slug = \Str::slug($service->title);
            }
        });
    }
}
