<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AdmissionProgram;
use App\Models\AdmissionIntake;
use App\Models\AdmissionApplication;
use App\Mail\ApplicationConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdmissionsController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        
        $programs = AdmissionProgram::active()
            ->with(['intakes' => function($q) {
                $q->open();
            }])
            ->orderBy('sort_order')
            ->get()
            ->groupBy('degree_level');
        
        $openIntakes = AdmissionIntake::with('program')
            ->open()
            ->get();
        
        $faqs = [
            [
                'question_en' => 'What are the admission requirements?',
                'question_kh' => 'តើតំរូវការទទួលយកជាអ្វី?',
                'answer_en' => 'Requirements vary by program. Generally, you need a high school diploma (for Bachelor) or a Bachelor degree (for Master). English proficiency is required.',
                'answer_kh' => 'តំរូវការប្រែប្រួលតាមកម្មវិធី។ ជាទូទៅ អ្នកត្រូវមានសញ្ញាប័ត្រវិស័យ (សម្រាប់បរិញ្ញាប័ត្រ) ឬ បរិញ្ញាប័ត្រ (សម្រាប់បណ្ឌិត)។ ត្រូវការចេះភាសាអង់គ្លេស។',
            ],
            [
                'question_en' => 'How do I apply?',
                'question_kh' => 'តើខ្ញុំដាក់ពាក់យ៉ាងម៉េច?',
                'answer_en' => 'You can apply online by clicking the "Apply Now" button. Fill out the application form and submit the required documents.',
                'answer_kh' => 'អ្នកអាចដាក់ពាក់តាមអនឡាញដោយចុចប៊ូតុង "Apply Now" ។ បំពេញទំរង់ពាក់កណ្តាល និង ដាក់ឯកសារចាំបាច់។',
            ],
            [
                'question_en' => 'What is the tuition fee?',
                'question_kh' => 'តើថ្លៃសិក្សាប៉ុន្មាន?',
                'answer_en' => 'Tuition fees vary by program. Bachelor programs start at $800/year, Master programs at $1,200/year. Scholarships are available for qualifying students.',
                'answer_kh' => 'ថ្លៃសិក្សាប្រែប្រួលតាមកម្មវិធី។ កម្មវិធីបរិញ្ញាប័ត្រចាប់ពី $800/ឆ្នាំ កម្មវិធីបណ្ឌិតចាប់ពី $1,200/ឆ្នាំ។ មានសេវាកម្មឧបត្ថម្ភសិក្សាសម្រាប់និស្សិតគុណលក្ខណៈ។',
            ],
            [
                'question_en' => 'Are scholarships available?',
                'question_kh' => 'តើមានឧបត្ថម្ភសិក្សាទេ?',
                'answer_en' => 'Yes, NUMiLaw offers scholarships for outstanding students based on academic performance and financial need.',
                'answer_kh' => 'បាទ/ចាស យើងផ្តល់ឧបត្ថម្ភសិក្សាសម្រាប់និស្សិតឆ្នើមតាមសមិទ្ទេសន៍ និង តម្រូវការហិរញ្ញវត្ថុ។',
            ],
            [
                'question_en' => 'What is the language of instruction?',
                'question_kh' => 'តើភាសាបង្រៀនជាភាសាអ្វី?',
                'answer_en' => 'NUMiLaw offers bilingual education in both English and Khmer. Students can choose their preferred language of instruction.',
                'answer_kh' => 'NUMiLaw ផ្តល់ការអប់រំជាភាសាទាំងពីរ អង់គ្លេស និង ខ្មែរ។ និស្សិតអាចជ្រើសរើសភាសាបង្រៀនដែលពេញចិត្ត។',
            ],
            [
                'question_en' => 'How can I track my application status?',
                'question_kh' => 'តើខ្ញុំអាចតាមដំណើរពាក្យដាក់ពាក់យ៉ាងម៉េច?',
                'answer_en' => 'Use your reference number sent to your email to track your application on our website using the "Track Application" feature.',
                'answer_kh' => 'ប្រើលេខយោងដែលផ្ញើទៅអ៊ីមែលរបស់អ្នក ដើម្បីតាមដំណើរពាក្យនៅលេខគេហទំព័ររបស់យើង តាមរយៈមុខងារ "Track Application" ។',
            ],
        ];

        return view('public.admissions.index', compact('locale', 'programs', 'openIntakes', 'faqs'));
    }

    public function programs()
    {
        $locale = app()->getLocale();
        $programs = AdmissionProgram::active()
            ->with('openIntakes')
            ->orderBy('sort_order')
            ->get();

        return view('public.admissions.programs', compact('locale', 'programs'));
    }

    public function programDetail($id)
    {
        $locale = app()->getLocale();
        $program = AdmissionProgram::with('openIntakes')->findOrFail($id);

        return view('public.admissions.program-detail', compact('locale', 'program'));
    }

    public function apply()
    {
        $locale = app()->getLocale();
        $intakes = AdmissionIntake::with('program')->open()->get();
        $programs = AdmissionProgram::active()->get();

        return view('public.admissions.apply', compact('locale', 'intakes', 'programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'intake_id' => 'required|exists:admission_intakes,id',
            'program_id' => 'required|exists:admission_programs,id',
            'full_name_en' => 'required|string|max:255',
            'full_name_kh' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'nationality' => 'required|string|max:100',
            'id_card_number' => 'nullable|string|max:50',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address_en' => 'required|string',
            'address_kh' => 'nullable|string',
            'previous_school_en' => 'required|string|max:255',
            'previous_school_kh' => 'nullable|string|max:255',
            'graduation_year' => 'required|integer|min:1990|max:2030',
            'gpa' => 'nullable|numeric|min:0|max:4',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'id_card' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
            'transcript' => 'nullable|file|mimes:pdf|max:5120',
            'recommendation_letter' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $application = new AdmissionApplication();
        $application->fill($validated);
        $application->status = 'submitted';
        $application->submitted_at = now();
        $application->ip_address = $request->ip();
        
        $maxId = AdmissionApplication::max('id') ?? 0;
        $referenceNumber = 'NUM-LAW-' . date('Y') . '-' . str_pad($maxId + 1, 5, '0', STR_PAD_LEFT);
        $application->reference_number = $referenceNumber;

        $application->save();

        $folder = 'applications/' . $referenceNumber;
        
        if ($request->hasFile('certificate')) {
            $application->certificate_path = $request->file('certificate')->store($folder, 'public');
        }
        if ($request->hasFile('id_card')) {
            $application->id_card_path = $request->file('id_card')->store($folder, 'public');
        }
        if ($request->hasFile('photo')) {
            $application->photo_path = $request->file('photo')->store($folder, 'public');
        }
        if ($request->hasFile('transcript')) {
            $application->transcript_path = $request->file('transcript')->store($folder, 'public');
        }
        if ($request->hasFile('recommendation_letter')) {
            $application->recommendation_letter_path = $request->file('recommendation_letter')->store($folder, 'public');
        }

        $application->save();

        // Log status
        \App\Models\AdmissionStatusLog::create([
            'application_id' => $application->id,
            'status' => 'submitted',
            'notes' => 'Application submitted online',
            'changed_by' => 'System',
        ]);

        // Send confirmation email
        $locale = app()->getLocale();
        $programName = $locale === 'kh' ? $application->program->name_kh : $application->program->name_en;
        
        try {
            Mail::to($application->email)->send(new ApplicationConfirmation(
                $application->full_name_en,
                $application->reference_number,
                $programName,
                $locale
            ));
        } catch (\Exception $e) {
            // Continue even if email fails
        }

        return redirect()->route('admissions.track', ['ref' => $application->reference_number])
            ->with('success', $locale === 'kh' 
                ? 'ពាក្យដាក់ពាក់កណ្តាលរបស់អ្នកបានទទួលយក!'
                : 'Your application has been submitted successfully!');
    }

    public function track()
    {
        $locale = app()->getLocale();
        return view('public.admissions.track', compact('locale'));
    }

    public function trackResult(Request $request)
    {
        $request->validate([
            'reference_number' => 'required|string',
            'contact' => 'required|string',
        ]);

        $application = AdmissionApplication::where('reference_number', $request->reference_number)
            ->where(function($query) use ($request) {
                $query->where('email', $request->contact)
                    ->orWhere('phone', $request->contact);
            })
            ->with(['program', 'intake', 'statusLogs'])
            ->first();

        if (!$application) {
            return redirect()->back()->with('error', app()->getLocale() === 'kh'
                ? 'រកមិនឃើញពាក្យដាក់ពាក់កណ្តាលទេ។ សូមពិនិត្យលេខយោង និង ទំនាក់ទំនងរបស់អ្នក។'
                : 'Application not found. Please check your reference number and contact information.');
        }

        $locale = app()->getLocale();
        return view('public.admissions.track-result', compact('locale', 'application'));
    }
}
