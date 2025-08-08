<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogAttachment extends Model
{
    protected $fillable = [
        'blog_id',
        'file_path',
        'file_name',
        'mime_type',
    ];
}
