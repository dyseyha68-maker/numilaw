<?php

namespace App\Services;

use App\Models\Moot;
use App\Models\MootParticipation;
use App\Models\MootActivity;
use App\Models\MootTeam;
use App\Models\MootTeamMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MootService
{
    public function cloneParticipation(MootParticipation $sourceParticipation, int $newYear): MootParticipation
    {
        return DB::transaction(function () use ($sourceParticipation, $newYear) {
            $newParticipation = $sourceParticipation->replicate([
                'id',
                'created_at',
                'updated_at',
            ]);
            $newParticipation->year = $newYear;
            $newParticipation->status = 'planning';
            $newParticipation->is_published = false;
            $newParticipation->result_en = null;
            $newParticipation->result_km = null;
            $newParticipation->achievements_en = null;
            $newParticipation->achievements_km = null;
            $newParticipation->save();

            foreach ($sourceParticipation->activities as $activity) {
                $this->cloneActivity($activity, $newParticipation);
            }

            foreach ($sourceParticipation->teams as $team) {
                $this->cloneTeam($team, $newParticipation);
            }

            Log::info("Cloned moot participation from {$sourceParticipation->year} to {$newYear}");

            return $newParticipation;
        });
    }

    public function cloneActivity(MootActivity $sourceActivity, MootParticipation $newParticipation): MootActivity
    {
        $newActivity = $sourceActivity->replicate([
            'id',
            'created_at',
            'updated_at',
        ]);
        $newActivity->participation_id = $newParticipation->id;
        $newActivity->activity_date = null;
        $newActivity->is_completed = false;
        $newActivity->save();

        return $newActivity;
    }

    public function cloneTeam(MootTeam $sourceTeam, MootParticipation $newParticipation): MootTeam
    {
        $newTeam = $sourceTeam->replicate([
            'id',
            'created_at',
            'updated_at',
        ]);
        $newTeam->participation_id = $newParticipation->id;
        $newTeam->round_reached = null;
        $newTeam->result_en = null;
        $newTeam->result_km = null;
        $newTeam->awards_en = null;
        $newTeam->awards_km = null;
        $newTeam->save();

        foreach ($sourceTeam->members as $member) {
            $this->cloneMember($member, $newTeam);
        }

        return $newTeam;
    }

    public function cloneMember(MootTeamMember $sourceMember, MootTeam $newTeam): MootTeamMember
    {
        $newMember = $sourceMember->replicate([
            'id',
            'created_at',
            'updated_at',
        ]);
        $newMember->team_id = $newTeam->id;
        $newMember->save();

        return $newMember;
    }

    public function getPreviousYearParticipation(Moot $moot, int $year): ?MootParticipation
    {
        return MootParticipation::where('moot_id', $moot->id)
            ->where('year', '<', $year)
            ->orderBy('year', 'desc')
            ->first();
    }

    public function createParticipation(Moot $moot, int $year): MootParticipation
    {
        $existingParticipation = MootParticipation::where('moot_id', $moot->id)
            ->where('year', $year)
            ->first();

        if ($existingParticipation) {
            throw new \InvalidArgumentException("Participation for year {$year} already exists.");
        }

        return MootParticipation::create([
            'moot_id' => $moot->id,
            'year' => $year,
            'status' => 'planning',
        ]);
    }

    public function togglePublish(MootParticipation $participation): bool
    {
        $participation->is_published = !$participation->is_published;
        $participation->save();

        return $participation->is_published;
    }

    public function reorderActivities(MootParticipation $participation, array $activityIds): void
    {
        DB::transaction(function () use ($activityIds, $participation) {
            foreach ($activityIds as $order => $activityId) {
                MootActivity::where('id', $activityId)
                    ->where('participation_id', $participation->id)
                    ->update(['order' => $order]);
            }
        });
    }

    public function getStatistics(Moot $moot): array
    {
        $participations = $moot->participations;
        
        return [
            'total_participations' => $participations->count(),
            'first_year' => $participations->min('year'),
            'latest_year' => $participations->max('year'),
            'completed_competitions' => $participations->where('status', 'completed')->count(),
            'total_teams' => $participations->flatMap->teams->count(),
            'total_members' => $participations->flatMap->teams->flatMap->members->count(),
        ];
    }

    public function prepareForAiSummary(MootParticipation $participation): array
    {
        return [
            'moot' => [
                'name_en' => $participation->moot->name_en,
                'name_km' => $participation->moot->name_km,
                'acronym' => $participation->moot->acronym,
            ],
            'participation' => [
                'year' => $participation->year,
                'theme_en' => $participation->theme_en,
                'theme_km' => $participation->theme_km,
                'status' => $participation->status,
                'result_en' => $participation->result_en,
            ],
            'activities' => $participation->activities->map(function ($activity) {
                return [
                    'title_en' => $activity->title_en,
                    'activity_type' => $activity->activity_type,
                    'activity_date' => $activity->activity_date?->format('Y-m-d'),
                    'is_completed' => $activity->is_completed,
                ];
            }),
            'teams' => $participation->teams->map(function ($team) {
                return [
                    'team_name' => $team->team_name,
                    'team_type' => $team->team_type,
                    'round_reached' => $team->round_reached,
                    'members' => $team->members->map(function ($member) {
                        return [
                            'name_en' => $member->name_en,
                            'role' => $member->role,
                        ];
                    }),
                ];
            }),
        ];
    }
}
