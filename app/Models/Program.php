<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'title_en', 'title_ar',
        'description_en', 'description_ar',
        'color', 'path', 'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
