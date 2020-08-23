<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'model_id',
        'model',
        'event_type',
        'data',
        'range'
    ];

    protected $casts = [
        'data' => 'array'
    ];
}
