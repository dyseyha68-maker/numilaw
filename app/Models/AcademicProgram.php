<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alumni;

class AcademicProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_km',
        'slug',
        'degree_type',
        'description_en',
        'description_km',
        'admission_requirements_en',
        'admission_requirements_km',
        'curriculum_en',
        'curriculum_km',
        'duration_years',
        'credits_required',
        'tuition_fee',
        'featured_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'duration_years' => 'integer',
        'tuition_fee' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title_en');
    }

    public function scopeByDegreeType($query, $type)
    {
        return $query->where('degree_type', $type);
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'km' ? $this->title_km : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'km' ? $this->description_km : $this->description_en;
    }

    public function getAdmissionRequirementsAttribute()
    {
        return app()->getLocale() === 'km' ? $this->admission_requirements_km : $this->admission_requirements_en;
    }

    public function getCurriculumAttribute()
    {
        return app()->getLocale() === 'km' ? $this->curriculum_km : $this->curriculum_en;
    }

    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'program_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function academicCalendars()
    {
        return $this->hasMany(AcademicCalendar::class, 'program_id');
    }

    public function getDegreeTypeDisplayAttribute()
    {
        $types = [
            'bachelor' => app()->getLocale() === 'km' ? 'បរិញ្ញាបត្រ' : 'Bachelor\'s Degree',
            'master' => app()->getLocale() === 'km' ? 'អនុបណ្ឌិត' : 'Master\'s Degree',
            'doctorate' => app()->getLocale() === 'km' ? 'បណ្ឌិត' : 'Doctorate',
            'certificate' => app()->getLocale() === 'km' ? 'វិញ្ញាបនបត្រ' : 'Certificate',
        ];

        return $types[$this->degree_type] ?? $this->degree_type;
    }
}
