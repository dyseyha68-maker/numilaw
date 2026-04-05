<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionIntake extends Model
{
    protected $fillable = [
        'intake_name_en',
        'intake_name_kh',
        'program_id',
        'application_start',
        'application_end',
        'semester_start',
        'max_seats',
        'is_open',
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'application_start' => 'date',
        'application_end' => 'date',
        'semester_start' => 'date',
    ];

    public function program()
    {
        return $this->belongsTo(AdmissionProgram::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeOpen($query)
    {
        return $query->where('is_open', true)
            ->where('application_end', '>=', now()->toDateString());
    }

    public function getApplicationCountAttribute()
    {
        return $this->applications()->count();
    }
}
