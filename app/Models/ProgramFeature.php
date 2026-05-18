<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramFeature extends Model
{
    protected $table = 'program_features';

    protected $fillable = [
        'name_en', 'name_ar',
        'description_en', 'description_ar',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];
}
