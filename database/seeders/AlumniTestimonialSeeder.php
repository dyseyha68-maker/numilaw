<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlumniTestimonial;
use Carbon\Carbon;

class AlumniTestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'alumni_id' => 11,
                'title' => 'NUMiLaw Provided the Foundation for My Legal Career',
                'title_km' => 'NUMiLaw បានផ្តល់គ្រឹះសម្រាប់អាជីពច្បាប់របស់ខ្ញុំ',
                'content' => 'The rigorous academic training and practical experience I gained at NUMiLaw prepared me exceptionally well for the challenges of corporate law practice. The faculty\'s mentorship and the moot court competitions were instrumental in shaping my legal career.',
                'content_km' => 'ការបណ្តុះបណ្តាលសិក្សាដ៏តឹងរ៉ឹង និងបទពិសោធន៍ជាក់ស្តែងដែលខ្ញុំបានទទួលនៅ NUMiLaw បានរៀបចំខ្ញុំឱ្យល្អប្រសើរសម្រាប់បទប្រយោគនៃការអនុវត្តច្បាប់ក្រុមហ៊ុន។ ការណែនាំរបស់នាយកដ្ឋាន និងការប្រកួត Moot Court មានតួនាទីសំខាន់ក្នុងការបង្កើតអាជីពច្បាប់របស់ខ្ញុំ។',
                'category' => 'career_success',
                'is_featured' => true,
                'is_approved' => true,
                'display_order' => 1,
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(3),
            ],
            [
                'alumni_id' => 12,
                'title' => 'Championing Human Rights Through NUMiLaw Education',
                'title_km' => 'ជើងឯកសិទ្ធិមនុស្សតាមរយៈអប់រំ NUMiLaw',
                'content' => 'NUMiLaw not only gave me the legal knowledge but also instilled in me a sense of social responsibility. The human rights clinic and legal aid programs were transformative experiences that shaped my commitment to public interest law.',
                'content_km' => 'NUMiLaw មិនត្រឹមតែផ្តល់ចំណេះដឹងផ្លូវច្បាប់ដល់ខ្ញុំប៉ុណ្ណោះទេ ប៉ុន្តែថែមទាំងបង្កើតបាននូវអារម្មណ៍នៃការទទួលខុសត្រូវសង្គមផងដែរ។ គម្រោងសិទ្ធិមនុស្ស និងកម្មវិធីជំនួយផ្លូវច្បាប់គឺជាបទពិសោធន៍ផ្លាស់ប្តូរដែលបានបង្កើតការប្តេជ្ញាចិត្តរបស់ខ្ញុំចំពោះច្បាប់ផលប្រយោជន៍សាធារណៈ។',
                'category' => 'social_impact',
                'is_featured' => true,
                'is_approved' => true,
                'display_order' => 2,
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()->subMonths(4),
            ],
            [
                'alumni_id' => 13,
                'title' => 'Excellence in Banking Law Through NUMiLaw Training',
                'title_km' => 'ភាពល្អប្រសើរក្នុងច្បាប់ធនាគារតាមរយៈការបណ្តុះបណ្តាល NUMiLaw',
                'content' => 'The specialized banking and finance law courses at NUMiLaw gave me a competitive edge in the financial sector. The internship opportunities and industry connections I made during my studies were invaluable for my career advancement.',
                'content_km' => 'វគ្គសិក្សាផ្នែកច្បាប់ធនាគារ និងហិរញ្ញវត្ថុជំនាញនៅ NUMiLaw បានផ្តល់ឱ្យខ្ញុំនូវគុណសម្បត្តិប្រកួតប្រជែងនៅក្នុងវិស័យហិរញ្ញវត្ថុ។ ឱកាសអនុវត្តការងារ និងការតភ្ជាប់ឧស្សាហកម្មដែលខ្ញុំបានធ្វើក្នុងអំឡុងពេលសិក្សាគឺមានតម្លៃមិនអាចវាស់បានសម្រាប់ការរីកចម្រើនអាជីពរបស់ខ្ញុំ។',
                'category' => 'career_success',
                'is_featured' => false,
                'is_approved' => true,
                'display_order' => 3,
                'created_at' => Carbon::now()->subMonths(5),
                'updated_at' => Carbon::now()->subMonths(5),
            ],
            [
                'alumni_id' => 14,
                'title' => 'Starting My Legal Journey with Confidence',
                'title_km' => 'ចាប់ផ្តើមដំណើរច្បាប់របស់ខ្ញុំដោយទំនុកចិត្ត',
                'content' => 'As a recent graduate, I felt well-prepared to enter the legal profession thanks to NUMiLaw\'s comprehensive curriculum and practical training. The career services office was incredibly supportive in helping me secure my first position.',
                'content_km' => 'ជានិស្សិតថ្មីចេញពីសាលា ខ្ញុំមានអារម្មណ៍ថាត្រៀមខ្លួនល្អក្នុងការចូលបុគ្គលិកច្បាប់ដោយសារតែកម្មវិធីសិក្សាទូលំទូលាយ និងការបណ្តុះបណ្តាលជាក់ស្តែងរបស់ NUMiLaw។ ការិយាល័យសេវាកម្មអាជីពបានគាំទ្រយ៉ាងខ្លាំងក្នុងការជួយខ្ញុំឱ្យបានតួនាទីដំបូង។',
                'category' => 'recent_graduate',
                'is_featured' => false,
                'is_approved' => true,
                'display_order' => 4,
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()->subMonths(2),
            ],
            [
                'alumni_id' => 15,
                'title' => 'Serving Justice Through NUMiLaw Education',
                'title_km' => 'បម្រើយុត្តិធម៌តាមរយៈការអប់រំ NUMiLaw',
                'content' => 'NUMiLaw\'s emphasis on criminal law and procedural justice prepared me for the demanding role of a prosecutor. The mock trials and legal writing skills I developed are essential tools I use every day.',
                'content_km' => 'ការផ្តល់អាទិភាពដល់ច្បាប់ឧក្រិដ្ឋ និងយុត្តិធម៌នីតិវិធីរបស់ NUMiLaw បានរៀបចំខ្ញុំឱ្យល្អសម្រាប់តួនាទីដ៏ត្រូវការរបស់ចៅក្រម។ ការប្រកួតប្រជែងក្លែងក្លាយ និងជំនាញការនិពន្ធច្បាប់ដែលខ្ញុំបានអភិវឌ្ឍគឺជាឧបករណ៍ចាំបាច់ដែលខ្ញុំប្រើប្រាស់រាល់ថ្ងៃ។',
                'category' => 'public_service',
                'is_featured' => false,
                'is_approved' => true,
                'display_order' => 5,
                'created_at' => Carbon::now()->subMonths(6),
                'updated_at' => Carbon::now()->subMonths(6),
            ],
        ];

        foreach ($testimonials as $testimonial) {
            AlumniTestimonial::create($testimonial);
        }
    }
}