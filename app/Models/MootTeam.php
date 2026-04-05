<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MootTeam extends Model
{
    protected $fillable = [
        'participation_id',
        'team_name',
        'team_name_local',
        'coach_name',
        'coach_email',
        'coach_image',
        'advisor_name',
        'advisor_image',
        'mentor_name',
        'mentor_image',
        'team_type',
        'round_reached',
        'result_en',
        'result_km',
        'awards_en',
        'awards_km',
        'notes',
        'display_order',
    ];

    protected $casts = [
        'round_reached' => 'integer',
        'display_order' => 'integer',
    ];

    public function participation(): BelongsTo
    {
        return $this->belongsTo(MootParticipation::class, 'participation_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(MootTeamMember::class, 'team_id')->orderBy('order');
    }

    public function getResultAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->result_km : $this->result_en;
    }

    public function getAwardsAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->awards_km : $this->awards_en;
    }

    public function getLeadSpeaker(): ?MootTeamMember
    {
        return $this->members()->where('is_team_lead', true)->first();
    }

    public function getSpeakers(): array
    {
        return $this->members()->where('role', 'speaker')->orderBy('order')->get()->toArray();
    }

    public function scopeMainTeams($query)
    {
        return $query->where('team_type', 'main');
    }

    public function scopeByRound($query, int $round)
    {
        return $query->where('round_reached', '>=', $round);
    }

    public static function getTeamTypes(): array
    {
        return [
            'main' => 'Main Team',
            'reserve' => 'Reserve Team',
            'unofficial' => 'Unofficial',
        ];
    }

    public static function getRoundNames(): array
    {
        return [
            1 => 'Preliminary',
            2 => 'Quarterfinal',
            3 => 'Semifinal',
            4 => 'Final',
            5 => 'Champion',
        ];
    }
}
