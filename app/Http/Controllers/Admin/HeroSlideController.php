<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSettings;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HeroSlideController extends Controller
{
    public function index(Request $request)
    {
        $pageKey = $request->get('page', 'home');

        $slides = HeroSlide::forPage($pageKey)
            ->ordered()
            ->get();

        $settings = HeroSettings::firstOrCreate(
            ['page_key' => $pageKey],
            [
                'title' => ucfirst($pageKey).' Hero',
                'is_active' => true,
                'section_type' => 'slideshow',
                'enable_slideshow' => true,
            ]
        );

        return view('admin.hero-slides.index', compact('slides', 'settings', 'pageKey'));
    }

    public function create(Request $request)
    {
        $pageKey = $request->get('page', 'home');
        $themes = HeroSlide::getThemes();
        $overlayOpacities = HeroSlide::getOverlayOpacities();
        $animationTypes = HeroSlide::getAnimationTypes();

        return view('admin.hero-slides.create', compact('pageKey', 'themes', 'overlayOpacities', 'animationTypes'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'slide_key' => 'required|string|max:255',
                'title_en' => 'required|string|max:255',
                'title_km' => 'required|string|max:255',
                'subtitle_en' => 'nullable|string|max:255',
                'subtitle_km' => 'nullable|string|max:255',
                'description_en' => 'nullable|string',
                'description_km' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                'image_alt_en' => 'nullable|string|max:255',
                'image_alt_km' => 'nullable|string|max:255',
                'button_text_en' => 'nullable|string|max:100',
                'button_text_km' => 'nullable|string|max:100',
                'button_url' => 'nullable|string|max:500',
                'button_icon' => 'nullable|string|max:100',
                'secondary_button_text_en' => 'nullable|string|max:100',
                'secondary_button_text_km' => 'nullable|string|max:100',
                'secondary_button_url' => 'nullable|string|max:500',
                'theme' => 'nullable|string|max:50',
                'use_theme' => 'nullable',
                'content_position' => 'nullable|string|max:20',
                'show_content' => 'nullable',
                'overlay_opacity' => 'nullable|string|max:50',
                'show_animation' => 'nullable',
                'animation_type' => 'nullable|string|max:50',
                'is_active' => 'nullable',
                'publish_at' => 'nullable|date',
                'expire_at' => 'nullable|date',
                'order' => 'nullable|integer|min:0',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $validated['slide_key'].'_'.time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('images/hero-slides');
                if (! file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $file->move($destinationPath, $filename);
                $validated['image'] = 'hero-slides/'.$filename;
            }

            $validated['is_active'] = $request->has('is_active') ? true : false;
            $validated['show_animation'] = $request->has('show_animation') ? true : false;
            $validated['use_theme'] = $request->has('use_theme') ? true : false;
            $validated['show_content'] = $request->has('show_content') ? true : false;
            $validated['view_count'] = 0;

            $slide = HeroSlide::create($validated);

            return redirect()->route('admin.hero-slides.index', ['page' => $validated['slide_key']])
                ->with('success', 'Slide created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: '.$e->getMessage())->withInput();
        }
    }

    public function edit(HeroSlide $heroSlide)
    {
        $themes = HeroSlide::getThemes();
        $overlayOpacities = HeroSlide::getOverlayOpacities();
        $animationTypes = HeroSlide::getAnimationTypes();

        return view('admin.hero-slides.edit', compact('heroSlide', 'themes', 'overlayOpacities', 'animationTypes'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'required|string|max:255',
            'subtitle_en' => 'nullable|string|max:255',
            'subtitle_km' => 'nullable|string|max:255',
            'description_en' => 'nullable|string',
            'description_km' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_km' => 'nullable|string|max:255',
            'button_text_en' => 'nullable|string|max:100',
            'button_text_km' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',
            'button_icon' => 'nullable|string|max:100',
            'secondary_button_text_en' => 'nullable|string|max:100',
            'secondary_button_text_km' => 'nullable|string|max:100',
            'secondary_button_url' => 'nullable|string|max:500',
            'theme' => 'nullable|string|max:50',
            'use_theme' => 'nullable',
            'content_position' => 'nullable|string|max:20',
            'overlay_opacity' => 'nullable|string|max:50',
            'show_animation' => 'nullable',
            'animation_type' => 'nullable|string|max:50',
            'is_active' => 'nullable',
            'publish_at' => 'nullable|date',
            'expire_at' => 'nullable|date',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($heroSlide->image) {
                $oldPath = public_path('images/hero-slides/'.$heroSlide->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = $heroSlide->slide_key.'_'.time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('images/hero-slides');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $validated['image'] = 'hero-slides/'.$filename;
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['show_animation'] = $request->has('show_animation') ? true : false;
        $validated['use_theme'] = $request->has('use_theme') ? true : false;
        $validated['show_content'] = $request->has('show_content') ? true : false;

        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index', ['page' => $heroSlide->slide_key])->with('success', 'Updated!');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $pageKey = $heroSlide->slide_key;

        if ($heroSlide->image) {
            $imagePath = public_path('images/hero-slides/'.$heroSlide->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index', ['page' => $pageKey])
            ->with('success', 'Slide deleted successfully!');
    }

    public function destroyImage(HeroSlide $heroSlide)
    {
        if ($heroSlide->image) {
            $imagePath = public_path('images/hero-slides/'.$heroSlide->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $heroSlide->update(['image' => null]);
        }

        return back()->with('success', 'Image removed successfully.');
    }

    public function updateSettings(Request $request, HeroSettings $heroSettings)
    {
        Log::info('updateSettings called', ['heroSettings' => $heroSettings->id, 'request' => $request->all()]);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'enable_slideshow' => 'nullable',
            'slideshow_interval' => 'nullable|integer|min:1000|max:30000',
            'slideshow_autoplay' => 'nullable',
            'slideshow_navigation' => 'nullable',
            'slideshow_pagination' => 'nullable',
            'height' => 'nullable|string|max:20',
            'content_position' => 'nullable|string|max:20',
            'is_active' => 'nullable',
        ]);

        $validated['enable_slideshow'] = $request->has('enable_slideshow');
        $validated['slideshow_autoplay'] = $request->has('slideshow_autoplay');
        $validated['slideshow_navigation'] = $request->has('slideshow_navigation');
        $validated['slideshow_pagination'] = $request->has('slideshow_pagination');
        $validated['is_active'] = $request->has('is_active');

        $heroSettings->update($validated);

        Log::info('Settings updated successfully', ['heroSettings' => $heroSettings->id]);

        return back()->with('success', 'Settings updated successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|integer|exists:hero_slides,id',
            'order.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->order as $item) {
            HeroSlide::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
