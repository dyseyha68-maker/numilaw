<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AlumniEvent;
use App\Models\HeroSettings;
use Illuminate\Http\Request;

class AlumniEventController extends Controller
{
    public function index(Request $request)
    {
        $query = AlumniEvent::active()->with('organizer');

        // Filter by status
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'upcoming':
                    $query->upcoming();
                    break;
                case 'ongoing':
                    $query->ongoing();
                    break;
                case 'past':
                    $query->past();
                    break;
            }
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Featured events
        if ($request->boolean('featured')) {
            $query->featured();
        }

        $events = $query->orderBy('start_datetime', 'asc')->paginate(12)->withQueryString();
        $featuredEvents = AlumniEvent::featured()->active()->upcoming()->take(3)->get();
        
        $heroImage = HeroSettings::getImageForPage('alumni_events') ?? HeroSettings::getDefaultImage('alumni_events');

        return view('public.alumni-events.index', compact('events', 'featuredEvents', 'heroImage'));
    }

    public function show(AlumniEvent $event)
    {
        if (!$event->is_active) {
            abort(404);
        }

        $event->load('organizer');

        // Related events
        $relatedEvents = AlumniEvent::active()
            ->where('id', '!=', $event->id)
            ->where(function ($query) use ($event) {
                $query->where('start_datetime', '>', now())
                      ->orWhere(function ($q) use ($event) {
                          $q->where('start_datetime', '<=', now())
                            ->where('end_datetime', '>=', now());
                      });
            })
            ->orderBy('start_datetime', 'asc')
            ->take(4)
            ->get();

        return view('public.alumni-events.show', compact('event', 'relatedEvents'));
    }

    public function register(Request $request, AlumniEvent $event)
    {
        if (!$event->is_active || $event->registration_status !== 'open') {
            return redirect()->back()
                ->with('error', 'Registration for this event is not available.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string|max:500',
        ]);

        // Here you would typically create a registration record
        // For now, we'll just show a success message
        
        return redirect()->back()
            ->with('success', 'Your registration has been submitted successfully!');
    }
}