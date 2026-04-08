<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = [
        'date', 'title_en', 'title_ar',
        'summary_en', 'summary_ar',
        'content_en', 'content_ar',
        'author_en', 'author_ar',
        'image_en', 'image_ar',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
