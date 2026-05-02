<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable =[
        'name',
        'email',
        'message',
        'phone',
        'subject',
        'company',
        'country',
        'job_title',
        'job_details',
    ];
}
