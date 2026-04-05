<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $events = Event::with(['organizer', 'reports'])
            ->latest()
            ->paginate(15);
            
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $this->checkAdmin();
        $projects = Project::orderBy('name_en')->get();
        return view('admin.events.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_km' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'location' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'max_participants' => 'nullable|integer|min:1',
            'registration_deadline' => 'nullable|date|before:start_datetime',
            'type' => 'nullable|in:seminar,workshop,competition,conference,other',
            'status' => 'nullable|in:upcoming,ongoing,completed,cancelled',
            'is_registration_required' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title_en']);
        $validated['organizer_id'] = Auth::id();
        $validated['is_active'] = $request->has('is_active');
        $validated['status'] = $validated['status'] ?? 'upcoming';
        $validated['is_registration_required'] = $request->has('is_registration_required');

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('events', 'public');
            $validated['featured_image'] = $path;
        }

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        $this->checkAdmin();
        
        $event->load(['organizer', 'reports']);
        
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $this->checkAdmin();
        $projects = Project::orderBy('name_en')->get();
        return view('admin.events.edit', compact('event', 'projects'));
    }

    public function update(Request $request, Event $event)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_km' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'location' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'max_participants' => 'nullable|integer|min:1',
            'registration_deadline' => 'nullable|date|before:start_datetime',
            'type' => 'nullable|in:seminar,workshop,competition,conference,other',
            'status' => 'nullable|in:upcoming,ongoing,completed,cancelled',
            'is_registration_required' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title_en']);
        $validated['is_active'] = $request->has('is_active');
        $validated['is_registration_required'] = $request->has('is_registration_required');

        if ($request->hasFile('featured_image')) {
            if ($event->featured_image) {
                Storage::disk('public')->delete($event->featured_image);
            }
            $path = $request->file('featured_image')->store('events', 'public');
            $validated['featured_image'] = $path;
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.show', $event)
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $this->checkAdmin();
        
        if ($event->featured_image) {
            Storage::disk('public')->delete($event->featured_image);
        }
        
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }
}