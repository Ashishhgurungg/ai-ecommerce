<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'images',
    ];
    protected $casts = [
        'images' => 'array',
    ];
}
