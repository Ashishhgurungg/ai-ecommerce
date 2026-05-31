<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class EventRegistration extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
