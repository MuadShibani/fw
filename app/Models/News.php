<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'date', 'title_en', 'title_ar',
        'summary_en', 'summary_ar',
        'category', 'image_en', 'image_ar',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
