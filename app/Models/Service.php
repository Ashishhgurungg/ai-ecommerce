<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'price',
    ];

    //ratings() gives you a relationship query for all rating records belonging to the current service, using its service_id.
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    //getAverageRatingAttribute calculates the average rating of this current service 
    public function getAverageRatingAttribute()
    {
        return round($this->ratings()->avg('rating') ?? 0, 1);
    }

    public function getRatingCountAttribute()
    {
        return $this->ratings()->count();
    }
}
