<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Create alumni users
use App\Models\User;
use Illuminate\Support\Facades\Hash;

$alumniUsers = [
    [
        'name' => 'Sok Chanthorn',
        'email' => 'sok.chanthorn@alumni.numilaw.edu.kh',
        'password' => Hash::make('password'),
        'role' => 'alumni',
        'phone' => '+85512887654',
        'bio' => 'Experienced legal practitioner specializing in corporate law and international arbitration.',
        'bio_km' => 'អ្នកអនុវត្តច្បាប់ដែលមានបទពិសោធន៍ច្រើនឆ្នាំ មានជំនាញខាងច្បាប់ក្រុមហ៊ុន និងអធិបតេយ្យភាពអន្តរជាតិ។',
    ],
    [
        'name' => 'Bopha Sreymom',
        'email' => 'bopha.sreymom@alumni.numilaw.edu.kh',
        'password' => Hash::make('password'),
        'role' => 'alumni',
        'phone' => '+85513987654',
        'bio' => 'Dedicated human rights advocate focusing on women\'s rights and gender equality.',
        'bio_km' => 'អ្នកតស៊ូមតិសិទ្ធិមនុស្សដែលជំរុញការងារស្តីពីសិទ្ធិស្ត្រី និងសមភាពយេនឌ័រ។',
    ],
    [
        'name' => 'Kosal Meng',
        'email' => 'kosal.meng@alumni.numilaw.edu.kh',
        'password' => Hash::make('password'),
        'role' => 'alumni',
        'phone' => '+85517765432',
        'bio' => 'Banking law expert with extensive experience in financial regulations and compliance.',
        'bio_km' => 'ជនជាតិច្បាប់ធនាគារដែលមានបទពិសោធន៍ច្រើនក្នុងការគ្រប់គ្រងហិរញ្ញវត្ថុនិងត្រួតពិនិត្យ។',
    ],
    [
        'name' => 'Sreyneang Pov',
        'email' => 'sreyneang.pov@alumni.numilaw.edu.kh',
        'password' => Hash::make('password'),
        'role' => 'alumni',
        'phone' => '+85514987654',
        'bio' => 'Young legal professional specializing in tax law and investment regulations.',
        'bio_km' => 'អ្នកអនុវត្តច្បាប់ក្មេងដែលមានជំនាញខាងច្បាប់ពន្ធ និងបទបញ្ជាការវិនិយោគ។',
    ],
    [
        'name' => 'Daravuth Hem',
        'email' => 'daravuth.hem@alumni.numilaw.edu.kh',
        'password' => Hash::make('password'),
        'role' => 'alumni',
        'phone' => '+85516654321',
        'bio' => 'Dedicated prosecutor working on criminal cases and ensuring justice is served.',
        'bio_km' => 'ចៅក្រមដែលជំរុញការងារផ្នែកបទឧក្រិដ្ឋ និងធានាឲ្យយុត្តិធម៌ត្រូវបានអនុវត្ត។',
    ],
];

foreach ($alumniUsers as $user) {
    User::create($user);
    echo "Created user: " . $user['name'] . "\n";
}

echo "\nAlumni users created successfully!\n";