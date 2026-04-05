<?php

namespace App\Http\Controllers;

use App\Models\HeroSettings;
use App\Models\PartnerUniversity;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        $universities = PartnerUniversity::with('publicActivities')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $heroImage = HeroSettings::getImageForPage('partners') ?? HeroSettings::getDefaultImage('partners');

        return view('partners.index', compact('universities', 'heroImage'));
    }

    public function show(PartnerUniversity $partner): View
    {
        $partner->load(['publicActivities' => function ($query) {
            $query->orderBy('activity_date', 'desc');
        }]);

        if ($partner->status !== 'active') {
            abort(404);
        }

        $activitiesByYear = $partner->publicActivities->groupBy(function ($activity) {
            return $activity->activity_date->year;
        });

        return view('partners.show', compact('partner', 'activitiesByYear'));
    }
}
