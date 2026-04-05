<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Clean up existing alumni data
use App\Models\Alumni;

echo "Cleaning up existing alumni records...\n";
Alumni::truncate();
echo "Alumni table cleared.\n";

// Also clean up related tables
echo "Cleaning up related tables...\n";

$relatedTables = [
    'App\Models\AlumniTestimonial',
    'App\Models\AlumniEvent', 
    'App\Models\JobPosting',
    'App\Models\AlumniConnection',
    'App\Models\AlumniDonation',
    'App\Models\AlumniSurveyResponse'
];

foreach ($relatedTables as $model) {
    $model::truncate();
    echo "Cleared " . class_basename($model) . " table.\n";
}

echo "\nAll alumni-related tables cleared. Ready for fresh seeding.\n";