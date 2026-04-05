<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MootTeamMember extends Model
{
    protected $fillable = [
        'team_id',
        'name_en',
        'name_km',
        'email',
        'phone',
        'image',
        'role',
        'order',
        'is_team_lead',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_team_lead' => 'boolean',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(MootTeam::class, 'team_id');
    }

    public function getNameAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->name_km : $this->name_en;
    }

    public function scopeByRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    public function scopeSpeakers($query)
    {
        return $query->where('role', 'speaker');
    }

    public function scopeResearchers($query)
    {
        return $query->where('role', 'researcher');
    }

    public static function getRoles(): array
    {
        return [
            'speaker' => 'Speaker',
            'researcher' => 'Researcher',
            'reserve' => 'Reserve',
            'coach' => 'Coach',
            'observer' => 'Observer',
        ];
    }
}
