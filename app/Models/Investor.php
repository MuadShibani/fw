<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $table = 'investors';

    protected $fillable = [
        'name_en', 'name_ar',
        'role_en', 'role_ar',
        'bio_en', 'bio_ar',
        'image_url', 'linkedin_url', 'twitter_url',
    ];
}
