<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\HeroSettings;
use App\Models\Moot;
use App\Models\MootParticipation;
use App\Models\MootActivity;
use App\Models\MootTeam;
use Illuminate\Http\Request;

class MootProgramController extends Controller
{
    public function index()
    {
        $featuredMoots = Moot::active()
            ->featured()
            ->ordered()
            ->get();

        $allMoots = Moot::active()
            ->ordered()
            ->paginate(12);

        $upcomingRegistrations = MootParticipation::with('moot')
            ->where('status', 'registration_open')
            ->orWhere('status', 'upcoming')
            ->orderBy('year', 'desc')
            ->get();

        $heroImage = HeroSettings::getImageForPage('moot_courts') ?? HeroSettings::getDefaultImage('moot_courts');

        return view('public.moot-programs.index', compact('featuredMoots', 'allMoots', 'upcomingRegistrations', 'heroImage'));
    }

    public function show(Moot $moot)
    {
        $participations = $moot->publishedParticipations()
            ->with(['activities', 'teams.members'])
            ->orderBy('year', 'desc')
            ->get();

        return view('public.moot-programs.show', compact('moot', 'participations'));
    }

    public function showParticipation(Moot $moot, string $year)
    {
        $participation = MootParticipation::where('moot_id', $moot->id)
            ->where('year', $year)
            ->where('is_published', true)
            ->firstOrFail();
            
        $participation->load(['activities', 'teams.members']);

        $otherYears = MootParticipation::where('moot_id', $moot->id)
            ->where('id', '!=', $participation->id)
            ->where('is_published', true)
            ->orderBy('year', 'desc')
            ->get();

        return view('public.moot-programs.participation.show', compact('moot', 'participation', 'otherYears'));
    }

    public function getTimeline(Moot $moot, MootParticipation $participation)
    {
        $activities = $participation->activities()
            ->orderBy('order')
            ->get();

        return response()->json([
            'participation' => [
                'year' => $participation->year,
                'theme_en' => $participation->theme_en,
                'theme_km' => $participation->theme_km,
            ],
            'activities' => $activities->map(function ($activity) {
                return [
                    'id' => $activity->id,
                    'title_en' => $activity->title_en,
                    'title_km' => $activity->title_km,
                    'description_en' => $activity->description_en,
                    'description_km' => $activity->description_km,
                    'activity_date' => $activity->activity_date?->format('Y-m-d'),
                    'location' => $activity->location,
                    'activity_type' => $activity->activity_type,
                    'order' => $activity->order,
                    'is_completed' => $activity->is_completed,
                ];
            }),
        ]);
    }

    public function getTeams(Moot $moot, MootParticipation $participation)
    {
        $teams = $participation->teams()
            ->with('members')
            ->orderBy('display_order')
            ->get();

        return response()->json([
            'teams' => $teams->map(function ($team) {
                return [
                    'id' => $team->id,
                    'team_name' => $team->team_name,
                    'team_name_local' => $team->team_name_local,
                    'coach_name' => $team->coach_name,
                    'team_type' => $team->team_type,
                    'round_reached' => $team->round_reached,
                    'result_en' => $team->result_en,
                    'awards_en' => $team->awards_en,
                    'members' => $team->members->map(function ($member) {
                        return [
                            'id' => $member->id,
                            'name_en' => $member->name_en,
                            'name_km' => $member->name_km,
                            'role' => $member->role,
                            'is_team_lead' => $member->is_team_lead,
                        ];
                    }),
                ];
            }),
        ]);
    }

    public function requestRegistration(Request $request)
    {
        $request->validate([
            'moot_id' => 'required|exists:moots,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'year' => 'required|integer|min:2025|max:2030',
            'motivation' => 'required|string|min:50',
        ]);

        return back()->with('success', 'Your registration request has been submitted successfully! We will contact you soon.');
    }
}
