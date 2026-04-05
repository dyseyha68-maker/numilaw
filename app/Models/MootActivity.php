<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MootActivity extends Model
{
    protected $fillable = [
        'participation_id',
        'title_en',
        'title_km',
        'description_en',
        'description_km',
        'activity_date',
        'location',
        'activity_type',
        'order',
        'is_completed',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'order' => 'integer',
        'is_completed' => 'boolean',
    ];

    public function participation(): BelongsTo
    {
        return $this->belongsTo(MootParticipation::class, 'participation_id');
    }

    public function getTitleAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->title_km : $this->title_en;
    }

    public function getDescriptionAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->description_km : $this->description_en;
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('activity_type', $type);
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('is_completed', false)->orderBy('activity_date');
    }

    public static function getActivityTypes(): array
    {
        return [
            'training' => 'Training',
            'submission' => 'Submission',
            'preliminary' => 'Preliminary Round',
            'quarterfinal' => 'Quarterfinal',
            'semifinal' => 'Semifinal',
            'final' => 'Final',
            'ceremony' => 'Ceremony',
            'announcement' => 'Announcement',
            'meeting' => 'Meeting',
            'other' => 'Other',
        ];
    }
}
