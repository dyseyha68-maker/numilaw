<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlumniSurveyResponse;
use Carbon\Carbon;

class AlumniSurveyResponseSeeder extends Seeder
{
    public function run(): void
    {
        $responses = [
            [
                'alumni_id' => 1,
                'survey_type' => 'career_satisfaction',
                'responses' => json_encode([
                    'job_satisfaction' => 'very_satisfied',
                    'salary_satisfaction' => 'satisfied',
                    'work_life_balance' => 'good',
                    'career_advancement' => 'excellent',
                    'numilaw_preparation' => 'very_well_prepared',
                    'recommendation_score' => 9,
                    'favorite_course' => 'Corporate Law',
                    'most_valuable_skill' => 'Legal Research & Writing',
                    'continuing_education' => 'Yes, pursuing LLM',
                    'networking_importance' => 'very_important'
                ]),
                'additional_comments' => 'NUMiLaw provided an excellent foundation for my legal career. The moot court competitions were particularly valuable in developing practical skills.',
                'additional_comments_km' => 'NUMiLaw បានផ្តល់គ្រឹះដ៏ល្អប្រសើរសម្រាប់អាជីពច្បាប់របស់ខ្ញុំ។ ការប្រកួត Moot Court មានតម្លៃពិសេសក្នុងការអភិវឌ្ឍជំនាញជាក់ស្តែង។',
                'response_date' => Carbon::parse('2024-11-15'),
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(3),
            ],
            [
                'alumni_id' => 2,
                'survey_type' => 'career_satisfaction',
                'responses' => json_encode([
                    'job_satisfaction' => 'very_satisfied',
                    'salary_satisfaction' => 'neutral',
                    'work_life_balance' => 'excellent',
                    'career_advancement' => 'good',
                    'numilaw_preparation' => 'well_prepared',
                    'recommendation_score' => 10,
                    'favorite_course' => 'Human Rights Law',
                    'most_valuable_skill' => 'Legal Advocacy',
                    'continuing_education' => 'Yes, international law courses',
                    'networking_importance' => 'critical'
                ]),
                'additional_comments' => 'While salaries in NGO sector may not be as high, the fulfillment from serving justice is immeasurable. NUMiLaw prepared me well for public interest law.',
                'additional_comments_km' => 'ទោះបីជាប្រាក់ខែក្នុងវិស័យអង្គការមិនខ្ពស់ក៏ដោយ ការពេញចិត្តពីការបម្រើយុត្តិធម៌គឺមិនអាចវាស់បាន។ NUMiLaw បានរៀបចំខ្ញុំឱ្យល្អសម្រាប់ច្បាប់ផលប្រយោជន៍សាធារណៈ។',
                'response_date' => Carbon::parse('2024-11-20'),
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(3),
            ],
            [
                'alumni_id' => 3,
                'survey_type' => 'career_satisfaction',
                'responses' => json_encode([
                    'job_satisfaction' => 'satisfied',
                    'salary_satisfaction' => 'very_satisfied',
                    'work_life_balance' => 'good',
                    'career_advancement' => 'good',
                    'numilaw_preparation' => 'well_prepared',
                    'recommendation_score' => 8,
                    'favorite_course' => 'Banking & Finance Law',
                    'most_valuable_skill' => 'Contract Drafting',
                    'continuing_education' => 'Yes, banking certifications',
                    'networking_importance' => 'important'
                ]),
                'additional_comments' => 'The banking sector offers good career growth and compensation. NUMiLaw\'s foundation was essential for my specialization.',
                'additional_comments_km' => 'វិស័យធនាគារផ្តល់នូវការរីកចម្រើនអាជីព និងការត្រឡប់មកវិញល្អ។ គ្រឹះ NUMiLaw គឺចាំបាច់សម្រាប់ជំនាញរបស់ខ្ញុំ។',
                'response_date' => Carbon::parse('2024-11-10'),
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(3),
            ],
            [
                'alumni_id' => 4,
                'survey_type' => 'career_satisfaction',
                'responses' => json_encode([
                    'job_satisfaction' => 'satisfied',
                    'salary_satisfaction' => 'neutral',
                    'work_life_balance' => 'good',
                    'career_advancement' => 'developing',
                    'numilaw_preparation' => 'well_prepared',
                    'recommendation_score' => 9,
                    'favorite_course' => 'Tax Law',
                    'most_valuable_skill' => 'Legal Research',
                    'continuing_education' => 'Yes, tax specialization courses',
                    'networking_importance' => 'very_important'
                ]),
                'additional_comments' => 'As a recent graduate, I\'m still building my career. The foundation from NUMiLaw has been crucial in my early professional development.',
                'additional_comments_km' => 'ជានិស្សិតចាស់ថ្មី ខ្ញុំកំពុងតែស្ថាបនាអាជីពរបស់ខ្ញុំ។ គ្រឹះពី NUMiLaw មានតួនាទីសំខាន់ក្នុងការអភិវឌ្ឍអាជីពដំបូងរបស់ខ្ញុំ។',
                'response_date' => Carbon::parse('2024-11-25'),
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()->subMonths(2),
            ],
            [
                'alumni_id' => 5,
                'survey_type' => 'career_satisfaction',
                'responses' => json_encode([
                    'job_satisfaction' => 'very_satisfied',
                    'salary_satisfaction' => 'satisfied',
                    'work_life_balance' => 'neutral',
                    'career_advancement' => 'good',
                    'numilaw_preparation' => 'very_well_prepared',
                    'recommendation_score' => 8,
                    'favorite_course' => 'Criminal Law',
                    'most_valuable_skill' => 'Courtroom Advocacy',
                    'continuing_education' => 'Yes, judicial training programs',
                    'networking_importance' => 'important'
                ]),
                'additional_comments' => 'Public service is demanding but rewarding. NUMiLaw prepared me excellently for the challenges of criminal prosecution.',
                'additional_comments_km' => 'ការបម្រើសាធារណៈមានការតម្រូវច្រើនប៉ុន្តែផ្តល់ផលប្រយោជន៍។ NUMiLaw បានរៀបចំខ្ញុំយ៉ាងល្អប្រសើរសម្រាប់បញ្ហានៃការចោទប្រកាន់ឧក្រិដ្ឋ។',
                'response_date' => Carbon::parse('2024-11-18'),
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(3),
            ],
            [
                'alumni_id' => 1,
                'survey_type' => 'alumni_engagement',
                'responses' => json_encode([
                    'alumni_events_attended' => '3-5_per_year',
                    'networking_value' => 'very_valuable',
                    'newsletter_readership' => 'regularly',
                    'social_media_engagement' => 'linkedin_only',
                    'mentoring_interest' => 'very_interested',
                    'donation_willingness' => 'already_donating',
                    'reunion_attendance' => 'definitely',
                    'chapter_involvement' => 'not_available',
                    'suggestion_priority' => 'career_services',
                    'communication_preference' => 'email'
                ]),
                'additional_comments' => 'I value the alumni network and would like to be more involved in mentoring current students.',
                'additional_comments_km' => 'ខ្ញុំឱ្យតម្លៃបណ្តាញនិស្សិតចាស់ ហើយចង់ចូលរួមច្រើនក្នុងការណែនាំនិស្សិតបច្ចុប្បន្ន។',
                'response_date' => Carbon::parse('2024-10-05'),
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()->subMonths(4),
            ],
            [
                'alumni_id' => 3,
                'survey_type' => 'alumni_engagement',
                'responses' => json_encode([
                    'alumni_events_attended' => '1-2_per_year',
                    'networking_value' => 'valuable',
                    'newsletter_readership' => 'occasionally',
                    'social_media_engagement' => 'none',
                    'mentoring_interest' => 'somewhat_interested',
                    'donation_willingness' => 'maybe_future',
                    'reunion_attendance' => 'probably',
                    'chapter_involvement' => 'not_interested',
                    'suggestion_priority' => 'professional_development',
                    'communication_preference' => 'email'
                ]),
                'additional_comments' => 'Work schedule limits my participation but I appreciate the alumni efforts.',
                'additional_comments_km' => 'កាលវិភាគការងារកំណត់ការចូលរួមរបស់ខ្ញុំប៉ុន្តែខ្ញុំគោរពការខិតខំរបស់និស្សិតចាស់។',
                'response_date' => Carbon::parse('2024-10-12'),
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()->subMonths(4),
            ],
        ];

        foreach ($responses as $response) {
            AlumniSurveyResponse::create($response);
        }
    }
}