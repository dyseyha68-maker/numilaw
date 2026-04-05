<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FacultyController extends Controller
{
    public function index(Request $request)
    {
        $query = Faculty::with(['user']);

        if ($request->status !== '' && $request->status !== null) {
            $query->where('status', $request->status == '1' ? 'active' : 'inactive');
        }

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->department) {
            $query->where('department', $request->department);
        }

        $faculty = $query->latest()->paginate(15);
        $departments = Faculty::distinct()->pluck('department')->filter()->values();

        return view('admin.faculty.index', compact('faculty', 'departments'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('admin.faculty.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'specialization_en' => 'nullable|string|max:255',
            'specialization_km' => 'nullable|string|max:255',
            'bio_en' => 'required|string',
            'bio_km' => 'required|string',
            'education_en' => 'nullable|string|max:255',
            'education_km' => 'nullable|string|max:255',
            'office_location' => 'nullable|string|max:255',
            'office_hours' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/faculty');
            if (! is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $filename);
            $validated['photo'] = 'faculty/'.$filename;
        }

        Faculty::create($validated);

        return redirect()
            ->route('admin.faculty.index')
            ->with('success', 'Faculty member created successfully.');
    }

    public function show(Faculty $faculty)
    {
        $faculty->load(['user']);

        return view('admin.faculty.show', compact('faculty'));
    }

    public function edit(Faculty $faculty)
    {
        $users = User::orderBy('name')->get();

        return view('admin.faculty.edit', compact('faculty', 'users'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        \Log::info('=== UPDATE DEBUG START ===');
        \Log::info('Old photo: '.($faculty->photo ?? 'null'));
        \Log::info('Has file: '.($request->hasFile('photo') ? 'YES' : 'NO'));
        \Log::info('Request method: '.$request->method());
        \Log::info('All files: '.json_encode($request->allFiles()));
        \Log::info('Request all: '.json_encode($request->except(['_token', '_method'])));

        $rules = [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'specialization_en' => 'nullable|string|max:255',
            'specialization_km' => 'nullable|string|max:255',
            'bio_en' => 'required|string',
            'bio_km' => 'required|string',
            'education_en' => 'nullable|string|max:255',
            'education_km' => 'nullable|string|max:255',
            'office_location' => 'nullable|string|max:255',
            'office_hours' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'integer|min:0',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5120',
        ];

        try {
            $validated = $request->validate($rules);
            \Log::info('Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed: '.json_encode($e->errors()));
            throw $e;
        }

        if ($request->hasFile('photo')) {
            \Log::info('Processing new file upload');

            if ($faculty->photo && substr($faculty->photo, 0, 4) !== 'http') {
                $oldPath = public_path('images/'.$faculty->photo);
                \Log::info('Deleting old file: '.$oldPath);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $image = $request->file('photo');
            $filename = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/faculty');
            if (! is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $filename);
            $validated['photo'] = 'faculty/'.$filename;
            \Log::info('New photo saved: '.$validated['photo']);
        } else {
            \Log::info('No new file, keeping old photo');
            unset($validated['photo']);
        }

        $faculty->update($validated);
        \Log::info('=== UPDATE DEBUG END ===');

        return redirect()
            ->route('admin.faculty.show', $faculty)
            ->with('success', 'Faculty member updated successfully.');
    }

    public function destroy(Faculty $faculty)
    {
        // Delete old image if local file
        if ($faculty->photo && substr($faculty->photo, 0, 4) !== 'http') {
            $oldPath = public_path('images/'.$faculty->photo);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $faculty->delete();

        return redirect()
            ->route('admin.faculty.index')
            ->with('success', 'Faculty member deleted successfully.');
    }
}
