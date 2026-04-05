<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionProgram;
use App\Models\AdmissionIntake;
use App\Models\AdmissionApplication;
use App\Mail\ApplicationStatusUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminAdmissionsController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total' => AdmissionApplication::count(),
            'submitted' => AdmissionApplication::where('status', 'submitted')->count(),
            'under_review' => AdmissionApplication::where('status', 'under_review')->count(),
            'accepted' => AdmissionApplication::where('status', 'accepted')->count(),
            'rejected' => AdmissionApplication::where('status', 'rejected')->count(),
        ];

        $recentApplications = AdmissionApplication::with('program')
            ->latest()
            ->take(10)
            ->get();

        $byProgram = AdmissionApplication::selectRaw('program_id, count(*) as count')
            ->with('program')
            ->groupBy('program_id')
            ->get();

        return view('admin.admissions.dashboard', compact('stats', 'recentApplications', 'byProgram'));
    }

    public function applications(Request $request)
    {
        $query = AdmissionApplication::with(['program', 'intake']);

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->program_id) {
            $query->where('program_id', $request->program_id);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('full_name_en', 'like', "%{$request->search}%")
                    ->orWhere('reference_number', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        $applications = $query->latest()->paginate(20);
        $programs = AdmissionProgram::all();

        return view('admin.admissions.applications.index', compact('applications', 'programs'));
    }

    public function showApplication($id)
    {
        $application = AdmissionApplication::with(['program', 'intake', 'statusLogs'])->findOrFail($id);
        return view('admin.admissions.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:draft,submitted,under_review,accepted,rejected,withdrawn',
            'admin_notes' => 'nullable|string',
        ]);

        $application = AdmissionApplication::findOrFail($id);
        $oldStatus = $application->status;
        
        $application->status = $request->status;
        $application->admin_notes = $request->admin_notes;
        $application->reviewed_by = auth()->id();
        $application->reviewed_at = now();
        $application->save();

        // Log status change
        \App\Models\AdmissionStatusLog::create([
            'application_id' => $application->id,
            'status' => $request->status,
            'notes' => $request->admin_notes,
            'changed_by' => auth()->user()->name ?? 'Admin',
        ]);

        // Send notification email
        if (in_array($request->status, ['accepted', 'rejected'])) {
            try {
                $locale = 'en';
                Mail::to($application->email)->send(new ApplicationStatusUpdate(
                    $application->full_name_en,
                    $application->reference_number,
                    $request->status,
                    $request->admin_notes,
                    $locale
                ));
            } catch (\Exception $e) {
                // Continue even if email fails
            }
        }

        return redirect()->back()->with('success', 'Application status updated.');
    }

    public function exportApplications(Request $request)
    {
        $query = AdmissionApplication::with(['program', 'intake']);

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $applications = $query->get();

        $filename = 'applications-' . date('Y-m-d') . '.csv';
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="' . $filename . '"'];

        $callback = function() use ($applications) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Reference', 'Name', 'Email', 'Phone', 'Program', 'Intake', 'Status', 'Submitted At']);

            foreach ($applications as $app) {
                fputcsv($handle, [
                    $app->reference_number,
                    $app->full_name_en,
                    $app->email,
                    $app->phone,
                    $app->program->name_en ?? '',
                    $app->intake->intake_name_en ?? '',
                    $app->status,
                    $app->submitted_at,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Programs Management
    public function programs()
    {
        $programs = AdmissionProgram::orderBy('sort_order')->get();
        return view('admin.admissions.programs.index', compact('programs'));
    }

    public function createProgram()
    {
        return view('admin.admissions.programs.form');
    }

    public function storeProgram(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'degree_level' => 'required|in:bachelor,master,doctorate',
            'duration_en' => 'required|string|max:50',
            'duration_kh' => 'required|string|max:50',
            'description_en' => 'required|string',
            'description_kh' => 'required|string',
            'requirements_en' => 'required|string',
            'requirements_kh' => 'required|string',
            'tuition_en' => 'required|string|max:50',
            'tuition_kh' => 'required|string|max:50',
            'scholarship_available' => 'boolean',
            'scholarship_info_en' => 'nullable|string',
            'scholarship_info_kh' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        AdmissionProgram::create($validated);

        return redirect()->route('admin.admissions.programs.index')->with('success', 'Program created.');
    }

    public function editProgram($id)
    {
        $program = AdmissionProgram::findOrFail($id);
        return view('admin.admissions.programs.form', compact('program'));
    }

    public function updateProgram(Request $request, $id)
    {
        $program = AdmissionProgram::findOrFail($id);

        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'degree_level' => 'required|in:bachelor,master,doctorate',
            'duration_en' => 'required|string|max:50',
            'duration_kh' => 'required|string|max:50',
            'description_en' => 'required|string',
            'description_kh' => 'required|string',
            'requirements_en' => 'required|string',
            'requirements_kh' => 'required|string',
            'tuition_en' => 'required|string|max:50',
            'tuition_kh' => 'required|string|max:50',
            'scholarship_available' => 'boolean',
            'scholarship_info_en' => 'nullable|string',
            'scholarship_info_kh' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $program->update($validated);

        return redirect()->route('admin.admissions.programs.index')->with('success', 'Program updated.');
    }

    public function deleteProgram($id)
    {
        $program = AdmissionProgram::findOrFail($id);
        $program->delete();

        return redirect()->back()->with('success', 'Program deleted.');
    }

    // Intakes Management
    public function intakes()
    {
        $intakes = AdmissionIntake::with('program', 'applications')->orderBy('application_end', 'desc')->get();
        return view('admin.admissions.intakes.index', compact('intakes'));
    }

    public function createIntake()
    {
        $programs = AdmissionProgram::active()->get();
        return view('admin.admissions.intakes.form', compact('programs'));
    }

    public function storeIntake(Request $request)
    {
        $validated = $request->validate([
            'intake_name_en' => 'required|string|max:255',
            'intake_name_kh' => 'required|string|max:255',
            'program_id' => 'required|exists:admission_programs,id',
            'application_start' => 'required|date',
            'application_end' => 'required|date|after:application_start',
            'semester_start' => 'required|date',
            'max_seats' => 'required|integer|min:1',
            'is_open' => 'boolean',
        ]);

        AdmissionIntake::create($validated);

        return redirect()->route('admin.admissions.intakes.index')->with('success', 'Intake created.');
    }

    public function editIntake($id)
    {
        $intake = AdmissionIntake::findOrFail($id);
        $programs = AdmissionProgram::active()->get();
        return view('admin.admissions.intakes.form', compact('intake', 'programs'));
    }

    public function updateIntake(Request $request, $id)
    {
        $intake = AdmissionIntake::findOrFail($id);

        $validated = $request->validate([
            'intake_name_en' => 'required|string|max:255',
            'intake_name_kh' => 'required|string|max:255',
            'program_id' => 'required|exists:admission_programs,id',
            'application_start' => 'required|date',
            'application_end' => 'required|date|after:application_start',
            'semester_start' => 'required|date',
            'max_seats' => 'required|integer|min:1',
            'is_open' => 'boolean',
        ]);

        $intake->update($validated);

        return redirect()->route('admin.admissions.intakes.index')->with('success', 'Intake updated.');
    }

    public function toggleIntake($id)
    {
        $intake = AdmissionIntake::findOrFail($id);
        $intake->update(['is_open' => !$intake->is_open]);

        return redirect()->back()->with('success', 'Intake status toggled.');
    }

    public function deleteIntake($id)
    {
        $intake = AdmissionIntake::findOrFail($id);
        $intake->delete();

        return redirect()->back()->with('success', 'Intake deleted.');
    }
}
