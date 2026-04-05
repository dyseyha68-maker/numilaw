<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\HeroSettings;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['organizer']);
        
        // Filter by status
        if ($request->get('status') === 'completed') {
            $query->where('end_datetime', '<', now())->orWhere('status', 'completed');
        } else {
            $query->where(function($q) {
                $q->where('start_datetime', '>=', now())
                  ->orWhere('status', 'upcoming');
            });
        }
        
        $events = $query->orderBy('start_datetime', 'asc')->paginate(12);

        $heroImage = HeroSettings::getImageForPage('events') ?? HeroSettings::getDefaultImage('events');

        return view('public.events.index', compact('events', 'heroImage'));
    }

    public function calendar(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        
        $events = Event::query()
            ->whereYear('start_datetime', $year)
            ->whereMonth('start_datetime', $month)
            ->orderBy('start_datetime')
            ->get();

        $heroImage = HeroSettings::getImageForPage('calendar') ?? HeroSettings::getDefaultImage('calendar');

        return view('public.events.calendar', compact('events', 'year', 'month', 'heroImage'));
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)
            ->with(['organizer'])
            ->firstOrFail();

        $heroImage = HeroSettings::getImageForPage('event_detail') ?? HeroSettings::getDefaultImage('event_detail');

        return view('public.events.show', compact('event', 'heroImage'));
    }
}
