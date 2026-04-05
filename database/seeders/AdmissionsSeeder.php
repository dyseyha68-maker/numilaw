<?php

namespace Database\Seeders;

use App\Models\AdmissionProgram;
use App\Models\AdmissionIntake;
use App\Models\AdmissionApplication;
use App\Models\AdmissionStatusLog;
use Illuminate\Database\Seeder;

class AdmissionsSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'name_en' => 'Bachelor of Laws (LL.B)',
                'name_kh' => ' បរិញ្ញាប័ត្រវិជ្ជាច្បាប់',
                'degree_level' => 'bachelor',
                'duration_en' => '4 Years',
                'duration_kh' => '៤ ឆ្នាំ',
                'description_en' => 'The Bachelor of Laws (LL.B) program provides comprehensive legal education covering Cambodian law, international law, and legal practice skills.',
                'description_kh' => 'កម្មវិធី បរិញ្ញាប័ត្រវិជ្ជាច្បាប់ ផ្តល់ការអប់រំច្បាប់ទូលំទូលាយ គ្របដណ្តាំច្បាប់កម្ពុជា ច្បាប់អន្តរជាតិ និង ជំនាញអាជីវកម្មច្បាប់។',
                'requirements_en' => 'High school diploma with good academic standing. English proficiency required.',
                'requirements_kh' => 'សញ្ញាប័ត្រវិស័យ ជាមួយ កំរិត សិក្សា ល្អ។ ត្រូវការចេះភាសាអង់គ្លេស។',
                'tuition_en' => '$800/year',
                'tuition_kh' => '$800/ឆ្នាំ',
                'scholarship_available' => true,
                'scholarship_info_en' => 'Merit-based scholarships available for outstanding students covering up to 50% of tuition.',
                'scholarship_info_kh' => 'មានឧបត្ថម្ភ សិក្សា តាម សមិទ្ទេស សម្រាប់ និស្សិត ឆ្នើម រហូតដល់ ៥០% នៃ ថ្លៃ សិក្សា។',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name_en' => 'Master of Laws (LL.M)',
                'name_kh' => ' បណ្ឌិត វិជ្ជាច្បាប់',
                'degree_level' => 'master',
                'duration_en' => '2 Years',
                'duration_kh' => '២ ឆ្នាំ',
                'description_en' => 'The LL.M program offers advanced legal studies with specialization options in Business Law, International Law, and Human Rights.',
                'description_kh' => 'កម្មវិធី បណ្ឌិត ផ្តល់ ការ សិក្សា ច្បាប់ កម្រិត ខ្ពស់ ជាមួយ ជំរើស ឯកទេស ក្នុង ច្បាប់ អាជីវកម្ម ច្បាប់ អន្តរជាតិ និង សិទ្ធិ មនុស្ស។',
                'requirements_en' => 'Bachelor degree in Law with minimum 2.5 GPA. English proficiency required.',
                'requirements_kh' => 'បរិញ្ញាប័ត្រ វិជ្ជាច្បាប់ ជាមួយ GPA យ៉ាងតិច ២.៥។ ត្រូវការ ចេះ ភាសា អង់គ្លេស។',
                'tuition_en' => '$1,200/year',
                'tuition_kh' => '$1,200/ឆ្នាំ',
                'scholarship_available' => false,
                'scholarship_info_en' => null,
                'scholarship_info_kh' => null,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name_en' => 'Master of Business Law',
                'name_kh' => ' បណ្ឌិត ច្បាប់ ពាណិជ្ជកម្ម',
                'degree_level' => 'master',
                'duration_en' => '2 Years',
                'duration_kh' => '២ ឆ្នាំ',
                'description_en' => 'Specialized program focusing on corporate law, trade law, and commercial dispute resolution.',
                'description_kh' => 'កម្មវិធី ឯកទេស ផ្តោត លើ ច្បាប់ ក្រុមហ៊ុន ច្បាប់ ពាណិជ្ជកម្ម និង ការ ដោះស្រាយ វិវាទ ពាណិជ្ជកម្ម។',
                'requirements_en' => 'Bachelor degree in any field. Law background preferred but not required.',
                'requirements_kh' => ' បរិញ្ញាប័ត្រ គ្រប់ វិស័យ ។ ប្រវត្តិ ច្បាប់ ចូលចិត្ត ប៉ុន្តែ មិន ត្រូវការ ទេ។',
                'tuition_en' => '$1,400/year',
                'tuition_kh' => '$1,400/ឆ្នាំ',
                'scholarship_available' => true,
                'scholarship_info_en' => 'Limited scholarships for Cambodian students with financial need.',
                'scholarship_info_kh' => ' ឧបត្ថម្ភ សិក្សា មាន កំណត់ សម្រាប់ និស្សិត ខ្មែរ ដែល ត្រូវ ការ ហិរញ្ញ ។',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($programs as $programData) {
            $program = AdmissionProgram::create($programData);
            
            $intake = AdmissionIntake::create([
                'intake_name_en' => '2025 Intake',
                'intake_name_kh' => ' ទិសេស ២០២៥',
                'program_id' => $program->id,
                'application_start' => '2025-01-01',
                'application_end' => '2025-06-30',
                'semester_start' => '2025-08-01',
                'max_seats' => $program->degree_level === 'bachelor' ? 100 : 50,
                'is_open' => true,
            ]);
        }

        $sampleApplications = [
            [
                'full_name_en' => 'Sokha Kim',
                'full_name_kh' => 'សុខា គីម',
                'date_of_birth' => '2005-05-15',
                'gender' => 'male',
                'nationality' => 'Cambodian',
                'phone' => '012 345 678',
                'email' => 'sokha.kim@email.com',
                'address_en' => 'Phnom Penh, Cambodia',
                'previous_school_en' => 'Preah Sisowath High School',
                'graduation_year' => 2023,
                'gpa' => 3.75,
                'status' => 'submitted',
            ],
            [
                'full_name_en' => 'Sreysreang Chhay',
                'full_name_kh' => 'ស្រីស្រំ ឆៃ',
                'date_of_birth' => '2004-08-22',
                'gender' => 'female',
                'nationality' => 'Cambodian',
                'phone' => '012 987 654',
                'email' => 'sreysreang.chhay@email.com',
                'address_en' => 'Siem Reap, Cambodia',
                'previous_school_en' => 'Kampong Thom High School',
                'graduation_year' => 2022,
                'gpa' => 3.50,
                'status' => 'under_review',
            ],
            [
                'full_name_en' => 'Vanna Sorn',
                'full_name_kh' => 'វណ្ណ សរ',
                'date_of_birth' => '2006-02-10',
                'gender' => 'male',
                'nationality' => 'Cambodian',
                'phone' => '011 234 567',
                'email' => 'vanna.sorn@email.com',
                'address_en' => 'Battambang, Cambodia',
                'previous_school_en' => 'Batbambang High School',
                'graduation_year' => 2024,
                'gpa' => 3.90,
                'status' => 'accepted',
            ],
            [
                'full_name_en' => 'Pich Sothea',
                'full_name_kh' => 'ប៉េ សុថា',
                'date_of_birth' => '2005-11-30',
                'gender' => 'female',
                'nationality' => 'Cambodian',
                'phone' => '010 456 789',
                'email' => 'pich.sothea@email.com',
                'address_en' => 'Kampong Cham, Cambodia',
                'previous_school_en' => 'Kampong Cham High School',
                'graduation_year' => 2023,
                'gpa' => 3.20,
                'status' => 'rejected',
            ],
            [
                'full_name_en' => 'Kimsreang Thoeun',
                'full_name_kh' => 'គីម ស្រេង ធេង',
                'date_of_birth' => '2004-04-18',
                'gender' => 'male',
                'nationality' => 'Cambodian',
                'phone' => '015 678 901',
                'email' => 'kimsreang.thoeun@email.com',
                'address_en' => 'Phnom Penh, Cambodia',
                'previous_school_en' => 'Royal University of Law and Economics',
                'graduation_year' => 2022,
                'gpa' => 3.45,
                'status' => 'submitted',
            ],
        ];

        $programs = AdmissionProgram::all();
        $intakes = AdmissionIntake::all();

        foreach ($sampleApplications as $appData) {
            $intake = $intakes->random();
            $program = $intake->program;
            
            $app = AdmissionApplication::create(array_merge($appData, [
                'intake_id' => $intake->id,
                'program_id' => $program->id,
                'reference_number' => 'NUM-LAW-' . date('Y') . '-' . str_pad(AdmissionApplication::max('id') + 1, 5, '0', STR_PAD_LEFT),
                'submitted_at' => $appData['status'] !== 'draft' ? now()->subDays(rand(1, 30)) : null,
                'ip_address' => '127.0.0.1',
            ]));

            AdmissionStatusLog::create([
                'application_id' => $app->id,
                'status' => $appData['status'],
                'notes' => 'Initial status',
                'changed_by' => 'System',
            ]);
        }
    }
}
