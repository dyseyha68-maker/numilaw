<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@university.edu',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '+855 23 456 789',
            'bio' => 'System administrator for university website.',
        ]);

        // Create faculty users
        $facultyUsers = [
            [
                'name' => 'Dr. John Smith',
                'email' => 'john.smith@university.edu',
                'role' => 'faculty',
                'phone' => '+855 23 456 789',
                'bio' => 'Distinguished legal scholar with over 20 years of experience in constitutional law and human rights. Previously served as Chief Justice of Supreme Court.',
                'bio_km' => 'ជំនាយស់នាំមនិវត់ែ',
                ],
            [
                'name' => 'Prof. Mary Johnson',
                'email' => 'mary.johnson@university.edu',
                'role' => 'faculty',
                'phone' => '+855 23 456 790',
                'bio' => 'Expert in international law and human rights. Published numerous articles on international legal frameworks and served as legal consultant to various government agencies.',
                'bio_km' => 'ជំនាយស់នាំមនិវត',
            ],
            [
                'name' => 'Dr. David Kim',
                'email' => 'david.kim@university.edu',
                'role' => 'faculty',
                'phone' => '+855 23 456 791',
                'bio' => 'Leading scholar in commercial law and corporate governance. Extensive experience in both academia and legal practice.',
                'bio_km' => 'ជំនាយស់នាំមនិវត់គ',
            ],
            [
                'name' => 'Prof. Sarah Williams',
                'email' => 'sarah.williams.faculty@university.edu',
                'role' => 'faculty',
                'phone' => '+855 23 456 790',
                'bio' => 'Specialist in legal research methodology and legal education technology innovation.',
                'bio_km' => 'ជំនាយស់នាំមនិវត់',
                ],
            [
                'name' => 'Prof. Emily Chen',
                'email' => 'emily.chen@university.edu',
                'role' => 'faculty',
                'phone' => '+855 23 456 790',
                'bio' => 'Professor of international business law with expertise in entrepreneurship and corporate governance.',
                'bio_km' => 'ជំនាយស់នាំមនិវត់',
                'avatar' => null,
            ],
            [
                'name' => 'Prof. Robert Davis',
                'email' => 'robert.davis@university.edu',
                'role' => 'faculty',
                'phone' => '+855 23 456 1234',
                'bio' => 'Professor of civil law with expertise in property law.',
                'bio_km' => 'ជំនាយស់នាំមនិវត់',
            ],
        ];

        // Create staff users
        $staffUsers = [
            [
                'name' => 'Sarah Williams',
                'email' => 'sarah.williams@university.edu',
                'role' => 'staff',
                'phone' => '+855 23 456 792',
                'bio' => 'Administrative assistant for Faculty of Law. Handles student inquiries and administrative tasks.',
                'bio_km' => 'ជំនាយស់នាំមនិវត',
                'avatar' => null,
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@university.edu',
                'role' => 'staff',
                'phone' => '+855 23 456 792',
                'bio' => 'Student services coordinator with excellent student engagement experience.',
                'bio_km' => 'ជំនាយស់នាំមនិវត់',
            ],
            [
                'name' => 'Jennifer Martinez',
                'email' => 'jennifer.martinez@university.edu',
                'role' => 'staff',
                'phone' => '+855 23 456 792',
                'bio' => 'Event coordinator with outstanding organizational and communication skills.',
                'bio_km' => 'ជំនាយស់នាំមនិវត់',
            ],
        ];

        // Create alumni users
        $alumniUsers = [
            [
                'name' => 'Sok Chanthorn',
                'email' => 'sok.chanthorn@alumni.numilaw.edu.kh',
                'role' => 'alumni',
                'phone' => '+85512887654',
                'bio' => 'Experienced legal practitioner specializing in corporate law and international arbitration.',
                'bio_km' => 'អ្នកអនុវត្តច្បាប់ដែលមានបទពិសោធន៍ច្រើនឆ្នាំ មានជំនាញខាងច្បាប់ក្រុមហ៊ុន និងអធិបតេយ្យភាពអន្តរជាតិ។',
            ],
            [
                'name' => 'Bopha Sreymom',
                'email' => 'bopha.sreymom@alumni.numilaw.edu.kh',
                'role' => 'alumni',
                'phone' => '+85513987654',
                'bio' => 'Dedicated human rights advocate focusing on women\'s rights and gender equality.',
                'bio_km' => 'អ្នកតស៊ូមតិសិទ្ធិមនុស្សដែលជំរុញការងារស្តីពីសិទ្ធិស្ត្រី និងសមភាពយេនឌ័រ។',
            ],
            [
                'name' => 'Kosal Meng',
                'email' => 'kosal.meng@alumni.numilaw.edu.kh',
                'role' => 'alumni',
                'phone' => '+85517765432',
                'bio' => 'Banking law expert with extensive experience in financial regulations and compliance.',
                'bio_km' => 'ជនជាតិច្បាប់ធនាគារដែលមានបទពិសោធន៍ច្រើនក្នុងការគ្រប់គ្រងហិរញ្ញវត្ថុនិងត្រួតពិនិត្យ។',
            ],
            [
                'name' => 'Sreyneang Pov',
                'email' => 'sreyneang.pov@alumni.numilaw.edu.kh',
                'role' => 'alumni',
                'phone' => '+85514987654',
                'bio' => 'Young legal professional specializing in tax law and investment regulations.',
                'bio_km' => 'អ្នកអនុវត្តច្បាប់ក្មេងដែលមានជំនាញខាងច្បាប់ពន្ធ និងបទបញ្ជាការវិនិយោគ។',
            ],
            [
                'name' => 'Daravuth Hem',
                'email' => 'daravuth.hem@alumni.numilaw.edu.kh',
                'role' => 'alumni',
                'phone' => '+85516654321',
                'bio' => 'Dedicated prosecutor working on criminal cases and ensuring justice is served.',
                'bio_km' => 'ចៅក្រមដែលជំរុញការងារផ្នែកបទឧក្រិដ្ឋ និងធានាឲ្យយុត្តិធម៌ត្រូវបានអនុវត្ត។',
            ],
        ];

        // Insert all users
        $allUsers = array_merge($facultyUsers, $staffUsers, $alumniUsers);

        foreach ($allUsers as $user) {
            User::create(array_merge($user, ['password' => Hash::make('password')]));
        }
    }
}