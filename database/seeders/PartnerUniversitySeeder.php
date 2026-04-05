<?php

namespace Database\Seeders;

use App\Models\PartnerActivity;
use App\Models\PartnerUniversity;
use Illuminate\Database\Seeder;

class PartnerUniversitySeeder extends Seeder
{
    public function run(): void
    {
        $universities = [
            [
                'name' => 'University of Melbourne',
                'country' => 'Australia',
                'faculty_or_school' => 'Melbourne Law School',
                'description' => 'The Melbourne Law School is one of the world\'s leading law schools, offering a comprehensive range of undergraduate and postgraduate programs in law.',
                'status' => 'active',
                'official_website' => 'https://law.unimelb.edu.au',
                'activities' => [
                    [
                        'title' => 'MoU Signing Ceremony',
                        'type' => 'mou',
                        'description' => 'Signing of Memorandum of Understanding to establish academic cooperation between the two institutions.',
                        'activity_date' => '2023-03-15',
                        'location' => 'Melbourne, Australia',
                        'visibility' => 'public',
                    ],
                    [
                        'title' => 'Staff Exchange Program',
                        'type' => 'exchange',
                        'description' => 'Two faculty members from NUMiLaw visited Melbourne Law School for a two-week exchange program.',
                        'activity_date' => '2023-09-01',
                        'location' => 'Melbourne, Australia',
                        'visibility' => 'public',
                    ],
                    [
                        'title' => 'International Law Symposium',
                        'type' => 'seminar',
                        'description' => 'Joint symposium on International Trade Law and Dispute Resolution.',
                        'activity_date' => '2024-02-20',
                        'location' => 'Phnom Penh, Cambodia',
                        'visibility' => 'public',
                    ],
                ],
            ],
            [
                'name' => 'Harvard Law School',
                'country' => 'United States',
                'faculty_or_school' => 'Harvard Law School',
                'description' => 'Harvard Law School is one of the oldest and most prestigious law schools in the world, known for its rigorous academic programs and influential alumni.',
                'status' => 'active',
                'official_website' => 'https://hls.harvard.edu',
                'activities' => [
                    [
                        'title' => 'MoU Signing',
                        'type' => 'mou',
                        'description' => 'Partnership agreement signed to promote academic exchange and research collaboration.',
                        'activity_date' => '2022-06-10',
                        'location' => 'Cambridge, USA',
                        'visibility' => 'public',
                    ],
                    [
                        'title' => 'Study Visit to Harvard',
                        'type' => 'study_visit',
                        'description' => 'NUMiLaw students participated in a study visit program at Harvard Law School.',
                        'activity_date' => '2023-07-15',
                        'location' => 'Cambridge, USA',
                        'visibility' => 'public',
                    ],
                    [
                        'title' => 'Guest Lecture Series',
                        'type' => 'workshop',
                        'description' => 'Harvard Law professors delivered a series of guest lectures on comparative law.',
                        'activity_date' => '2024-01-10',
                        'location' => 'Phnom Penh, Cambodia',
                        'visibility' => 'public',
                    ],
                ],
            ],
            [
                'name' => 'National University of Singapore',
                'country' => 'Singapore',
                'faculty_or_school' => 'NUS Faculty of Law',
                'description' => 'The NUS Faculty of Law is a leading Asian law school with a strong emphasis on Asian legal studies and international law.',
                'status' => 'active',
                'official_website' => 'https://law.nus.edu.sg',
                'activities' => [
                    [
                        'title' => 'Academic Cooperation Agreement',
                        'type' => 'mou',
                        'description' => 'MoU signed to establish student and faculty exchange programs.',
                        'activity_date' => '2021-11-20',
                        'location' => 'Singapore',
                        'visibility' => 'public',
                    ],
                    [
                        'title' => 'Joint Research Workshop',
                        'type' => 'workshop',
                        'description' => 'Research workshop on Southeast Asian legal frameworks.',
                        'activity_date' => '2023-05-15',
                        'location' => 'Singapore',
                        'visibility' => 'public',
                    ],
                    [
                        'title' => 'Conference on Asian Legal Systems',
                        'type' => 'conference',
                        'description' => 'Annual conference on legal developments in Asia.',
                        'activity_date' => '2024-03-25',
                        'location' => 'Phnom Penh, Cambodia',
                        'visibility' => 'public',
                    ],
                ],
            ],
            [
                'name' => 'University of Tokyo',
                'country' => 'Japan',
                'faculty_or_school' => 'University of Tokyo Faculty of Law',
                'description' => 'The University of Tokyo Faculty of Law is Japan\'s premier law school, offering comprehensive legal education and research opportunities.',
                'status' => 'active',
                'official_website' => 'https://j.u-tokyo.ac.jp/en/law',
                'activities' => [
                    [
                        'title' => 'Courtesy Meeting',
                        'type' => 'meeting',
                        'description' => 'Initial meeting to discuss potential areas of collaboration.',
                        'activity_date' => '2023-01-20',
                        'location' => 'Tokyo, Japan',
                        'visibility' => 'internal',
                    ],
                    [
                        'title' => 'MoU Signing',
                        'type' => 'mou',
                        'description' => 'Memorandum of Understanding signed for academic cooperation.',
                        'activity_date' => '2023-04-15',
                        'location' => 'Tokyo, Japan',
                        'visibility' => 'public',
                    ],
                    [
                        'title' => 'Student Exchange Program',
                        'type' => 'exchange',
                        'description' => 'First cohort of students exchanged between institutions.',
                        'activity_date' => '2023-09-01',
                        'location' => 'Tokyo, Japan',
                        'visibility' => 'public',
                    ],
                ],
            ],
            [
                'name' => 'Chulalongkorn University',
                'country' => 'Thailand',
                'faculty_or_school' => 'Chulalongkorn University Faculty of Law',
                'description' => 'Chulalongkorn University Faculty of Law is Thailand\'s oldest and most prestigious law school.',
                'status' => 'active',
                'official_website' => 'https://law.chula.ac.th',
                'activities' => [
                    [
                        'title' => 'Regional Legal Seminar',
                        'type' => 'seminar',
                        'description' => 'Joint seminar on Mekong region legal cooperation.',
                        'activity_date' => '2022-08-10',
                        'location' => 'Bangkok, Thailand',
                        'visibility' => 'public',
                    ],
                    [
                        'title' => 'MoU Renewal',
                        'type' => 'mou',
                        'description' => 'Renewal of existing cooperation agreement.',
                        'activity_date' => '2023-12-01',
                        'location' => 'Phnom Penh, Cambodia',
                        'visibility' => 'public',
                    ],
                ],
            ],
        ];

        foreach ($universities as $universityData) {
            $activities = $universityData['activities'];
            unset($universityData['activities']);

            $university = PartnerUniversity::create($universityData);

            foreach ($activities as $activityData) {
                PartnerActivity::create(array_merge($activityData, [
                    'partner_university_id' => $university->id,
                ]));
            }
        }
    }
}
