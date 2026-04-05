<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClub extends Model
{
    protected $fillable = [
        'name_en',
        'name_kh',
        'description_en',
        'description_kh',
        'logo',
        'president_name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
