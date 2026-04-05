<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutSection;
use App\Models\Leadership;

class LeadershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leadership = [
            [
                'name' => 'Dr. John Smith',
                'position' => 'Dean',
                'bio_en' => 'Distinguished legal scholar with over 20 years of experience in constitutional law and human rights. Previously served as Chief Justice of Supreme Court.',
                'bio_km' => 'ជំនាងយស់នាំមនះ',
                'photo' => null,
                'email' => 'john.smith@university.edu',
                'phone' => '+855 23 456 789',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Prof. Mary Johnson',
                'position' => 'Associate Dean',
                'bio_en' => 'Expert in international law and human rights. Published numerous articles on international legal frameworks and served as legal consultant to various government agencies.',
                'bio_km' => 'ជំនាងយស់នាំមនះ',
                'photo' => null,
                'email' => 'mary.johnson@university.edu',
                'phone' => '+855 23 456 790',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. David Kim',
                'position' => 'Department Head',
                'bio_en' => 'Leading scholar in commercial law and corporate governance. Extensive experience in both academia and legal practice.',
                'bio_km' => 'ជំនាយស់នាំមនះ',
                'photo' => null,
                'email' => 'david.kim@university.edu',
                'phone' => '+855 23 456 791',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Prof. Sarah Williams',
                'position' => 'Assistant Dean',
                'bio_en' => 'Specialist in legal research methodology and legal education technology innovation.',
                'bio_km' => 'ជំនាយស់នាំមនះ',
                'photo' => null,
                'email' => 'sarah.williams@university.edu',
                'phone' => '+855 23 456 792',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($leadership as $data) {
            Leadership::create($data);
        }
    }
}