<?php
/**
 * Simple Table Creator - Run this once
 */

$host = 'localhost';
$db   = 'ilawnum_numilaw';
$user = 'ilawnum_numilaw';
$pass = 'YOUR_PASSWORD_HERE';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$sql = file_get_contents(__DIR__ . '/database.sql');

$statements = array_filter(array_map('trim', explode(';', $sql)));

foreach ($statements as $statement) {
    if (empty($statement)) continue;
    try {
        $pdo->exec($statement);
        echo "Executed: " . substr($statement, 0, 50) . "...\n";
    } catch (\PDOException $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}

echo "\nDone!\n";
