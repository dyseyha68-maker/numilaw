<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('articles')->latest()->paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255|unique:tags,name_en',
            'name_km' => 'required|string|max:255|unique:tags,name_km',
            'description_en' => 'nullable|string',
            'description_km' => 'nullable|string',
            'color' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Tag::create($validated);

        return redirect()->route('admin.tags.index')->with('success', 'Tag created successfully.');
    }

    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255|unique:tags,name_en,' . $tag->id,
            'name_km' => 'required|string|max:255|unique:tags,name_km,' . $tag->id,
            'description_en' => 'nullable|string',
            'description_km' => 'nullable|string',
            'color' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $tag->update($validated);

        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index')
                        ->with('success', 'Tag deleted successfully.');
    }
}
