<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        $alumniData = [
            [
                'user_id' => 12, // Alumni users start after admin/faculty/staff
                'student_id' => 'NUM2019001',
                'graduation_year' => 2019,
                'current_job_title' => 'Senior Legal Associate',
                'company' => 'Bakery & Chan Legal Services',
                'industry' => 'Legal Services',
                'location' => 'Phnom Penh',
                'phone' => '+85512887654',
                'linkedin_url' => 'https://linkedin.com/in/sokchanthorn',
                'facebook_url' => 'https://facebook.com/sok.chanthorn',
                'bio' => 'Experienced legal practitioner specializing in corporate law and international arbitration. Passionate about mentoring young lawyers.',
                'achievements' => json_encode([
                    'Best Moot Court Participant 2018',
                    'Young Lawyer of the Year 2021',
                    'Published author on Cambodian Corporate Law'
                ]),
                'skills' => json_encode(['Corporate Law', 'International Arbitration', 'Legal Writing', 'Client Management']),
                'is_featured' => true,
                'is_verified' => true,
                'contact_consent' => true,
                'status' => 'approved',
                'verified_at' => Carbon::now()->subMonths(6),
                'created_at' => Carbon::now()->subMonths(6),
                'updated_at' => Carbon::now()->subMonths(6),
            ],
            [
                'user_id' => 12,
                'student_id' => 'NUM2018002',
                'graduation_year' => 2018,
                'current_job_title' => 'Human Rights Lawyer',
                'company' => 'Cambodian Center for Human Rights',
                'industry' => 'Non-Profit/NGO',
                'location' => 'Phnom Penh',
                'phone' => '+85513987654',
                'linkedin_url' => 'https://linkedin.com/in/bophasreymom',
                'facebook_url' => 'https://facebook.com/bopha.sreymom',
                'bio' => 'Dedicated human rights advocate focusing on women\'s rights and gender equality. Leading several landmark cases.',
                'achievements' => json_encode([
                    'Human Rights Champion Award 2020',
                    'Successful landmark gender discrimination case',
                    'International speaker on women\'s rights'
                ]),
                'skills' => json_encode(['Human Rights Law', 'Gender Equality', 'Legal Advocacy', 'Public Speaking']),
                'is_featured' => true,
                'is_verified' => true,
                'contact_consent' => true,
                'status' => 'approved',
                'verified_at' => Carbon::now()->subMonths(8),
                'created_at' => Carbon::now()->subMonths(8),
                'updated_at' => Carbon::now()->subMonths(8),
            ],
            [
                'user_id' => 13,
                'student_id' => 'NUM2017003',
                'graduation_year' => 2017,
                'current_job_title' => 'Corporate Counsel',
                'company' => 'ACLEDA Bank Plc.',
                'industry' => 'Banking & Finance',
                'location' => 'Phnom Penh',
                'phone' => '+85517765432',
                'linkedin_url' => 'https://linkedin.com/in/kosalmeng',
                'bio' => 'Banking law expert with extensive experience in financial regulations and compliance.',
                'achievements' => json_encode([
                    'Certified Banking Law Specialist',
                    'Implemented new compliance framework',
                    'Speaker at Banking Law Conference 2022'
                ]),
                'skills' => json_encode(['Banking Law', 'Financial Compliance', 'Risk Management', 'Contract Law']),
                'is_featured' => false,
                'is_verified' => true,
                'contact_consent' => false,
                'status' => 'approved',
                'verified_at' => Carbon::now()->subMonths(10),
                'created_at' => Carbon::now()->subMonths(10),
                'updated_at' => Carbon::now()->subMonths(10),
            ],
            [
                'user_id' => 14,
                'student_id' => 'NUM2020004',
                'graduation_year' => 2020,
                'current_job_title' => 'Junior Legal Associate',
                'company' => 'VDB Loi',
                'industry' => 'Legal Services',
                'location' => 'Phnom Penh',
                'phone' => '+85514987654',
                'linkedin_url' => 'https://linkedin.com/in/sreyneangpov',
                'bio' => 'Young legal professional specializing in tax law and investment regulations.',
                'achievements' => json_encode([
                    'Dean\'s List 2019-2020',
                    'Best Tax Law Research Paper 2020'
                ]),
                'skills' => json_encode(['Tax Law', 'Investment Law', 'Legal Research', 'Document Drafting']),
                'is_featured' => false,
                'is_verified' => false,
                'contact_consent' => true,
                'status' => 'approved',
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()->subMonths(4),
            ],
            [
                'user_id' => 15,
                'student_id' => 'NUM2016005',
                'graduation_year' => 2016,
                'current_job_title' => 'Prosecutor',
                'company' => 'Phnom Penh Municipal Court',
                'industry' => 'Government/Judiciary',
                'location' => 'Phnom Penh',
                'phone' => '+85516654321',
                'facebook_url' => 'https://facebook.com/daravuth.hem',
                'bio' => 'Dedicated prosecutor working on criminal cases and ensuring justice is served.',
                'achievements' => json_encode([
                    'Outstanding Prosecutor Award 2021',
                    'Specialized in Financial Crime Cases'
                ]),
                'skills' => json_encode(['Criminal Law', 'Prosecution', 'Case Management', 'Legal Writing']),
                'is_featured' => false,
                'is_verified' => true,
                'contact_consent' => false,
                'status' => 'approved',
                'verified_at' => Carbon::now()->subMonths(12),
                'created_at' => Carbon::now()->subMonths(12),
                'updated_at' => Carbon::now()->subMonths(12),
            ],
        ];

        foreach ($alumniData as $data) {
            Alumni::create($data);
        }
    }
}