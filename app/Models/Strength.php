<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Strength extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'order',
    ];
}
