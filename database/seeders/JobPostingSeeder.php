<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobPosting;
use Carbon\Carbon;

class JobPostingSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Senior Corporate Lawyer',
                'title_km' => 'មេធាវីក្រុមហ៊ុនជាន់ខ្ពស់',
                'company' => 'Rith & Partners Law Firm',
                'company_km' => 'ក្រុមអ្នកប្រឹក្សាច្បាប់ រិទ្ធ និង ដៃគូ',
                'location' => 'Phnom Penh',
                'location_km' => 'ភ្នំពេញ',
                'job_type' => 'full_time',
                'experience_level' => 'senior',
                'description' => 'We are seeking an experienced corporate lawyer to join our growing team. The ideal candidate will have 5+ years of experience in corporate law, mergers and acquisitions, and contract negotiation.',
                'description_km' => 'យើងកំពុងស្វែងរកមេធាវីក្រុមហ៊ុនដែលមានបទពិសោធន៍ដើម្បីចូលរួមជាមួយក្រុមរបស់យើងដែលកំពុងលូតលាស់។ បេក្ខជនដែលល្អបំផុតត្រូវមានបទពិសោធន៍ 5+ ឆ្នាំក្នុងច្បាប់ក្រុមហ៊ុន ការរួមបញ្ចូល និងការចរចាក្រិក្សល់។',
                'requirements' => json_encode([
                    'Bachelor\'s degree in Law (LL.B)',
                    'Licensed to practice law in Cambodia',
                    '5+ years of corporate law experience',
                    'Excellent English and Khmer communication skills',
                    'Strong negotiation and drafting skills'
                ]),
                'requirements_km' => json_encode([
                    'បរិញ្ញាបត្រផ្នែកច្បាប់ (LL.B)',
                    'មានអាជ្ញាប័ណ្ណអនុវត្តច្បាប់នៅកម្ពុជា',
                    'បទពិសោធន៍ច្បាប់ក្រុមហ៊ុន 5+ ឆ្នាំ',
                    'ជំនាញភាសាអង់គ្លេស និងខ្មែរល្អ',
                    'ជំនាញចរចា និងសរសេរខ្លីល្អ'
                ]),
                'benefits' => json_encode([
                    'Competitive salary $1,500 - $2,500/month',
                    'Health insurance coverage',
                    'Professional development opportunities',
                    'Annual performance bonus',
                    'Flexible working hours'
                ]),
                'benefits_km' => json_encode([
                    'ប្រាក់ខែប្រកួតប្រជែង $1,500 - $2,500/ខែ',
                    'ធានារោគសុខុមាលភាព',
                    '�កាសអភិវឌ្ឍអាជីព',
                    'រង្វាន់ប្រចាំឆ្នាំតាមលទ្ធផល',
                    'ម៉ោងធ្វើការប្រកបដោយបណ្តាធិបតិស្មាន'
                ]),
                'salary_min' => 1500,
                'salary_max' => 2500,
                'salary_currency' => 'USD',
                'application_deadline' => Carbon::parse('2024-12-31 23:59:59'),
                'contact_email' => 'careers@rithpartners.com',
                'contact_phone' => '+85523888765',
                'is_featured' => true,
                'is_active' => true,
                'status' => 'active',
                'created_at' => Carbon::now()->subWeeks(2),
                'updated_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'title' => 'Legal Officer - NGO Sector',
                'title_km' => 'មន្រ្តីច្បាប់ - វិស័យអង្គការ',
                'company' => 'Human Rights Organization Cambodia',
                'company_km' => 'អង្គការសិទ្ធិមនុស្សកម្ពុជា',
                'location' => 'Phnom Penh',
                'location_km' => 'ភ្នំពេញ',
                'job_type' => 'full_time',
                'experience_level' => 'mid_level',
                'description' => 'Join our team to make a difference in human rights advocacy. This role involves legal research, policy analysis, and representing the organization in legal proceedings.',
                'description_km' => 'ចូលរួមជាមួយក្រុមរបស់យើងដើម្បីបង្កើតការផ្លាស់ប្តូរនៅក្នុងការតស៊ូមតិសិទ្ធិមនុស្ស។ តួនាទីនេះរួមបញ្ចូលការស្រាវជ្រាវច្បាប់ វិភាគគោលនយោបាយ និងតំណាងអង្គការក្នុងដំណើរការច្បាប់។',
                'requirements' => json_encode([
                    'Law degree (LL.B or higher)',
                    '2-4 years of legal experience',
                    'Passion for human rights work',
                    'Strong research and analytical skills',
                    'Ability to work in multicultural environment'
                ]),
                'requirements_km' => json_encode([
                    'បរិញ្ញាបត្រច្បាប់ (LL.B ឬខ្ពស់)',
                    'បទពិសោធន៍ច្បាប់ 2-4 ឆ្នាំ',
                    'ចំណាប់អារម្មណ៍ខ្លាំងក្នុងការងារសិទ្ធិមនុស្ស',
                    'ជំនាញស្រាវជ្រាវ និងវិភាគខ្លាំង',
                    'សមត្ថភាពធ្វើការនៅក្នុងបរិបទវប្បធម៌ច្រើន'
                ]),
                'benefits' => json_encode([
                    'Competitive NGO salary $800 - $1,200/month',
                    'Health and life insurance',
                    'Training and development opportunities',
                    'International conference attendance',
                    'Meaningful work impact'
                ]),
                'benefits_km' => json_encode([
                    'ប្រាក់ខែអង់គ្លេសកម្ពុជា $800 - $1,200/ខែ',
                    'ធានារោគសុខុមាលភាព និងជីវិត',
                    'ឱកាសបណ្តុះបណ្តាល និងអភិវឌ្ឍ',
                    'ការចូលរួមសន្និសីទអន្តរជាតិ',
                    'ផលប៉ះពាល់ការងារដែលមានអត្ថន័យ'
                ]),
                'salary_min' => 800,
                'salary_max' => 1200,
                'salary_currency' => 'USD',
                'application_deadline' => Carbon::parse('2024-12-15 23:59:59'),
                'contact_email' => 'hr@hrocambodia.org',
                'contact_phone' => '+85523888764',
                'is_featured' => true,
                'is_active' => true,
                'status' => 'active',
                'created_at' => Carbon::now()->subWeeks(3),
                'updated_at' => Carbon::now()->subWeeks(3),
            ],
            [
                'title' => 'Junior Legal Counsel - Banking',
                'title_km' => 'មេធាវីថ្នាក់ក្រោម - ធនាគារ',
                'company' => 'ABA Bank',
                'company_km' => 'ធនាគារ ABA',
                'location' => 'Phnom Penh',
                'location_km' => 'ភ្នំពេញ',
                'job_type' => 'full_time',
                'experience_level' => 'entry_level',
                'description' => 'An exciting opportunity for recent law graduates to start their career in banking law. Receive comprehensive training and mentorship from senior legal professionals.',
                'description_km' => 'ឱកាសដ៏អស្ចារ្យសម្រាប់និស្សិតច្បាប់ថ្មីដើម្បីចាប់ផ្តើមអាជីពរបស់ពួកគេក្នុងច្បាប់ធនាគារ។ ទទួលបានការបណ្តុះបណ្តាលទូលំទូលាយ និងការណែនាំពីអ្នកអនុវត្តច្បាប់ជាន់ខ្ពស់។',
                'requirements' => json_encode([
                    'Recent law graduate (0-2 years experience)',
                    'Strong academic record',
                    'Interest in banking and finance law',
                    'Excellent communication skills',
                    'Willingness to learn and grow'
                ]),
                'requirements_km' => json_encode([
                    'និស្សិតច្បាប់ថ្មី (បទពិសោធន៍ 0-2 ឆ្នាំ)',
                    'កម្រិតសិក្សាល្អ',
                    'ចំណាប់អារម្មណ៍ក្នុងច្បាប់ធនាគារ និងហិរញ្ញវត្ថុ',
                    'ជំនាញទំនាក់ទំនងល្អ',
                    'រួមចំណែកក្នុងការរៀន និងលូតលាស់'
                ]),
                'benefits' => json_encode([
                    'Starting salary $600 - $800/month',
                    'Comprehensive training program',
                    'Mentorship from senior lawyers',
                    'Career advancement opportunities',
                    'Bank employee benefits'
                ]),
                'benefits_km' => json_encode([
                    'ប្រាក់ខែចាប់ផ្តើម $600 - $800/ខែ',
                    'កម្មវិធីបណ្តុះបណ្តាលទូលំទូលាយ',
                    'ការណែនាំពីមេធាវីជាន់ខ្ពស់',
                    'ឱកាសរីកចម្រើនអាជីព',
                    'អតិបរមាបុគ្គលិក�នាគារ'
                ]),
                'salary_min' => 600,
                'salary_max' => 800,
                'salary_currency' => 'USD',
                'application_deadline' => Carbon::parse('2024-11-30 23:59:59'),
                'contact_email' => 'careers@ababank.com',
                'contact_phone' => '+85523888763',
                'is_featured' => false,
                'is_active' => true,
                'status' => 'active',
                'created_at' => Carbon::now()->subWeeks(1),
                'updated_at' => Carbon::now()->subWeeks(1),
            ],
            [
                'title' => 'Legal Research Assistant',
                'title_km' => 'អ្នកជំនួយការស្រាវជ្រាវច្បាប់',
                'company' => 'Independent Research Institute',
                'company_km' => 'វិទ្យាស្ថានស្រាវជ្រាវឯករាជ្យ',
                'location' => 'Remote/Phnom Penh',
                'location_km' => 'ពីចម្ងាយ/ភ្នំពេញ',
                'job_type' => 'part_time',
                'experience_level' => 'entry_level',
                'description' => 'Flexible part-time position for law students or recent graduates to conduct legal research on various topics including constitutional law, human rights, and international law.',
                'description_km' => 'តួនាទីពេលវេលាពេញមួយផ្នែកដែលអាចបត់បែនបានសម្រាប់និស្សិតច្បាប់ ឬនិស្សិតចាស់ថ្មីដើម្បីធ្វើការស្រាវជ្រាវច្បាប់លើប្រធានបទផ្សេងៗរួមមានច្បាប់រដ្ឋធម្មនុញ្ញ សិទ្ធិមនុស្ស និងច្បាប់អន្តរជាតិ។',
                'requirements' => json_encode([
                    'Current law student or recent graduate',
                    'Strong research and writing skills',
                    'Familiarity with legal databases',
                    'Ability to work independently',
                    'Good time management'
                ]),
                'requirements_km' => json_encode([
                    'និស្សិតច្បាប់បច្ចុប្បន្ន ឬនិស្សិតចាស់ថ្មី',
                    'ជំនាញស្រាវជ្រាវ និងសរសេរខ្លាំង',
                    'ស្គាល់មូលដ្ឋានទិន្នន័យច្បាប់',
                    'សមត្ថភាពធ្វើការដោយឯករាជ្យ',
                    'ការគ្រប់គ្រងពេលវេលាល្អ'
                ]),
                'benefits' => json_encode([
                    'Hourly rate $8 - $12',
                    'Flexible work schedule',
                    'Academic credit opportunities',
                    'Networking with legal scholars',
                    'Remote work option'
                ]),
                'benefits_km' => json_encode([
                    'អត្រាក្នុងមួយម៉ោង $8 - $12',
                    'កាលវិភាគធ្វើការបត់បែនបាន',
                    'ឱកាសឥណទានសិក្សា',
                    'បណ្តាញទំនាក់ទំនងជាមួយអ្នកបណ្ឌិតច្បាប់',
                    'ជម្រើសធ្វើការពីចម្ងាយ'
                ]),
                'salary_min' => 8,
                'salary_max' => 12,
                'salary_currency' => 'USD',
                'application_deadline' => Carbon::parse('2024-11-20 23:59:59'),
                'contact_email' => 'research@legalinstitute.org',
                'contact_phone' => '+85523888762',
                'is_featured' => false,
                'is_active' => true,
                'status' => 'active',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
        ];

        foreach ($jobs as $job) {
            JobPosting::create($job);
        }
    }
}