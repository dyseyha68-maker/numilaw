<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionProgram extends Model
{
    protected $fillable = [
        'name_en',
        'name_kh',
        'degree_level',
        'duration_en',
        'duration_kh',
        'description_en',
        'description_kh',
        'requirements_en',
        'requirements_kh',
        'tuition_en',
        'tuition_kh',
        'scholarship_available',
        'scholarship_info_en',
        'scholarship_info_kh',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'scholarship_available' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function intakes()
    {
        return $this->hasMany(AdmissionIntake::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByDegree($query, $level)
    {
        return $query->where('degree_level', $level);
    }

    public function openIntakes()
    {
        return $this->hasMany(AdmissionIntake::class)->open();
    }
}
