<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartnerActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_university_id',
        'title',
        'type',
        'description',
        'activity_date',
        'location',
        'visibility',
    ];

    protected $casts = [
        'activity_date' => 'date',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(PartnerUniversity::class, 'partner_university_id');
    }

    public function isPublic(): bool
    {
        return $this->visibility === 'public';
    }

    public function getTypeLabel(): string
    {
        $types = [
            'mou' => 'MoU Signing',
            'study_visit' => 'Study Visit',
            'exchange' => 'Academic Exchange',
            'seminar' => 'Seminar',
            'workshop' => 'Workshop',
            'meeting' => 'Courtesy Meeting',
            'conference' => 'Conference',
            'other' => 'Other',
        ];

        return $types[$this->type] ?? $this->type;
    }

    public function getYear(): int
    {
        return $this->activity_date->year;
    }

    public function getTypeIcon(): string
    {
        $icons = [
            'mou' => 'bi-file-text',
            'study_visit' => 'bi-book',
            'exchange' => 'bi-arrow-left-right',
            'seminar' => 'bi-people',
            'workshop' => 'bi-gear',
            'meeting' => 'bi-cup',
            'conference' => 'bi-building',
            'other' => 'bi-asterisk',
        ];

        return $icons[$this->type] ?? 'bi-circle';
    }
}
