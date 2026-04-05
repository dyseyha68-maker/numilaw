<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = \App\Models\User::all(['id', 'name', 'email', 'role']);

echo "Existing Users:\n";
echo "ID\tName\t\t\tEmail\t\t\t\t\tRole\n";
echo "--------------------------------------------------------\n";

foreach ($users as $user) {
    echo $user->id . "\t" . substr($user->name, 0, 20) . "\t\t" . substr($user->email, 0, 30) . "\t\t" . $user->role . "\n";
}