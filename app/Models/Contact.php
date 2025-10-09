<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'username',
        'email',
        'message',
        'ip_address',
        'emailed'
    ];

    protected $casts = [
        'emailed' => 'boolean',
    ];
}
