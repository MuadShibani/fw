<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title_en', 'title_ar',
        'description_en', 'description_ar',
        'event_date', 'event_time',
        'location_en', 'location_ar',
        'type', 'is_virtual',
        'capacity', 'registered_count', 'registration_link',
    ];

    protected $casts = [
        'event_date'       => 'date',
        'is_virtual'       => 'boolean',
        'capacity'         => 'integer',
        'registered_count' => 'integer',
    ];
}
