<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    protected $table = 'startups';

    protected $fillable = [
        'name', 'sector',
        'description_en', 'description_ar',
        'logo_url', 'stage', 'founder_name',
    ];
}
