<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\AcademicProgram;

class AcademicProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title_en' => 'Bachelor of Laws',
                'title_km' => 'បរិញ្ញាប័ត្រផ្នែកច្បាប់',
                'degree_type' => "Bachelor's Degree",
                'description_en' => 'The Bachelor of Laws (LLB) is a four-year undergraduate degree program that provides students with a comprehensive foundation in legal studies. The program covers various aspects of law including civil law, criminal law, constitutional law, international law, and legal research methods.',
                'description_km' => 'បរិញ្ញាប័ត្រផ្នែកច្បាប់ (LLB) គឺជាកម្មវិធីសិក្សាបណ្ឌិត្យសភាក្រោមបួនឆ្នាំដែលផ្តល់ឱ្យនិស្សិតនូវមូលដ្ឋានគ្រឹះសង្គមក្នុងការសិក្សាផ្នែកច្បាប់។',
                'duration_years' => 4,
                'credits_required' => '120',
                'tuition_fee' => 2500.00,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title_en' => 'Master of Laws',
                'title_km' => 'បណ្ឌិត្យសភាផ្នែកច្បាប់',
                'degree_type' => "Master's Degree",
                'description_en' => 'The Master of Laws (LLM) is a postgraduate degree program that provides advanced legal education with specializations in International Law, Business Law, and Constitutional Law. This program is designed for law graduates seeking to deepen their expertise.',
                'description_km' => 'បណ្ឌិត្យសភាផ្នែកច្បាប់ (LLM) គឺជាកម្មវិធីអប់រំផ្នែកច្បាប់ក្រោមកម្រិត ដែលផ្តល់ជំនាញក្នុង ច្បាប់អន្តរជាតិ ច្បាប់ ពាណិជ្ជកម្ម និង ច្បាប់រដ្ឋធម្មនុញ្ញ ។',
                'duration_years' => 2,
                'credits_required' => '36',
                'tuition_fee' => 4500.00,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title_en' => 'Doctorate in Law',
                'title_km' => ' បណ្ឌិត្យសភាបីផ្នែកច្បាប់',
                'degree_type' => 'Doctorate',
                'description_en' => 'The Doctorate in Law (PhD) is the highest academic degree in law, requiring original research and contribution to legal scholarship. This program prepares graduates for academic careers and senior legal positions.',
                'description_km' => ' បណ្ឌិត្យសភាផ្នែកច្បាប់ (PhD) គឺជា ប្រណាំង សញ្ញា ខ្ពស់ បំផុត ក្នុង វិស័យ ច្បាប់ ។ កម្មវិធី នេះ ត្រូវ ការ ស្រាវ ជ្រាវ ដំបូង និង ការ រួម ចំណោ ចំណេះ វិជ្ជា ច្បាប់ ។',
                'duration_years' => 3,
                'credits_required' => '24',
                'tuition_fee' => 8000.00,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title_en' => 'Diploma in Legal Studies',
                'title_km' => 'សញ្ញាបត្រក្នុងការសិក្សាច្បាប់',
                'degree_type' => 'Certificate',
                'description_en' => 'The Diploma in Legal Studies is a one-year certificate program designed for professionals seeking foundational legal knowledge. It covers basic legal principles, contract law, and property law.',
                'description_km' => ' សញ្ញា បត្រ ក្នុង ការ សិក្សា ច្បាប់ គឺ ជា កម្មវិធី ប្រមូល យក មួយ ឆ្នាំ ដែល ត្រូវ បាន រចនា សម្រាប់ អ្នក ប្រសូត ដែល ចង់ បាន ចំណេះ វិជ្ជា ច្បាប់ មូល ដ្ឋាន ។',
                'duration_years' => 1,
                'credits_required' => '30',
                'tuition_fee' => 1200.00,
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($programs as $program) {
            AcademicProgram::create([
                'title_en' => $program['title_en'],
                'title_km' => $program['title_km'],
                'slug' => Str::slug($program['title_en']),
                'degree_type' => $program['degree_type'],
                'description_en' => $program['description_en'],
                'description_km' => $program['description_km'],
                'duration_years' => $program['duration_years'],
                'credits_required' => $program['credits_required'],
                'tuition_fee' => $program['tuition_fee'],
                'is_active' => $program['is_active'],
                'sort_order' => $program['sort_order'],
            ]);
        }

        $this->command->info('Academic programs seeded successfully!');
    }
}
