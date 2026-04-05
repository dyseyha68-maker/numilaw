<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartnerUniversity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'faculty_or_school',
        'logo',
        'official_website',
        'description',
        'status',
    ];

    public function activities(): HasMany
    {
        return $this->hasMany(PartnerActivity::class)->orderBy('activity_date', 'desc');
    }

    public function publicActivities(): HasMany
    {
        return $this->hasMany(PartnerActivity::class)
            ->where('visibility', 'public')
            ->orderBy('activity_date', 'desc');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function getActivityTypes(): array
    {
        return [
            'mou' => 'MoU Signing',
            'study_visit' => 'Study Visit',
            'exchange' => 'Academic Exchange',
            'seminar' => 'Seminar',
            'workshop' => 'Workshop',
            'meeting' => 'Courtesy Meeting',
            'conference' => 'Conference',
            'other' => 'Other',
        ];
    }

    public function getTypeLabel(string $type): string
    {
        return $this->getActivityTypes()[$type] ?? $type;
    }
}
