<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'description',
        'short_description',
        'order',
        'portfolio_category_id',
        'location',
        'is_featured',
        'order',
        'image',
        'slug',
        'created_by', // ✅ add this line
    ];


    protected static function booted()
    {
        static::saving(function ($service) {
            if (empty($service->slug)) {
                $service->slug = \Str::slug($service->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\PortfolioCategory::class, 'portfolio_category_id');
    }

    public function images()
    {
        return $this->hasMany(\App\Models\PortfolioImage::class)->orderBy('order');
    }
    /**
     * Get the category that owns the portfolio.
     */
    public function portfolioCategory()
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }

    public function attachments()
    {
        return $this->hasMany(\App\Models\Attachment::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
