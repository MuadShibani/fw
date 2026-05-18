<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramMilestone extends Model
{
    protected $table = 'program_milestones';

    protected $fillable = [
        'title_en', 'title_ar',
        'activities_en', 'activities_ar',
        'output_en', 'output_ar',
        'timeline_en', 'timeline_ar',
        'icon', 'color',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];
}
