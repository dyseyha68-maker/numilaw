<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\Leadership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AboutPageAdminController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

    // About Sections Management
    public function sectionsIndex()
    {
        $this->checkAdmin();
        
        $sections = AboutSection::ordered()->get();
        return view('admin.about.sections.index', compact('sections'));
    }

    public function sectionsCreate()
    {
        $this->checkAdmin();
        return view('admin.about.sections.create');
    }

    public function sectionsStore(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_km' => 'required|string',
            'type' => 'required|in:overview,mission,vision',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $section = AboutSection::create($request->all());

        return redirect()
            ->route('admin.about.sections.index')
            ->with('success', 'About section created successfully.');
    }

    public function sectionsEdit(AboutSection $section)
    {
        $this->checkAdmin();
        return view('admin.about.sections.edit', compact('section'));
    }

    public function sectionsUpdate(Request $request, AboutSection $section)
    {
        $this->checkAdmin();
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_km' => 'required|string',
            'type' => 'required|in:overview,mission,vision',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $section->update($request->all());

        return redirect()
            ->route('admin.about.sections.index')
            ->with('success', 'About section updated successfully.');
    }

    public function sectionsDestroy(AboutSection $section)
    {
        $this->checkAdmin();
        
        $section->delete();

        return redirect()
            ->route('admin.about.sections.index')
            ->with('success', 'About section deleted successfully.');
    }

    // Leadership Management
    public function leadershipIndex()
    {
        $this->checkAdmin();
        
        $leadership = Leadership::ordered()->get();
        return view('admin.about.leadership.index', compact('leadership'));
    }

    public function leadershipCreate()
    {
        $this->checkAdmin();
        return view('admin.about.leadership.create');
    }

    public function leadershipStore(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio_en' => 'required|string',
            'bio_km' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = Str::slug($request->name) . '-' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/leadership'), $photoName);
            $data['photo'] = 'images/leadership/' . $photoName;
        }

        Leadership::create($data);

        return redirect()
            ->route('admin.about.leadership.index')
            ->with('success', 'Leadership member added successfully.');
    }

    public function leadershipEdit(Leadership $leadership)
    {
        $this->checkAdmin();
        return view('admin.about.leadership.edit', compact('leadership'));
    }

    public function leadershipUpdate(Request $request, Leadership $leadership)
    {
        $this->checkAdmin();
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio_en' => 'required|string',
            'bio_km' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($leadership->photo && file_exists(public_path($leadership->photo))) {
                unlink(public_path($leadership->photo));
            }

            $photo = $request->file('photo');
            $photoName = Str::slug($request->name) . '-' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/leadership'), $photoName);
            $data['photo'] = 'images/leadership/' . $photoName;
        }

        $leadership->update($data);

        return redirect()
            ->route('admin.about.leadership.index')
            ->with('success', 'Leadership member updated successfully.');
    }

    public function leadershipDestroy(Leadership $leadership)
    {
        $this->checkAdmin();
        
        // Delete photo if exists
        if ($leadership->photo && file_exists(public_path($leadership->photo))) {
            unlink(public_path($leadership->photo));
        }

        $leadership->delete();

        return redirect()
            ->route('admin.about.leadership.index')
            ->with('success', 'Leadership member deleted successfully.');
    }
}