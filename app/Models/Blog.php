<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function attachments()
    {
        return $this->hasMany(BlogAttachment::class);
    }
}
