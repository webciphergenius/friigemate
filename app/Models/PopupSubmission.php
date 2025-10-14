<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupSubmission extends Model
{
    protected $fillable = [
        'user_name',
        'user_email',
        'ip_address',
        'emailed'
    ];

    protected $casts = [
        'emailed' => 'boolean'
    ];
}
