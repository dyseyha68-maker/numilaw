<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'first_name_en',
        'last_name_en',
        'first_name_km',
        'last_name_km',
        'email',
        'phone',
        'date_of_birth',
        'nationality',
        'address',
        'high_school',
        'graduation_year',
        'gpa',
        'english_level',
        'motivation_letter',
        'experience',
        'achievements',
        'reference_name',
        'reference_email',
        'reference_phone',
        'application_reference',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'graduation_year' => 'integer',
        'gpa' => 'decimal:2',
        'reviewed_at' => 'datetime',
    ];

    public function program()
    {
        return $this->belongsTo(AcademicProgram::class, 'program_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name_en . ' ' . $this->last_name_en;
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Pending',
            'reviewing' => 'Reviewing',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getEnglishLevelLabelAttribute()
    {
        $levels = [
            'beginner' => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced' => 'Advanced',
            'fluent' => 'Fluent',
        ];
        return $levels[$this->english_level] ?? $this->english_level;
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
