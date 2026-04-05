<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminUserSeeder::class,
            AcademicProgramSeeder::class,
            AcademicCalendarSeeder::class,
            FacultySeeder::class,
            EventSeeder::class,
            AlumniSeeder::class,
            AlumniTestimonialSeeder::class,
            AlumniEventSeeder::class,
            JobPostingSeeder::class,
            AlumniConnectionSeeder::class,
            AlumniDonationSeeder::class,
            AlumniSurveyResponseSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            ArticleSeeder::class,
            ProjectSeeder::class,
            AboutSectionSeeder::class,
            LeadershipSeeder::class,
            ApplicationSeeder::class,
            MootProgramSeeder::class,
            PartnerUniversitySeeder::class,
        ]);
    }
}