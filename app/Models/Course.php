<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'year',
        'semester',
        'code',
        'name_en',
        'name_km',
        'description_en',
        'description_km',
        'credits',
        'phase',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'year' => 'integer',
        'semester' => 'integer',
        'credits' => 'integer',
        'sort_order' => 'integer',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(AcademicProgram::class, 'program_id');
    }

    public function scopeForProgram($query, $programId)
    {
        return $query->where('program_id', $programId);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeBySemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getPhaseLabelAttribute(): string
    {
        $phases = [
            'Foundation' => app()->getLocale() === 'km' ? ' មូលដ្ឋាន' : 'Foundation',
            'Development' => app()->getLocale() === 'km' ? ' អភិវឌ្ឍ' : 'Development',
            'Specialization' => app()->getLocale() === 'km' ? ' ឯកទេស' : 'Specialization',
            'Capstone' => app()->getLocale() === 'km' ? ' ប្រការប្រឡង' : 'Capstone',
        ];
        return $phases[$this->phase] ?? $this->phase;
    }
}
