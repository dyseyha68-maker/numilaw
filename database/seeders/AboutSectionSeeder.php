<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutSection;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'title_en' => 'University History',
                'title_km' => 'ប្ររប្រងសវិវត៌នានិវតមានំមមន',
                'content_en' => 'Founded in 1995, our Faculty of Law has been a leading institution in legal education for over 25 years, preparing future legal professionals.',
                'content_km' => 'ប្ររប្រងសវិវត៌នានិវតមានំមមនិវត',
                'type' => 'overview',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title_en' => 'Our Mission',
                'title_km' => 'ជំនាងយស់នា',
                'content_en' => 'To provide excellence in legal education through innovative teaching, cutting-edge research, and service to society, while upholding the highest standards of legal ethics and professional conduct.',
                'content_km' => 'ដើយផ្អនឱ្អប្បស់វិចថ្ធនាប់គ្នះវតនឡមំមនះនា',
                'type' => 'mission',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title_en' => 'Our Vision',
                'title_km' => 'ជំនាយស់នា',
                'content_en' => 'To be recognized as a center of legal excellence, producing graduates who are not only knowledgeable in law but also equipped with practical skills and ethical values necessary to become leaders in the legal profession.',
                'content_km' => 'ដើយផ្អនឱ្អប្បស់វិចថ្ធនាប់គ្នះវតនឡមំមនះនា',
                'type' => 'vision',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            AboutSection::create($section);
        }
    }
}
