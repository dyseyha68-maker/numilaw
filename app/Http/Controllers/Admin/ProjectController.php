<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
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
        $projects = Project::with(['supervisor', 'leader'])
            ->latest()
            ->paginate(15);
            
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $this->checkAdmin();
        $users = User::all();
        return view('admin.projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_km' => 'required|string|max:255',
            'type' => 'required|in:club,academic_project,research_project',
            'description_en' => 'required|string',
            'description_km' => 'required|string',
            'objectives_en' => 'nullable|string',
            'objectives_km' => 'nullable|string',
            'supervisor_id' => 'nullable|exists:users,id',
            'leader_id' => 'nullable|exists:users,id',
            'status' => 'nullable|in:active,completed',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'members' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['name_en']);
        $validated['status'] = $validated['status'] ?? 'active';

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('projects', 'public');
            $validated['featured_image'] = $path;
        }

        Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $this->checkAdmin();
        $project->load(['supervisor', 'leader']);
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->checkAdmin();
        $users = User::all();
        return view('admin.projects.edit', compact('project', 'users'));
    }

    public function update(Request $request, Project $project)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_km' => 'required|string|max:255',
            'type' => 'required|in:club,academic_project,research_project',
            'description_en' => 'required|string',
            'description_km' => 'required|string',
            'objectives_en' => 'nullable|string',
            'objectives_km' => 'nullable|string',
            'supervisor_id' => 'nullable|exists:users,id',
            'leader_id' => 'nullable|exists:users,id',
            'status' => 'nullable|in:active,completed',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'members' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['name_en']);
        $validated['status'] = $validated['status'] ?? 'active';

        if ($request->hasFile('featured_image')) {
            if ($project->featured_image) {
                Storage::disk('public')->delete($project->featured_image);
            }
            $path = $request->file('featured_image')->store('projects', 'public');
            $validated['featured_image'] = $path;
        }

        $project->update($validated);

        return redirect()
            ->route('admin.projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->checkAdmin();
        
        if ($project->featured_image) {
            Storage::disk('public')->delete($project->featured_image);
        }
        
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function updateStatus(Request $request, Project $project)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'status' => 'required|in:active,completed',
        ]);

        $project->update(['status' => $validated['status']]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project status updated.');
    }
}
