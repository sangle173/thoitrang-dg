<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'location', 'avatar', 'rating', 'content', 'order',
    ];

}
