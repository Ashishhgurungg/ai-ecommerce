<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EventRegistration;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date',
        'image_path', // Store only the filename
        'price',
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
