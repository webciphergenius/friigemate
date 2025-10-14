<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscription extends Model
{
    protected $fillable = [
        'email',
        'ip_address',
        'emailed',
        'active',
        'subscribed_at',
        'unsubscribed_at'
    ];

    protected $casts = [
        'emailed' => 'boolean',
        'active' => 'boolean',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime'
    ];
}
