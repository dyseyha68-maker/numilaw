<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MootParticipation extends Model
{
    protected $fillable = [
        'moot_id',
        'year',
        'theme_en',
        'theme_km',
        'case_problem_en',
        'case_problem_km',
        'competition_start_date',
        'competition_end_date',
        'venue',
        'host_city',
        'host_country',
        'status',
        'summary_en',
        'summary_km',
        'is_published',
        'is_featured',
        'result_en',
        'result_km',
        'achievements_en',
        'achievements_km',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'competition_start_date' => 'date',
        'competition_end_date' => 'date',
        'year' => 'integer',
    ];

    public function moot(): BelongsTo
    {
        return $this->belongsTo(Moot::class, 'moot_id');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(MootActivity::class, 'participation_id')->orderBy('order');
    }

    public function teams(): HasMany
    {
        return $this->hasMany(MootTeam::class, 'participation_id')->orderBy('display_order');
    }

    public function getNameAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->moot->getNameAttribute($locale) . ' ' . $this->year;
    }

    public function getThemeAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->theme_km : $this->theme_en;
    }

    public function getSummaryAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->summary_km : $this->summary_en;
    }

    public function getResultAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->result_km : $this->result_en;
    }

    public function getAchievementsAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->achievements_km : $this->achievements_en;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByYear($query, int $year)
    {
        return $query->where('year', $year);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
