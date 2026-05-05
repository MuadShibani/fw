<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $table = 'cohorts';

    protected $fillable = [
        'name_en', 'name_ar',
        'status', 'start_date', 'end_date',
        'startups_count', 'startups_list',
    ];

    protected $casts = [
        'start_date'     => 'date',
        'end_date'       => 'date',
        'startups_count' => 'integer',
        'startups_list'  => 'array',
    ];
}
