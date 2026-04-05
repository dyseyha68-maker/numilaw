<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Moot;
use App\Models\MootParticipation;
use App\Models\MootActivity;
use App\Models\MootTeam;
use App\Models\MootTeamMember;
use App\Services\MootService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MootProgramController extends Controller
{
    protected $mootService;

    public function __construct(MootService $mootService)
    {
        $this->mootService = $mootService;
    }

    public function index()
    {
        $moots = Moot::with(['participations' => function ($query) {
            $query->orderBy('year', 'desc');
        }])->ordered()->paginate(10);

        return view('admin.moot-programs.index', compact('moots'));
    }

    public function create()
    {
        return view('admin.moot-programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_km' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:50',
            'acronym' => 'nullable|string|max:20',
            'description_en' => 'nullable|string',
            'description_km' => 'nullable|string',
            'official_url' => 'nullable|url',
            'organizing_body_en' => 'nullable|string|max:255',
            'organizing_body_km' => 'nullable|string|max:255',
            'first_participation_year' => 'nullable|integer|min:1990|max:2100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'moot-' . time() . '-' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/moots'), $logoName);
            $validated['logo_path'] = 'images/moots/' . $logoName;
        }

        Moot::create($validated);

        return redirect()->route('admin.moot-programs.index')
            ->with('success', 'Moot court program created successfully.');
    }

    public function show(Moot $moot)
    {
        $moot->load(['participations' => function ($query) {
            $query->orderBy('year', 'desc');
        }]);

        return view('admin.moot-programs.show', compact('moot'));
    }

    public function edit(Moot $moot)
    {
        return view('admin.moot-programs.edit', compact('moot'));
    }

    public function update(Request $request, Moot $moot)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_km' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:50',
            'acronym' => 'nullable|string|max:20',
            'description_en' => 'nullable|string',
            'description_km' => 'nullable|string',
            'official_url' => 'nullable|url',
            'organizing_body_en' => 'nullable|string|max:255',
            'organizing_body_km' => 'nullable|string|max:255',
            'first_participation_year' => 'nullable|integer|min:1990|max:2100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_logo' => 'nullable|in:1',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($moot->logo_path && file_exists(public_path($moot->logo_path))) {
                unlink(public_path($moot->logo_path));
            }
            
            $logo = $request->file('logo');
            $logoName = 'moot-' . time() . '-' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/moots'), $logoName);
            $validated['logo_path'] = 'images/moots/' . $logoName;
        }

        // Handle logo removal
        if ($request->has('remove_logo') && $request->remove_logo == 1) {
            if ($moot->logo_path && file_exists(public_path($moot->logo_path))) {
                unlink(public_path($moot->logo_path));
            }
            $validated['logo_path'] = null;
        }

        $moot->update($validated);

        return redirect()->route('admin.moot-programs.show', $moot->id)
            ->with('success', 'Moot court program updated successfully.');
    }

    public function destroy(Moot $moot)
    {
        $moot->delete();

        return redirect()->route('admin.moot-programs.index')
            ->with('success', 'Moot court program deleted successfully.');
    }

    public function createParticipation(Moot $moot)
    {
        $currentYear = date('Y');
        $years = range($currentYear + 1, $currentYear - 10);
        $existingYears = $moot->participations()->pluck('year')->toArray();
        
        $availableYears = array_diff($years, $existingYears);

        return view('admin.moot-programs.participation.create', compact('moot', 'availableYears'));
    }

    public function storeParticipation(Request $request, Moot $moot)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1990|max:2100',
            'theme_en' => 'nullable|string|max:255',
            'theme_km' => 'nullable|string|max:255',
            'case_problem_en' => 'nullable|string',
            'case_problem_km' => 'nullable|string',
            'competition_start_date' => 'nullable|date',
            'competition_end_date' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
            'host_city' => 'nullable|string|max:100',
            'host_country' => 'nullable|string|max:100',
            'status' => 'in:planning,preparing,ongoing,completed,cancelled',
        ]);

        $existingParticipation = MootParticipation::where('moot_id', $moot->id)
            ->where('year', $validated['year'])
            ->first();

        if ($existingParticipation) {
            return back()->with('error', "Participation for {$validated['year']} already exists.");
        }

        $participation = MootParticipation::create(array_merge($validated, [
            'moot_id' => $moot->id,
        ]));

        return redirect()->route('admin.moot-programs.participations.show', [$moot->id, $participation->id])
            ->with('success', 'Participation created successfully.');
    }

    public function cloneParticipation(Request $request, Moot $moot, MootParticipation $sourceParticipation)
    {
        $targetYear = $request->input('year');

        $existingParticipation = MootParticipation::where('moot_id', $moot->id)
            ->where('year', $targetYear)
            ->first();

        if ($existingParticipation) {
            return back()->with('error', "Participation for {$targetYear} already exists.");
        }

        $newParticipation = $this->mootService->cloneParticipation($sourceParticipation, $targetYear);

        return redirect()->route('admin.moot-programs.participations.show', [$moot->id, $newParticipation->id])
            ->with('success', "Participation cloned to {$targetYear}. Please review and update the details.");
    }

    public function showParticipation(Moot $moot, MootParticipation $participation)
    {
        $participation->load(['activities', 'teams.members']);

        return view('admin.moot-programs.participation.show', compact('moot', 'participation'));
    }

    public function editParticipation(Moot $moot, MootParticipation $participation)
    {
        return view('admin.moot-programs.participation.edit', compact('moot', 'participation'));
    }

    public function updateParticipation(Request $request, Moot $moot, MootParticipation $participation)
    {
        $validated = $request->validate([
            'theme_en' => 'nullable|string|max:255',
            'theme_km' => 'nullable|string|max:255',
            'case_problem_en' => 'nullable|string',
            'case_problem_km' => 'nullable|string',
            'competition_start_date' => 'nullable|date',
            'competition_end_date' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
            'host_city' => 'nullable|string|max:100',
            'host_country' => 'nullable|string|max:100',
            'status' => 'in:planning,preparing,ongoing,completed,cancelled',
            'summary_en' => 'nullable|string',
            'summary_km' => 'nullable|string',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'result_en' => 'nullable|string',
            'result_km' => 'nullable|string',
            'achievements_en' => 'nullable|string',
            'achievements_km' => 'nullable|string',
        ]);

        $participation->update($validated);

        return redirect()->route('admin.moot-programs.participations.show', [$moot->id, $participation->id])
            ->with('success', 'Participation updated successfully.');
    }

    public function destroyParticipation(Moot $moot, MootParticipation $participation)
    {
        $participation->delete();

        return redirect()->route('admin.moot-programs.show', $moot->id)
            ->with('success', 'Participation deleted successfully.');
    }

    public function togglePublishParticipation(Moot $moot, MootParticipation $participation)
    {
        $isPublished = $this->mootService->togglePublish($participation);
        
        $status = $isPublished ? 'published' : 'unpublished';

        return back()->with('success', "Participation {$status} successfully.");
    }

    public function createActivity(Request $request, Moot $moot, MootParticipation $participation)
    {
        return view('admin.moot-programs.activity.create', compact('moot', 'participation'));
    }

    public function storeActivity(Request $request, Moot $moot, MootParticipation $participation)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'nullable|string|max:255',
            'description_en' => 'nullable|string',
            'description_km' => 'nullable|string',
            'activity_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'activity_type' => 'in:training,submission,preliminary,quarterfinal,semifinal,final,ceremony,announcement,meeting,other',
            'order' => 'integer|min:0',
            'is_completed' => 'boolean',
        ]);

        $maxOrder = $participation->activities()->max('order') ?? -1;
        
        $activity = MootActivity::create(array_merge($validated, [
            'participation_id' => $participation->id,
            'order' => $validated['order'] ?? $maxOrder + 1,
        ]));

        return redirect()->route('admin.moot-programs.participations.show', [$moot->id, $participation->id])
            ->with('success', 'Activity created successfully.');
    }

    public function editActivity(Moot $moot, MootParticipation $participation, MootActivity $activity)
    {
        return view('admin.moot-programs.activity.edit', compact('moot', 'participation', 'activity'));
    }

    public function updateActivity(Request $request, Moot $moot, MootParticipation $participation, MootActivity $activity)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'nullable|string|max:255',
            'description_en' => 'nullable|string',
            'description_km' => 'nullable|string',
            'activity_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'activity_type' => 'in:training,submission,preliminary,quarterfinal,semifinal,final,ceremony,announcement,meeting,other',
            'order' => 'integer|min:0',
            'is_completed' => 'boolean',
        ]);

        $activity->update($validated);

        return redirect()->route('admin.moot-programs.participations.show', [$moot->id, $participation->id])
            ->with('success', 'Activity updated successfully.');
    }

    public function destroyActivity(Moot $moot, MootParticipation $participation, MootActivity $activity)
    {
        $activity->delete();

        return back()->with('success', 'Activity deleted successfully.');
    }

    public function reorderActivities(Request $request, Moot $moot, MootParticipation $participation)
    {
        $activityIds = $request->input('activity_ids', []);
        
        $this->mootService->reorderActivities($participation, $activityIds);

        return back()->with('success', 'Activities reordered successfully.');
    }

    public function createTeam(Request $request, Moot $moot, MootParticipation $participation)
    {
        return view('admin.moot-programs.team.create', compact('moot', 'participation'));
    }

    public function storeTeam(Request $request, Moot $moot, MootParticipation $participation)
    {
        $validated = $request->validate([
            'team_name' => 'required|string|max:255',
            'team_name_local' => 'nullable|string|max:255',
            'coach_name' => 'nullable|string|max:255',
            'coach_email' => 'nullable|email',
            'team_type' => 'in:main,reserve,unofficial',
            'round_reached' => 'nullable|integer|min:1|max:5',
            'result_en' => 'nullable|string',
            'result_km' => 'nullable|string',
            'awards_en' => 'nullable|string',
            'awards_km' => 'nullable|string',
            'notes' => 'nullable|string',
            'display_order' => 'integer|min:0',
        ]);

        $maxOrder = $participation->teams()->max('display_order') ?? -1;

        $team = MootTeam::create(array_merge($validated, [
            'participation_id' => $participation->id,
            'display_order' => $validated['display_order'] ?? $maxOrder + 1,
        ]));

        return redirect()->route('admin.moot-programs.teams.edit', [$moot->id, $participation->id, $team->id])
            ->with('success', 'Team created successfully. Now add team members.');
    }

    public function editTeam(Moot $moot, MootParticipation $participation, MootTeam $team)
    {
        $team->load('members');

        return view('admin.moot-programs.team.edit', compact('moot', 'participation', 'team'));
    }

    public function updateTeam(Request $request, Moot $moot, MootParticipation $participation, MootTeam $team)
    {
        $validated = $request->validate([
            'team_name' => 'required|string|max:255',
            'team_name_local' => 'nullable|string|max:255',
            'coach_name' => 'nullable|string|max:255',
            'coach_email' => 'nullable|email',
            'team_type' => 'in:main,reserve,unofficial',
            'round_reached' => 'nullable|integer|min:1|max:5',
            'result_en' => 'nullable|string',
            'result_km' => 'nullable|string',
            'awards_en' => 'nullable|string',
            'awards_km' => 'nullable|string',
            'notes' => 'nullable|string',
            'display_order' => 'integer|min:0',
        ]);

        $team->update($validated);

        return redirect()->route('admin.moot-programs.participations.show', [$moot->id, $participation->id])
            ->with('success', 'Team updated successfully.');
    }

    public function destroyTeam(Moot $moot, MootParticipation $participation, MootTeam $team)
    {
        $team->delete();

        return back()->with('success', 'Team deleted successfully.');
    }

    public function createMember(Request $request, Moot $moot, MootParticipation $participation, MootTeam $team)
    {
        return view('admin.moot-programs.team-member.create', compact('moot', 'participation', 'team'));
    }

    public function storeMember(Request $request, Moot $moot, MootParticipation $participation, MootTeam $team)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_km' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'role' => 'in:speaker,researcher,reserve,coach,observer',
            'order' => 'integer|min:0',
            'is_team_lead' => 'boolean',
        ]);

        $maxOrder = $team->members()->max('order') ?? -1;

        MootTeamMember::create(array_merge($validated, [
            'team_id' => $team->id,
            'order' => $validated['order'] ?? $maxOrder + 1,
        ]));

        return redirect()->route('admin.moot-programs.teams.edit', [$moot->id, $participation->id, $team->id])
            ->with('success', 'Team member added successfully.');
    }

    public function editMember(Moot $moot, MootParticipation $participation, MootTeam $team, MootTeamMember $member)
    {
        return view('admin.moot-programs.team-member.edit', compact('moot', 'participation', 'team', 'member'));
    }

    public function updateMember(Request $request, Moot $moot, MootParticipation $participation, MootTeam $team, MootTeamMember $member)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_km' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'role' => 'in:speaker,researcher,reserve,coach,observer',
            'order' => 'integer|min:0',
            'is_team_lead' => 'boolean',
        ]);

        $member->update($validated);

        return redirect()->route('admin.moot-programs.teams.edit', [$moot->id, $participation->id, $team->id])
            ->with('success', 'Team member updated successfully.');
    }

    public function destroyMember(Moot $moot, MootParticipation $participation, MootTeam $team, MootTeamMember $member)
    {
        $member->delete();

        return back()->with('success', 'Team member removed successfully.');
    }
}
