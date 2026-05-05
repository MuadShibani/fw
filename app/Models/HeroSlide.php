<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $table = 'hero_slides';

    protected $fillable = [
        'title_en', 'title_ar',
        'subtitle_en', 'subtitle_ar',
        'image_url',
        'cta_label_en', 'cta_label_ar', 'cta_link',
        'sort_order', 'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active'  => 'boolean',
    ];
}
