<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $departments = ['Constitutional Law', 'International Law', 'Commercial Law', 'Civil Law', 'Criminal Law', 'Legal Research'];
        
        // Generate placeholder photo URLs using ui-avatars
        $getAvatarUrl = function($name) {
            $slug = Str::slug($name);
            return "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=003A46&color=fff&size=200&font-size=0.4&length=2";
        };
        
        // 10 PhD Professors
        $phdProfessors = [
            ['name' => 'Dr. Sophal Kong', 'title' => 'Professor of Constitutional Law', 'department' => 'Constitutional Law'],
            ['name' => 'Dr. Ratanakiri Chea', 'title' => 'Professor of International Law', 'department' => 'International Law'],
            ['name' => 'Dr. Kheang Sotheara', 'title' => 'Professor of Commercial Law', 'department' => 'Commercial Law'],
            ['name' => 'Dr. Vannak Sokha', 'title' => 'Professor of Civil Law', 'department' => 'Civil Law'],
            ['name' => 'Dr. Piseth Heng', 'title' => 'Professor of Criminal Law', 'department' => 'Criminal Law'],
            ['name' => 'Dr. Sereyroth Thon', 'title' => 'Professor of Legal Research', 'department' => 'Legal Research'],
            ['name' => 'Dr. Narith Chhuon', 'title' => 'Professor of Constitutional Law', 'department' => 'Constitutional Law'],
            ['name' => 'Dr. Kim Heng', 'title' => 'Professor of International Law', 'department' => 'International Law'],
            ['name' => 'Dr. Chansereyroth Mao', 'title' => 'Professor of Commercial Law', 'department' => 'Commercial Law'],
            ['name' => 'Dr. Vanna Bun', 'title' => 'Professor of Civil Law', 'department' => 'Civil Law'],
        ];

        foreach ($phdProfessors as $index => $prof) {
            Faculty::create([
                'name' => $prof['name'],
                'title' => $prof['title'],
                'department' => $prof['department'],
                'bio_en' => 'Distinguished professor with extensive experience in ' . strtolower($prof['department']) . '. Published numerous research papers and books in the field of law.',
                'bio_km' => 'បណ្ឌិតដ៏លេចធ្លោមានបទពិភាក្សាយូរឆ្នាំក្នុង' . ' ' . $prof['department'] . ' ។ បានបោះពុម្ពអត្ថបទស្រាវជ្រាវនិងសៀវភៅជាច្រើនក្នុងវិស័យច្បាប់ ។',
                'specialization_en' => $prof['department'] . ', Legal Framework, Policy Analysis',
                'specialization_km' => $prof['department'] . ', ក្របខ័ណ្ឌច្បាប់, ការវិភាគគោរព',
                'education_en' => 'PhD in Law, Harvard University; LLM, Cambridge University',
                'education_km' => 'បរិញ្ញាបត្រជាន់ខ្ពស់ផ្នែកច្បាប់, សាកលវិទ្យាល័យ Harvard; LLM, សាកលវិទ្យាល័យ Cambridge',
                'email' => strtolower(str_replace(' ', '.', $prof['name'])) . '@num.edu.kh',
                'phone' => '+855 10 ' . rand(100000, 999999),
                'office_location' => 'Building ' . chr(65 + ($index % 3)) . ', Room ' . (100 + $index * 5),
                'office_hours' => 'Monday-Wednesday: 9:00 AM - 12:00 PM',
                'photo' => $getAvatarUrl($prof['name']),
                'status' => 'active',
                'sort_order' => $index + 1,
            ]);
        }

        // 20 Lecturers
        $lecturers = [
            ['name' => 'Mr. Chanrithy Kheang', 'title' => 'Lecturer of Constitutional Law'],
            ['name' => 'Ms. Sreysros Pheak', 'title' => 'Lecturer of International Law'],
            ['name' => 'Mr. Visoth Seang', 'title' => 'Lecturer of Commercial Law'],
            ['name' => 'Ms. Kimhong Hout', 'title' => 'Lecturer of Civil Law'],
            ['name' => 'Mr. Rithy Bun', 'title' => 'Lecturer of Criminal Law'],
            ['name' => 'Ms. Sophorn Phan', 'title' => 'Lecturer of Legal Research'],
            ['name' => 'Mr. Sotheara Chhay', 'title' => 'Lecturer of Constitutional Law'],
            ['name' => 'Ms. Chanserey Roth', 'title' => 'Lecturer of International Law'],
            ['name' => 'Mr. Pheakdey Seang', 'title' => 'Lecturer of Commercial Law'],
            ['name' => 'Ms. Dina Sok', 'title' => 'Lecturer of Civil Law'],
            ['name' => 'Mr. Makara Tum', 'title' => 'Lecturer of Criminal Law'],
            ['name' => 'Ms. Chanmika Ouk', 'title' => 'Lecturer of Legal Research'],
            ['name' => 'Mr. Samnang Huy', 'title' => 'Lecturer of Constitutional Law'],
            ['name' => 'Ms. Leakena Chhay', 'title' => 'Lecturer of International Law'],
            ['name' => 'Mr. Sopanha Seng', 'title' => 'Lecturer of Commercial Law'],
            ['name' => 'Ms. Pisey Koem', 'title' => 'Lecturer of Civil Law'],
            ['name' => 'Mr. Vuthy Sam', 'title' => 'Lecturer of Criminal Law'],
            ['name' => 'Ms. Darareaksmey Ye', 'title' => 'Lecturer of Legal Research'],
            ['name' => 'Mr. Sotheavin Thon', 'title' => 'Lecturer of Constitutional Law'],
            ['name' => 'Ms. Sotheary Phuon', 'title' => 'Lecturer of International Law'],
        ];

        foreach ($lecturers as $index => $lect) {
            $dept = $departments[$index % count($departments)];
            Faculty::create([
                'name' => $lect['name'],
                'title' => $lect['title'],
                'department' => $dept,
                'bio_en' => 'Experienced lecturer in ' . strtolower($dept) . '. Committed to providing quality legal education to students.',
                'bio_km' => 'គ្រូបង្រៀនមានបទពិភាក្សា' . ' ' . $dept . ' ។ ប្តេជ្ញាចូលរួមក្នុងការផ្តល់ការអប់រំផ្នែកច្បាប់ដ៛គ្រប់មុខវិជ្ជាដល់និស្សិត ។',
                'specialization_en' => $dept . ', Legal Writing, Case Analysis',
                'specialization_km' => $dept . ', ការសរសេរច្បាប់, ការវិភាគករណី',
                'education_en' => 'LLM, Royal University of Law and Economics; MA in Law, RUFA',
                'education_km' => 'LLM, សាកលវិទ្យាល័យភូមិន្ទភាចារ្យ; MA ផ្នែកច្បាប់, RUFA',
                'email' => strtolower(str_replace(' ', '.', $lect['name'])) . '@num.edu.kh',
                'phone' => '+855 10 ' . rand(100000, 999999),
                'office_location' => 'Building ' . chr(65 + ($index % 3)) . ', Room ' . (200 + $index * 3),
                'office_hours' => 'Tuesday-Thursday: 1:00 PM - 4:00 PM',
                'photo' => $getAvatarUrl($lect['name']),
                'status' => 'active',
                'sort_order' => 10 + $index,
            ]);
        }

        // 10 Assistant Professors
        $assistantProfessors = [
            ['name' => 'Dr. Sokha Chhorn', 'title' => 'Assistant Professor of Constitutional Law'],
            ['name' => 'Dr. Phallinroth Pheng', 'title' => 'Assistant Professor of International Law'],
            ['name' => 'Dr. Seangly Hor', 'title' => 'Assistant Professor of Commercial Law'],
            ['name' => 'Dr. Ratanakiri Kheang', 'title' => 'Assistant Professor of Civil Law'],
            ['name' => 'Dr. Chandara Seang', 'title' => 'Assistant Professor of Criminal Law'],
            ['name' => 'Dr. Vireakroth Thon', 'title' => 'Assistant Professor of Legal Research'],
            ['name' => 'Dr. Setha Heng', 'title' => 'Assistant Professor of Constitutional Law'],
            ['name' => 'Dr. Rithyya Seang', 'title' => 'Assistant Professor of International Law'],
            ['name' => 'Dr. Chanserey Mao', 'title' => 'Assistant Professor of Commercial Law'],
            ['name' => 'Dr. Vuthy Pheak', 'title' => 'Assistant Professor of Civil Law'],
        ];

        foreach ($assistantProfessors as $index => $asst) {
            $dept = $departments[$index % count($departments)];
            Faculty::create([
                'name' => $asst['name'],
                'title' => $asst['title'],
                'department' => $dept,
                'bio_en' => 'Dedicated assistant professor specializing in ' . strtolower($dept) . '. Actively involved in research and academic publications.',
                'bio_km' => 'បណ្ឌិតជំនួយការផ្នែក' . ' ' . $dept . ' ។ ចូលរួមយ៉ាងសកម្មក្នុងការស្រាវជ្រាវនិងការបោះពុម្ពសៀវភៅ ។',
                'specialization_en' => $dept . ', Comparative Law, Legal Methodology',
                'specialization_km' => $dept . ', ច្បាប់ប្រៀបធៀប, វិធីសាស្ត្រច្បាប់',
                'education_en' => 'PhD in Law, Royal University of Law and Economics; LLM, Stanford University',
                'education_km' => 'បរិញ្ញាបត្រជាន់ខ្ពស់ផ្នែកច្បាប់, សាកលវិទ្យាល័យភូមិន្ទភាចារ្យ; LLM, សាកលវិទ្យាល័យ Stanford',
                'email' => strtolower(str_replace(' ', '.', $asst['name'])) . '@num.edu.kh',
                'phone' => '+855 10 ' . rand(100000, 999999),
                'office_location' => 'Building ' . chr(65 + ($index % 3)) . ', Room ' . (150 + $index * 4),
                'office_hours' => 'Monday-Friday: 10:00 AM - 12:00 PM',
                'photo' => $getAvatarUrl($asst['name']),
                'status' => 'active',
                'sort_order' => 30 + $index,
            ]);
        }

        $this->command->info('Faculty members seeded successfully with photos!');
    }
}
