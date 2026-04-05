<?php

namespace App\Http\Controllers;

use App\Models\PartnerActivity;
use App\Models\PartnerUniversity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PartnerUniversityController extends Controller
{
    public function index()
    {
        $universities = PartnerUniversity::withCount('activities')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.partners.universities.index', compact('universities'));
    }

    public function create()
    {
        return view('admin.partners.universities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'faculty_or_school' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'official_website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->uploadLogo($request->file('logo'));
        }

        PartnerUniversity::create($validated);

        return redirect()->route('admin.partners.universities.index')
            ->with('success', 'Partner university created successfully.');
    }

    public function show(PartnerUniversity $partnerUniversity)
    {
        $partnerUniversity->load('activities');

        return view('admin.partners.universities.show', compact('partnerUniversity'));
    }

    public function edit(PartnerUniversity $partnerUniversity)
    {
        return view('admin.partners.universities.edit', compact('partnerUniversity'));
    }

    public function update(Request $request, PartnerUniversity $partnerUniversity)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'faculty_or_school' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'official_website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('logo')) {
            $this->deleteLogo($partnerUniversity->logo);
            $validated['logo'] = $this->uploadLogo($request->file('logo'));
        } else {
            unset($validated['logo']);
        }

        $partnerUniversity->update($validated);

        return redirect()->route('admin.partners.universities.index')
            ->with('success', 'Partner university updated successfully.');
    }

    public function destroy(PartnerUniversity $partnerUniversity)
    {
        $this->deleteLogo($partnerUniversity->logo);
        $partnerUniversity->delete();

        return redirect()->route('admin.partners.universities.index')
            ->with('success', 'Partner university deleted successfully.');
    }

    public function activities(PartnerUniversity $partnerUniversity)
    {
        $activities = $partnerUniversity->activities()->paginate(15);

        return view('admin.partners.activities.index', compact('partnerUniversity', 'activities'));
    }

    public function createActivity(PartnerUniversity $partnerUniversity)
    {
        $types = $partnerUniversity->getActivityTypes();

        return view('admin.partners.activities.create', compact('partnerUniversity', 'types'));
    }

    public function storeActivity(Request $request, PartnerUniversity $partnerUniversity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:mou,study_visit,exchange,seminar,workshop,meeting,conference,other',
            'description' => 'nullable|string',
            'activity_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'visibility' => 'required|in:public,internal',
        ]);

        $validated['partner_university_id'] = $partnerUniversity->id;

        PartnerActivity::create($validated);

        return redirect()->route('admin.partners.activities.index', $partnerUniversity->id)
            ->with('success', 'Activity created successfully.');
    }

    public function editActivity(PartnerActivity $activity)
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

        return view('admin.partners.activities.edit', compact('activity', 'types'));
    }

    public function updateActivity(Request $request, PartnerActivity $activity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:mou,study_visit,exchange,seminar,workshop,meeting,conference,other',
            'description' => 'nullable|string',
            'activity_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'visibility' => 'required|in:public,internal',
        ]);

        $activity->update($validated);

        return redirect()->route('admin.partners.activities.index', $activity->partner_university_id)
            ->with('success', 'Activity updated successfully.');
    }

    public function destroyActivity(PartnerActivity $activity)
    {
        $partnerUniversityId = $activity->partner_university_id;
        $activity->delete();

        return redirect()->route('admin.partners.activities.index', $partnerUniversityId)
            ->with('success', 'Activity deleted successfully.');
    }

    private function uploadLogo($file): string
    {
        $filename = Str::slug(time() . '-' . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/partners'), $filename);

        return 'images/partners/' . $filename;
    }

    private function deleteLogo(?string $logo): void
    {
        if ($logo && file_exists(public_path($logo))) {
            unlink(public_path($logo));
        }
    }
}
