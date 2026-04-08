<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $primaryKey = 'page_key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'page_key', 'title_en', 'title_ar',
        'subtitle_en', 'subtitle_ar',
        'content_en', 'content_ar',
        'image_url', 'custom_fields',
    ];

    protected $casts = [
        'custom_fields' => 'array',
    ];
}
