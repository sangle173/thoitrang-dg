<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_description', 'status'];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
// In PortfolioCategory.php
public function scopeActive($query)
{
    return $query->where('status', true);
}
    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }
    protected static function booted()
    {
        static::saving(function ($model) {
            $model->slug = \Str::slug($model->name);
        });
    }
}
