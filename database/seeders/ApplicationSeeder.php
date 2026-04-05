<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\AcademicProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $programs = AcademicProgram::all();
        
        if ($programs->isEmpty()) {
            $this->command->warn('No academic programs found. Please run AcademicProgramSeeder first.');
            return;
        }

        $applications = [
            [
                'first_name_en' => 'Sokha',
                'last_name_en' => 'Chhay',
                'first_name_km' => 'សុខា',
                'last_name_km' => 'ឆេង',
                'email' => 'sokha.chhay@email.com',
                'phone' => '+855 12 345 678',
                'date_of_birth' => '2004-05-15',
                'nationality' => 'Cambodian',
                'address' => 'Phnom Penh, Cambodia',
                'high_school' => 'Preah Sisowath High School',
                'graduation_year' => 2022,
                'gpa' => 3.75,
                'english_level' => 'advanced',
                'motivation_letter' => 'I am passionate about pursuing a career in law to contribute to justice and human rights in Cambodia. Your comprehensive program will provide me with the knowledge and skills needed to make a meaningful impact in my community.',
                'experience' => 'Volunteered at a local legal aid clinic for 6 months, assisting with community outreach programs.',
                'achievements' => 'First Place in National Debate Competition 2021, President of Student Council.',
                'reference_name' => 'Dr. Kimpol Suos',
                'reference_email' => 'kimpol.suos@university.edu.kh',
                'reference_phone' => '+855 10 987 654',
                'status' => 'pending',
            ],
            [
                'first_name_en' => 'Vicheka',
                'last_name_en' => 'Lay',
                'first_name_km' => 'វិចេក',
                'last_name_km' => 'ឡាយ',
                'email' => 'vicheka.lay@email.com',
                'phone' => '+855 15 234 567',
                'date_of_birth' => '2003-08-22',
                'nationality' => 'Cambodian',
                'address' => 'Siem Reap, Cambodia',
                'high_school' => 'Siem Reap High School',
                'graduation_year' => 2021,
                'gpa' => 3.90,
                'english_level' => 'fluent',
                'motivation_letter' => 'With a deep interest in international law and human rights, I aim to specialize in cross-border legal matters. The LLB program at NUMiLaw will provide me with the international perspective needed for my future career.',
                'experience' => 'Internship at the Ministry of Justice for 3 months.',
                'achievements' => 'Full Scholarship recipient, Editor of School Newspaper.',
                'reference_name' => 'Prof. Sarith Phok',
                'reference_email' => 'sarith.phok@university.edu.kh',
                'reference_phone' => '+855 12 888 999',
                'status' => 'reviewing',
            ],
            [
                'first_name_en' => 'Rathanak',
                'last_name_en' => 'Meas',
                'first_name_km' => 'រតនៈ',
                'last_name_km' => 'ម៉េស',
                'email' => 'rathanak.meas@email.com',
                'phone' => '+855 17 456 789',
                'date_of_birth' => '2002-11-03',
                'nationality' => 'Cambodian',
                'address' => 'Battambang, Cambodia',
                'high_school' => 'Battambang High School',
                'graduation_year' => 2020,
                'gpa' => 3.50,
                'english_level' => 'intermediate',
                'motivation_letter' => 'I aspire to become a corporate lawyer specializing in business law. The Master of Laws program aligns perfectly with my career goals and will help me develop advanced legal expertise.',
                'experience' => 'Junior Associate at a local law firm for 1 year.',
                'achievements' => 'Best Intern Award 2023.',
                'reference_name' => 'Mr. Sotheara Kem',
                'reference_email' => 'sotheara.kem@lawfirm.com',
                'reference_phone' => '+855 23 456 789',
                'status' => 'approved',
            ],
            [
                'first_name_en' => 'Sreynoch',
                'last_name_en' => 'Thon',
                'first_name_km' => 'ស្រីនូច',
                'last_name_km' => 'ថុន',
                'email' => 'sreynoch.thon@email.com',
                'phone' => '+855 10 111 222',
                'date_of_birth' => '2005-03-18',
                'nationality' => 'Cambodian',
                'address' => 'Kampong Cham, Cambodia',
                'high_school' => 'Kampong Cham High School',
                'graduation_year' => 2023,
                'gpa' => 3.65,
                'english_level' => 'advanced',
                'motivation_letter' => 'As a high school graduate with a keen interest in legal studies, I am excited to begin my journey in law. I hope to use my education to help underserved communities access justice.',
                'experience' => 'Volunteer at community legal awareness programs.',
                'achievements' => 'Top 5 in National Essay Writing Competition.',
                'reference_name' => 'Ms. Sokha Lim',
                'reference_email' => 'sokha.lim@school.edu.kh',
                'reference_phone' => '+855 42 123 456',
                'status' => 'pending',
            ],
            [
                'first_name_en' => 'Kongpheap',
                'last_name_en' => 'Srun',
                'first_name_km' => 'គង់ភាព',
                'last_name_km' => 'ស្រូន',
                'email' => 'kongpheap.srun@email.com',
                'phone' => '+855 16 333 444',
                'date_of_birth' => '1998-07-25',
                'nationality' => 'Cambodian',
                'address' => 'Phnom Penh, Cambodia',
                'high_school' => 'Royal University of Law and Economics',
                'graduation_year' => 2020,
                'gpa' => 3.20,
                'english_level' => 'intermediate',
                'motivation_letter' => 'After working in the legal field for several years, I am seeking to advance my career through the Doctorate in Law program. My goal is to contribute to legal research and academia.',
                'experience' => 'Legal Officer at NGO for 2 years, Paralegal at law firm for 1 year.',
                'achievements' => 'Published article on Cambodian constitutional law.',
                'reference_name' => 'Dr. Chanthearith Khe',
                'reference_email' => 'chanthearith@university.edu.kh',
                'reference_phone' => '+855 23 789 012',
                'status' => 'pending',
            ],
            [
                'first_name_en' => 'Pichpiseth',
                'last_name_en' => 'Sok',
                'first_name_km' => 'ប៉េចបេសេច',
                'last_name_km' => 'សុក',
                'email' => 'pichpiseth.sok@email.com',
                'phone' => '+855 11 555 666',
                'date_of_birth' => '2004-12-10',
                'nationality' => 'Cambodian',
                'address' => 'Takeo, Cambodia',
                'high_school' => 'Takeo Provincial High School',
                'graduation_year' => 2022,
                'gpa' => 3.45,
                'english_level' => 'beginner',
                'motivation_letter' => 'I am committed to pursuing legal education to help my community. While my English is still developing, I am eager to learn and improve through your comprehensive program.',
                'experience' => 'Community volunteer for 1 year.',
                'achievements' => 'Most Improved Student Award.',
                'reference_name' => 'Mr. Bunchheang Ly',
                'reference_email' => 'bunchheang@school.edu.kh',
                'reference_phone' => '+855 32 222 333',
                'status' => 'rejected',
            ],
        ];

        $statuses = ['pending', 'reviewing', 'approved', 'rejected'];

        foreach ($applications as $appData) {
            $program = $programs->random();
            $status = $appData['status'];
            unset($appData['status']);

            Application::create([
                'program_id' => $program->id,
                'application_reference' => 'APP-' . strtoupper(Str::random(8)),
                'first_name_en' => $appData['first_name_en'],
                'last_name_en' => $appData['last_name_en'],
                'first_name_km' => $appData['first_name_km'],
                'last_name_km' => $appData['last_name_km'],
                'email' => $appData['email'],
                'phone' => $appData['phone'],
                'date_of_birth' => $appData['date_of_birth'],
                'nationality' => $appData['nationality'],
                'address' => $appData['address'],
                'high_school' => $appData['high_school'],
                'graduation_year' => $appData['graduation_year'],
                'gpa' => $appData['gpa'],
                'english_level' => $appData['english_level'],
                'motivation_letter' => $appData['motivation_letter'],
                'experience' => $appData['experience'],
                'achievements' => $appData['achievements'],
                'reference_name' => $appData['reference_name'],
                'reference_email' => $appData['reference_email'],
                'reference_phone' => $appData['reference_phone'],
                'status' => $status,
            ]);
        }

        $this->command->info('Applications seeded successfully!');
    }
}
