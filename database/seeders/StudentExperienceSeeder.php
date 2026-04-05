<?php

namespace Database\Seeders;

use App\Models\StudentExperience;
use App\Models\CampusGallery;
use App\Models\StudentClub;
use App\Models\InternshipStory;
use Illuminate\Database\Seeder;

class StudentExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'student_name' => 'Sokha Meth',
                'batch_year' => 2022,
                'program' => 'Bachelor of Law',
                'story_en' => 'My time at NUMiLaw has been transformative. The Moot Court program gave me practical litigation skills that textbooks could never teach. I participated in the National Moot Court Competition and won best speaker. The faculty members are supportive and always encourage us to think critically about legal issues.',
                'story_kh' => 'រយៈពេលនៅ NUMiLaw របស់ខ្ញុំបានផ្លាស់ប្8ត្រជាសំខាន់។ កម្មវិធី Moot Court បានផ្តល់ឱ្យខ្ញុំនូវជំនាញអាជីវកម្មតុលាការដែលសៀវភៅមិនអាចបង្រៀនបានទេ។ ខ្ញុំបានចូលរួមក្នុងការប្រកួតប្រជែង Moot Court ជាតិហើយឈ្នះជាអ្នកនិយាយល្អបំផុត។',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'student_name' => 'Kimsreang Chhay',
                'batch_year' => 2021,
                'program' => 'Master of Law',
                'story_en' => 'The graduate program at NUMiLaw exceeded my expectations. The research opportunities and international law workshops helped me develop expertise in ASEAN legal frameworks. I am now working as a legal consultant for an international NGO.',
                'story_kh' => 'កម្មវិធីសិក្សា�.aftergraduate នៅ NUMiLaw បានលើសពី what I expected ។ ឱកាសស្រាវជ្រាវ និង សិក្ខាសាលាច្បាប់អន្តរជាតិបានជួយខ្ញុំអភិវឌ្ឍន៍ជំនាញក្នុងក្របខ័ណ្ឌច្បាប់ ASEAN ។',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'student_name' => 'Vanna Sorn',
                'batch_year' => 2023,
                'program' => 'Bachelor of Law',
                'story_en' => 'What I love most about NUMiLaw is the supportive community. The alumni network helped me secure my internship at a top law firm in Phnom Penh. The bilingual education model prepared me well for the global legal profession.',
                'story_kh' => 'អ្វីដែលខ្ញុំចូលចិត្តបំផុតអំពី NUMiLaw គឺសហគមន៍គាំទ្រ។ បណ្តាញអកុសលបានជួយខ្ញុំទទួលបានការអនុវត្តន៍នៅក្រុមហ៊ុនច្បាប់កំពូលមួយក្នុងភ្នំពេញ។',
                'is_featured' => false,
                'status' => 'approved',
            ],
            [
                'student_name' => 'Sokha Kim',
                'batch_year' => 2020,
                'program' => 'Bachelor of Law',
                'story_en' => 'The moot court competitions organized by NUMiLaw gave me confidence in public speaking and legal argumentation. I represented the university in three international competitions and learned so much from each experience.',
                'story_kh' => 'ការប្រកួត Moot Court ដែល NUMiLaw បានរៀបចំបានផ្តល់ទាំងក្តីទុកចិត្ត និង ជំនាញក្នុងការនិយាយសាធារណៈ និង ការប្រកបអាគុយម្បី។ ខ្ញុំបានតំណាងសាកលវិទ្យាល័យក្នុងការប្រកួតអន្តរជាតិចំនួនបី ហើយបានរៀនច្រើនពីបទពិសោធន៍នីមួយៗ។',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'student_name' => 'Chanvimean Tith',
                'batch_year' => 2022,
                'program' => 'Bachelor of Law',
                'story_en' => 'The faculty of law provides excellent mentorship. My professor guided me through my undergraduate thesis on human rights law, which inspired me to pursue a career in public interest law.',
                'story_kh' => 'បណ្ឌិតសភាច្បាប់ផ្តល់ការណែនាំដ៏ល្អ។ គ្រូរបស់ខ្ញុំបានណែនាំខ្ញុំក្នុងសេចក្តីសិក្សាថ្នាក់បរិញ្ញាប័ត្ររបស់ខ្ញុំអំពីច្បាប់សិទ្ធិមនុស្ស ដែលបានបំផុសគំនិតខ្ញុំឱ្យធ្វើអាជីពក្នុងច្បាប់ផលប្រយោជន៍សាធារណៈ។',
                'is_featured' => false,
                'status' => 'approved',
            ],
        ];

        foreach ($experiences as $experience) {
            StudentExperience::create($experience);
        }

        $galleries = [
            ['title_en' => 'Freshman Orientation 2023', 'title_kh' => 'ការណែនាំសិស្សថ្មី ២០២៣', 'media_path' => 'gallery/orientation-1.jpg', 'media_type' => 'photo', 'category' => 'events', 'year' => 2023, 'caption_en' => 'New students at orientation', 'caption_kh' => 'សិស្សថ្មីនៅការណែនាំ'],
            ['title_en' => 'Moot Court Finals', 'title_kh' => 'វគ្គផ្តើម Moot Court', 'media_path' => 'gallery/moot-1.jpg', 'media_type' => 'photo', 'category' => 'moot_court', 'year' => 2023, 'caption_en' => 'Final round of national competition', 'caption_kh' => 'វគ្គផ្តើមនៃការប្រកួតជាតិ'],
            ['title_en' => 'Graduation Ceremony', 'title_kh' => 'ព្រះរាជពិធីប្រគេនសញ្ញាប័ត្រ', 'media_path' => 'gallery/grad-1.jpg', 'media_type' => 'photo', 'category' => 'graduation', 'year' => 2023, 'caption_en' => 'Class of 2023 graduates', 'caption_kh' => 'ថ្នាក់ឆ្នាំ ២០២៣'],
            ['title_en' => 'Law Society Club Meeting', 'title_kh' => 'ប្រជុំក្លឹបសង្គមច្បាប់', 'media_path' => 'gallery/club-1.jpg', 'media_type' => 'photo', 'category' => 'clubs', 'year' => 2023, 'caption_en' => 'Weekly club meeting', 'caption_kh' => 'ប្រជុំប្រសាទ'],
            ['title_en' => 'Legal Aid Clinic', 'title_kh' => 'klinik ជំនួយផ្នែកច្បាប់', 'media_path' => 'gallery/clinic-1.jpg', 'media_type' => 'photo', 'category' => 'general', 'year' => 2022, 'caption_en' => 'Students providing free legal advice', 'caption_kh' => 'សិស្សផ្តល់ប្រឹក្សាច្បាប់ឥតគិតថ្លៃ'],
            ['title_en' => 'International Law Workshop', 'title_kh' => 'សិក្ខាសាលាច្បាប់អន្តរជាតិ', 'media_path' => 'gallery/workshop-1.jpg', 'media_type' => 'photo', 'category' => 'events', 'year' => 2023, 'caption_en' => 'Workshop with international experts', 'caption_kh' => 'សិក្ខាសាលាជាមួយអ្នកជំនាញអន្តរជាតិ'],
            ['title_en' => 'Mock Trial Practice', 'title_kh' => 'ការហាត់ការសវនាការ', 'media_path' => 'gallery/mocktrial-1.jpg', 'media_type' => 'photo', 'category' => 'moot_court', 'year' => 2022, 'caption_en' => 'Students practicing courtroom skills', 'caption_kh' => 'សិស្សហាត់ជំនាញបន្ទាយទេស'],
            ['title_en' => 'Legal Research Competition', 'title_kh' => 'ការប្រកួតស្រាវជ្រាវច្បាប់', 'media_path' => 'gallery/research-1.jpg', 'media_type' => 'photo', 'category' => 'events', 'year' => 2023, 'caption_en' => 'Annual research competition winners', 'caption_kh' => 'អ្នកឈ្នះការប្រកួតស្រាវជ្រាវប្រចាំឆ្នាំ'],
            ['title_en' => 'Campus Life', 'title_kh' => 'ជីវិតក្នុងសាកលវិទ្យាល័យ', 'media_path' => 'gallery/campus-1.jpg', 'media_type' => 'photo', 'category' => 'general', 'year' => 2023, 'caption_en' => 'Beautiful campus grounds', 'caption_kh' => 'ទេសភាពសាកលវិទ្យាល័យ'],
            ['title_en' => 'Alumni Gathering', 'title_kh' => 'ការជួបជុំអកុសល', 'media_path' => 'gallery/alumni-1.jpg', 'media_type' => 'photo', 'category' => 'events', 'year' => 2023, 'caption_en' => 'Annual alumni meetup', 'caption_kh' => 'ការជួបជុំអកុសលប្រចាំឆ្នាំ'],
        ];

        foreach ($galleries as $gallery) {
            CampusGallery::create($gallery);
        }

        $clubs = [
            [
                'name_en' => 'Moot Court Society',
                'name_kh' => 'សង្គម Moot Court',
                'description_en' => 'The premier moot court competition team. We participate in national and international competitions, helping students develop litigation skills through practice hearings and mentoring.',
                'description_kh' => 'ក្រុមឈរឈ្នះការប្រកួត Moot Court កំពូល។ យើងចូលរួមក្នុងការប្រកួតជាតិ និង អន្តរជាតិ ជួយសិស្សអភិវឌ្ឍន៍ជំនាញតុលាការតាមរយៈការហាត់ និង ការណែនាំ។',
                'president_name' => 'Sokha Meth',
                'is_active' => true,
            ],
            [
                'name_en' => 'Debate Society',
                'name_kh' => 'សង្គមជជែក',
                'description_en' => 'Fostering critical thinking and public speaking through regular debate sessions on current legal and social issues. Open to all students passionate about discourse.',
                'description_kh' => 'លើកកម្ពស់ការគិតជំនាញ និង ការនិយាយសាធារណៈតាមរយៈវគ្គជជែកប្រចាំសប្តាហ៍អំពីបញ្ហាច្បាប់ និង សង្គមប�្ចុប្បន្ន។',
                'president_name' => 'Kimsreang Chhay',
                'is_active' => true,
            ],
            [
                'name_en' => 'Legal Aid Club',
                'name_kh' => 'ក្លឹបជំនួយផ្នែកច្បាប់',
                'description_en' => 'Providing free legal assistance to underserved communities. Students gain practical experience while giving back to society through outreach programs and legal clinics.',
                'description_kh' => 'ផ្តល់ជំនួយផ្នែកច្បាប់ឥតគិតថ្លៃដល់សហគមន៍ងាយរងគ្រោះ។ សិស្សទទួលបានបទពិសោធន៍ជាក់ស្តែងខណៈពេលផ្តល់វិជ្ជាជីវៈដល់សង្គមតាមរយៈកម្មវិធី និង klinik ច្បាប់។',
                'president_name' => 'Vanna Sorn',
                'is_active' => true,
            ],
            [
                'name_en' => 'Human Rights Watch',
                'name_kh' => 'ឃ្លាំមើលសិទ្ធិមនុស្ស',
                'description_en' => 'Promoting awareness of human rights issues in Cambodia and internationally. We organize workshops, screenings, and advocacy campaigns throughout the year.',
                'description_kh' => 'លើកកម្ពស់ការយល់ដឹងអំពីបញ្ហាសិទ្ធិមនុស្សនៅកម្ពុជា និង អន្តរជាតិ។ យើងរៀបចំសិក្ខាសាលា ការបង្ហាញ និង យុទ្ធនាការតស៊ូមតិពេញមួយឆ្នាំ។',
                'president_name' => 'Chanvimean Tith',
                'is_active' => true,
            ],
        ];

        foreach ($clubs as $club) {
            StudentClub::create($club);
        }

        $internships = [
            [
                'student_name' => 'Sokha Meth',
                'batch_year' => 2022,
                'company_name' => 'Bara & Associates Law Firm',
                'duration' => '6 months',
                'story_en' => 'My internship at Bara & Associates was an incredible learning experience. I assisted senior lawyers with case research, drafted legal documents, and observed court proceedings. The mentorship I received prepared me well for my legal career.',
                'story_kh' => 'ការអនុវត្តន៍នៅ Bara & Associates គឺជាបទពិសោធន៍រៀនដ៏អស្ចារ្យមួយ។ ខ្ញុំបានជួយច្បាប់ជាន់ខ្ពស់ក្នុងការស្រាវជ្រាវរឿង និង រៀបចំឯកសារច្បាប់ និង បានសង្កេតការណ៍តុលាការ។',
                'status' => 'approved',
                'is_featured' => true,
            ],
            [
                'student_name' => 'Kimsreang Chhay',
                'batch_year' => 2021,
                'company_name' => 'Cambodian Center for Human Rights (CCHR)',
                'duration' => '4 months',
                'story_en' => 'Working at CCHR deepened my understanding of human rights advocacy in Cambodia. I conducted research on civil liberties, assisted with advocacy campaigns, and participated in stakeholder consultations.',
                'story_kh' => 'ការធ្វើការនៅ CCHR បានបន្តស៊ីជម្រៅការយល់ដឹងរបស់ខ្ញុំអំពីការតស៊ូមតិសិទ្ធិមនុស្សនៅកម្ពុជា។ ខ្ញុំបានធ្វើស្រាវជ្រាវអំពីសេរីភាពស៊ីវិល បានជួយក្នុងយុទ្ធនាការតស៊ូមតិ និង បានចូលរួមក្នុងការ ពិភាក្សាជាមួយភាគីពាក់ព័ន្ធ។',
                'status' => 'approved',
                'is_featured' => false,
            ],
            [
                'student_name' => 'Vanna Sorn',
                'batch_year' => 2023,
                'company_name' => 'Ministry of Justice',
                'duration' => '3 months',
                'story_en' => 'The internship at the Ministry of Justice gave me insider knowledge of the Cambodian legal system. I shadowed judges, attended policy meetings, and learned about legislative processes.',
                'story_kh' => 'ការអនុវត្តន៍នៅក្រសួងយុត្តិធម៌បានផ្តល់ចំណេះដឹងផ្ទាល់ខ្លួនខ្ញុំអំពីប្រព័ន្ធច្បាប់កម្ពុជា។ ខ្ញុំបានតាមដាន ច្បាប់ ចូលរួមការប្រជុំ គោរព និង បានរៀនអំពី ដំណើរការច្បាប់។',
                'status' => 'approved',
                'is_featured' => true,
            ],
        ];

        foreach ($internships as $internship) {
            InternshipStory::create($internship);
        }
    }
}
