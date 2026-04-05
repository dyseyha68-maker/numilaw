<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlumniEvent;
use Carbon\Carbon;

class AlumniEventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'NUMiLaw Alumni Annual Reunion 2024',
                'title_km' => 'កិច្ចប្រជុំនិស្សិតចាស់ NUMiLaw ប្រចាំឆ្នាំ 2024',
                'description' => 'Join us for the biggest alumni gathering of the year! Network with fellow graduates, meet faculty members, and celebrate our collective achievements.',
                'description_km' => 'ចូលរួមជាមួយយើងក្នុងពិធីប្រជុំនិស្សិតចាស់ធំបំផុតនៃឆ្នាំ! ភ្ជាប់ទំនាក់ទំនងជាមួយនិស្សិតចាស់ផ្សេងទៀត ជួបនឹងសាស្ត្រាចារ្យ និងសម្តែងអំណរគុណលើជោគជ័យរួមរបស់យើង។',
                'event_type' => 'reunion',
                'location' => 'NUMiLaw Main Campus, Phnom Penh',
                'location_km' => 'សាលា NUMiLaw ទីតាំងចម្បង ភ្នំពេញ',
                'start_date' => Carbon::parse('2024-12-15 17:00:00'),
                'end_date' => Carbon::parse('2024-12-15 21:00:00'),
                'registration_deadline' => Carbon::parse('2024-12-10 23:59:59'),
                'max_participants' => 200,
                'current_participants' => 145,
                'is_featured' => true,
                'is_active' => true,
                'status' => 'upcoming',
                'organizer_name' => 'Alumni Association',
                'organizer_email' => 'alumni@numilaw.edu.kh',
                'organizer_phone' => '+85523888999',
                'registration_requirements' => json_encode([
                    'Must be a NUMiLaw graduate',
                    'Bring alumni ID or graduation certificate',
                    'Formal attire recommended'
                ]),
                'agenda' => json_encode([
                    '17:00 - 17:30' => 'Registration & Welcome Drinks',
                    '17:30 - 18:30' => 'Networking Session',
                    '18:30 - 19:30' => 'Dinner & Awards Ceremony',
                    '19:30 - 20:30' => 'Entertainment & Speeches',
                    '20:30 - 21:00' => 'Closing Remarks'
                ]),
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()->subMonths(2),
            ],
            [
                'title' => 'Legal Career Development Workshop',
                'title_km' => 'សិក្ខាសាលាអភិវឌ្ឍអាជីពច្បាប់',
                'description' => 'Enhance your legal career with insights from industry experts. Topics include career transitions, specialization opportunities, and future trends in legal practice.',
                'description_km' => 'បង្កើនអាជីពច្បាប់របស់អ្នកជាមួយនឹងទស្សនៈពីអ្នកជំនាញឧស្សាហកម្ម។ ប្រធានបទរួមមានការផ្លាស់ប្តូរអាជីព ឱកាសឯកទេស និងនិន្នាការអនាគតនៃការអនុវត្តច្បាប់។',
                'event_type' => 'workshop',
                'location' => 'NUMiLaw Conference Hall, Phnom Penh',
                'location_km' => '�ាលាប្រជុំ NUMiLaw ភ្នំពេញ',
                'start_date' => Carbon::parse('2024-11-20 09:00:00'),
                'end_date' => Carbon::parse('2024-11-20 12:00:00'),
                'registration_deadline' => Carbon::parse('2024-11-15 23:59:59'),
                'max_participants' => 50,
                'current_participants' => 38,
                'is_featured' => false,
                'is_active' => true,
                'status' => 'upcoming',
                'organizer_name' => 'Career Services Office',
                'organizer_email' => 'career@numilaw.edu.kh',
                'organizer_phone' => '+85523888998',
                'registration_requirements' => json_encode([
                    'Open to all alumni',
                    'Professional dress required',
                    'Bring updated CV for review'
                ]),
                'agenda' => json_encode([
                    '09:00 - 09:15' => 'Welcome & Introduction',
                    '09:15 - 10:00' => 'Career Planning Strategies',
                    '10:00 - 10:45' => 'Specialization Opportunities',
                    '10:45 - 11:00' => 'Coffee Break',
                    '11:00 - 11:45' => 'Future Legal Trends',
                    '11:45 - 12:00' => 'Q&A Session'
                ]),
                'created_at' => Carbon::now()->subMonths(1),
                'updated_at' => Carbon::now()->subMonths(1),
            ],
            [
                'title' => 'Alumni-Student Mentoring Program Launch',
                'title_km' => 'កម្មវិធីណែនាំនិស្សិតចាស់-និស្សិតថ្មី',
                'description' => 'Connect with current students and share your professional experience. Help guide the next generation of legal professionals.',
                'description_km' => 'ភ្ជាប់ទំនាក់ទំនងជាមួយនិស្សិតបច្ចុប្បន្ន និងចែករំលែកបទពិសោធន៍អាជីពរបស់អ្នក។ ជួយណែនាំជំនាន់ក្រោយនៃអ្នកអនុវត្តច្បាប់។',
                'event_type' => 'networking',
                'location' => 'NUMiLaw Library, Phnom Penh',
                'location_km' => 'បណ្ណាល័យ NUMiLaw ភ្នំពេញ',
                'start_date' => Carbon::parse('2024-10-25 14:00:00'),
                'end_date' => Carbon::parse('2024-10-25 17:00:00'),
                'registration_deadline' => Carbon::parse('2024-10-20 23:59:59'),
                'max_participants' => 30,
                'current_participants' => 25,
                'is_featured' => false,
                'is_active' => true,
                'status' => 'upcoming',
                'organizer_name' => 'Student Affairs Office',
                'organizer_email' => 'studentaffairs@numilaw.edu.kh',
                'organizer_phone' => '+85523888997',
                'registration_requirements' => json_encode([
                    'Alumni with 2+ years of experience preferred',
                    'Commitment to monthly mentoring sessions',
                    'Complete mentor training program'
                ]),
                'agenda' => json_encode([
                    '14:00 - 14:30' => 'Program Overview',
                    '14:30 - 15:30' => 'Mentor Training',
                    '15:30 - 16:00' => 'Break & Refreshments',
                    '16:00 - 16:45' => 'Student-Mentor Matching',
                    '16:45 - 17:00' => 'Next Steps'
                ]),
                'created_at' => Carbon::now()->subWeeks(3),
                'updated_at' => Carbon::now()->subWeeks(3),
            ],
            [
                'title' => 'Legal Technology Conference 2024',
                'title_km' => 'សន្និសីទបច្ចេកវិទ្យាច្បាប់ 2024',
                'description' => 'Explore how technology is transforming the legal profession. Learn about AI, legal tech tools, and digital transformation in law practice.',
                'description_km' => 'ស្វែងយល់ពីរបៀបដែលបច្ចេកវិទ្យាកំពុងផ្លាស់ប្តូរវិស័យច្បាប់។ ស្វែងយល់អំពី AI ឧបករណ៍បច្ចេកវិទ្យាច្បាប់ និងការផ្លាស់ប្តូរឌីជីថលក្នុងការអនុវត្តច្បាប់។',
                'event_type' => 'conference',
                'location' => 'Phnom Penh Hotel, Conference Center',
                'location_km' => 'ភ្នំពេញ ហូតែល មជ្ឈមណ្ឌលសន្និសីទ',
                'start_date' => Carbon::parse('2024-09-15 08:30:00'),
                'end_date' => Carbon::parse('2024-09-15 17:30:00'),
                'registration_deadline' => Carbon::parse('2024-09-10 23:59:59'),
                'max_participants' => 150,
                'current_participants' => 142,
                'is_featured' => true,
                'is_active' => true,
                'status' => 'completed',
                'organizer_name' => 'Legal Innovation Center',
                'organizer_email' => 'innovation@numilaw.edu.kh',
                'organizer_phone' => '+85523888996',
                'registration_requirements' => json_encode([
                    'Registration fee: $50 for alumni',
                    'Includes conference materials & lunch',
                    'Early bird discount available'
                ]),
                'agenda' => json_encode([
                    '08:30 - 09:00' => 'Registration & Coffee',
                    '09:00 - 10:30' => 'Keynote: AI in Legal Practice',
                    '10:30 - 11:00' => 'Coffee Break',
                    '11:00 - 12:30' => 'Panel: Legal Tech Tools',
                    '12:30 - 13:30' => 'Networking Lunch',
                    '13:30 - 15:00' => 'Workshop: Digital Transformation',
                    '15:00 - 15:30' => 'Break',
                    '15:30 - 17:00' => 'Future Trends Discussion',
                    '17:00 - 17:30' => 'Closing Remarks'
                ]),
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()->subMonths(4),
            ],
        ];

        foreach ($events as $event) {
            AlumniEvent::create($event);
        }
    }
}