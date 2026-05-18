<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WiifMember extends Model
{
    protected $table = 'wiif_members';

    protected $fillable = [
        'type',
        'name_en', 'name_ar',
        'role_en', 'role_ar',
        'bio_en', 'bio_ar',
        'image_url',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function scopeGps($q)
    {
        return $q->where('type', 'gp')->orderBy('sort_order')->orderBy('id');
    }

    public function scopeCommittee($q)
    {
        return $q->where('type', 'committee')->orderBy('sort_order')->orderBy('id');
    }
}
