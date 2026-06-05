<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Status extends Model
{
    protected $fillable = [
        'status',
        'review_id',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
