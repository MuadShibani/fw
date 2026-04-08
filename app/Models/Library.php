<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table = 'library';

    protected $fillable = [
        'title_en', 'title_ar',
        'description_en', 'description_ar',
        'type', 'url', 'file_date', 'size',
    ];

    protected $casts = [
        'file_date' => 'date',
    ];
}
