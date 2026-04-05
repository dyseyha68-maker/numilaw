<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HeroImageController extends Controller
{
    public function index()
    {
        $heroImages = HeroSettings::orderBy('page_key')->get();
        return view('admin.hero-images.index', compact('heroImages'));
    }

    public function edit(HeroSettings $heroImage)
    {
        return view('admin.hero-images.edit', compact('heroImage'));
    }

    public function update(Request $request, HeroSettings $heroImage)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'default_image' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($heroImage->image) {
                $oldPath = public_path($heroImage->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            
            $file = $request->file('image');
            $filename = $heroImage->page_key . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/hero'), $filename);
            $validated['image'] = 'images/hero/' . $filename;
        }

        $heroImage->update($validated);

        return redirect()->route('admin.hero-images.index')
            ->with('success', 'Hero image updated successfully.');
    }

    public function destroyImage(HeroSettings $heroImage)
    {
        if ($heroImage->image) {
            $imagePath = public_path($heroImage->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $heroImage->update(['image' => null]);
        }

        return back()->with('success', 'Image removed successfully.');
    }
}
