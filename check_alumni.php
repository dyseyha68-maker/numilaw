<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Check current alumni data
use App\Models\Alumni;
use App\Models\User;

echo "Current Alumni Records:\n";
echo "ID\tUser ID\tStudent ID\tName\n";
echo "---------------------------------\n";

$alumni = Alumni::all();
foreach ($alumni as $alum) {
    $user = User::find($alum->user_id);
    echo $alum->id . "\t" . $alum->user_id . "\t" . $alum->student_id . "\t" . ($user ? $user->name : 'Unknown') . "\n";
}

echo "\nChecking for potential conflicts...\n";
$userIds = [12, 13, 14, 15, 16];
foreach ($userIds as $userId) {
    $existing = Alumni::where('user_id', $userId)->first();
    if ($existing) {
        echo "Found existing alumni record for user_id: " . $userId . " (ID: " . $existing->id . ")\n";
    }
}

echo "\nUsers table check:\n";
echo "ID\tName\t\t\tEmail\t\t\t\tRole\n";
echo "--------------------------------------------------------\n";

$users = User::whereIn('id', [11, 12, 13, 14, 15, 16])->get();
foreach ($users as $user) {
    echo $user->id . "\t" . substr($user->name, 0, 20) . "\t\t" . substr($user->email, 0, 30) . "\t\t" . $user->role . "\n";
}