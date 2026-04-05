<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\HeroSettings;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['supervisor', 'leader']);

        if ($request->filled('search')) {
            $search = $request->search;
            $locale = app()->getLocale();
            $query->where(function ($q) use ($search, $locale) {
                $q->where("name_{$locale}", 'like', "%{$search}%")
                  ->orWhere("description_{$locale}", 'like', "%{$search}%")
                  ->orWhere("objectives_{$locale}", 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->latest()->paginate(12)->withQueryString();

        $stats = [
            'total' => Project::count(),
            'active' => Project::active()->count(),
            'completed' => Project::completed()->count(),
            'clubs' => Project::clubs()->count(),
        ];

        $types = Project::select('type')
            ->distinct()
            ->pluck('type')
            ->filter();

        $featuredProjects = Project::active()
            ->with(['supervisor', 'leader'])
            ->latest()
            ->take(3)
            ->get();

        $heroImage = HeroSettings::getImageForPage('projects') ?? HeroSettings::getDefaultImage('projects');

        return view('public.projects.index', compact(
            'projects',
            'stats',
            'types',
            'featuredProjects',
            'heroImage'
        ));
    }

    public function show(Project $project)
    {
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->where('type', $project->type)
            ->active()
            ->with(['supervisor', 'leader'])
            ->latest()
            ->take(3)
            ->get();

        $otherProjects = $relatedProjects;

        $heroImage = HeroSettings::getImageForPage('projects') ?? HeroSettings::getDefaultImage('projects');

        return view('public.projects.show', compact(
            'project',
            'relatedProjects',
            'otherProjects',
            'heroImage'
        ));
    }
}
