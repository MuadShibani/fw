<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WiifPortfolio extends Model
{
    protected $table = 'wiif_portfolio';

    protected $fillable = [
        'name',
        'sector_en', 'sector_ar',
        'description_en', 'description_ar',
        'logo_url', 'investment_date',
    ];

    protected $casts = [
        'investment_date' => 'date',
    ];
}
