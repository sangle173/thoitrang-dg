<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_description', 'status'];
// In ServiceCategory.php
public function scopeActive($query)
{
    return $query->where('status', true);
}
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            $model->slug = \Str::slug($model->name);
        });
    }
}
