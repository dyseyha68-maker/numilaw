<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leadership extends Model
{
    use HasFactory;

    protected $table = 'leadership';

    protected $fillable = [
        'name',
        'position',
        'bio_en',
        'bio_km',
        'photo',
        'email',
        'phone',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function getBioAttribute()
    {
        return app()->getLocale() === 'km' ? $this->bio_km : $this->bio_en;
    }
}
