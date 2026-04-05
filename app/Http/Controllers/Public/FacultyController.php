<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\HeroSettings;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index(Request $request)
    {
        $query = Faculty::active();

        if ($request->get('search')) {
            $query->where('name', 'like', '%'.$request->get('search').'%');
        }

        if ($request->get('letter')) {
            $query->where('name', 'like', $request->get('letter').'%');
        }

        if ($request->get('department')) {
            $query->where('department', $request->get('department'));
        }

        $faculty = $query->withCount('supervisedProjects')->ordered()->paginate(12)->appends($request->query());

        $heroImage = HeroSettings::getImageForPage('faculty') ?? HeroSettings::getDefaultImage('faculty');

        return view('public.faculty.index', compact('faculty', 'heroImage'));
    }

    public function show($id)
    {
        $faculty = Faculty::findOrFail($id);

        return view('public.faculty.show', compact('faculty'));
    }
}
