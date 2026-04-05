<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionApplication extends Model
{
    protected $table = 'admission_applications';

    protected $fillable = [
        'reference_number',
        'intake_id',
        'program_id',
        'full_name_en',
        'full_name_kh',
        'date_of_birth',
        'gender',
        'nationality',
        'id_card_number',
        'phone',
        'email',
        'address_en',
        'address_kh',
        'previous_school_en',
        'previous_school_kh',
        'graduation_year',
        'gpa',
        'certificate_path',
        'id_card_path',
        'photo_path',
        'transcript_path',
        'recommendation_letter_path',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
        'submitted_at',
        'ip_address',
    ];

    protected $casts = [
        'status' => 'string',
        'date_of_birth' => 'date',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            if (empty($application->reference_number)) {
                $maxId = static::max('id') ?? 0;
                $application->reference_number = 'NUM-LAW-' . date('Y') . '-' . str_pad($maxId + 1, 5, '0', STR_PAD_LEFT);
            }
        });
    }

    public function intake()
    {
        return $this->belongsTo(AdmissionIntake::class, 'intake_id');
    }

    public function program()
    {
        return $this->belongsTo(AdmissionProgram::class, 'program_id');
    }

    public function statusLogs()
    {
        return $this->hasMany(AdmissionStatusLog::class, 'application_id')->orderBy('created_at', 'desc');
    }

    public function getStatusBadgeColorAttribute()
    {
        return match($this->status) {
            'draft' => 'bg-secondary',
            'submitted' => 'bg-info',
            'under_review' => 'bg-warning',
            'accepted' => 'bg-success',
            'rejected' => 'bg-danger',
            'withdrawn' => 'bg-dark',
            default => 'bg-secondary',
        };
    }
}
