<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AcademicProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = AcademicProgram::query();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title_en', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('title_km', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('status')) {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        $programs = $query->withCount('alumni')
                         ->orderBy('sort_order')
                         ->orderBy('title_en')
                         ->paginate(15);

        return view('admin.academic-programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.academic-programs.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/academic-programs'), $imageName);
            $data['featured_image'] = 'academic-programs/' . $imageName;
        }

        // Create slug
        $data['slug'] = Str::slug($request->title_en);
        
        // Check duplicate slug
        if (AcademicProgram::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $data['slug'] . '-' . time();
        }

        // Set is_active
        $data['is_active'] = $request->has('is_active');

        AcademicProgram::create($data);

        return redirect()->route('admin.academic-programs.index')
                       ->with('success', 'Academic program created successfully.');
    }

    public function show(AcademicProgram $academicProgram)
    {
        return view('admin.academic-programs.show', compact('academicProgram'));
    }

    public function edit(AcademicProgram $academicProgram)
    {
        return view('admin.academic-programs.edit', compact('academicProgram'));
    }

    public function update(Request $request, AcademicProgram $academicProgram)
    {
        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/academic-programs'), $imageName);
            $data['featured_image'] = 'academic-programs/' . $imageName;
        }

        // Update slug
        $data['slug'] = Str::slug($request->title_en);
        
        // Check duplicate slug
        if ($academicProgram->slug !== $data['slug'] && AcademicProgram::where('slug', $data['slug'])->where('id', '!=', $academicProgram->id)->exists()) {
            $data['slug'] = $data['slug'] . '-' . time();
        }

        // Set is_active
        $data['is_active'] = $request->has('is_active');

        $academicProgram->update($data);

        return redirect()->route('admin.academic-programs.index')
                       ->with('success', 'Academic program updated successfully.');
    }

    public function destroy(AcademicProgram $academicProgram)
    {
        $academicProgram->delete();

        return redirect()->route('admin.academic-programs.index')
                       ->with('success', 'Academic program deleted successfully.');
    }
}
