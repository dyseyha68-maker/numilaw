<?php

// Simple test to check Alumni model
require_once 'vendor/autoload.php';

try {
    $app = require_once 'bootstrap/app.php';
    
    // Check if Alumni model can be instantiated
    $alumniCount = \App\Models\Alumni::count();
    echo "Alumni model loaded successfully. Total records: {$alumniCount}\n";
    
    // Check if the table name is correct
    $table = (new \App\Models\Alumni)->getTable();
    echo "Table name: {$table}\n";
    
    // Test the scopes
    $approvedAlumni = \App\Models\Alumni::approved()->count();
    echo "Approved alumni count: {$approvedAlumni}\n";
    
    $contactConsentAlumni = \App\Models\Alumni::approved()->withContactConsent()->count();
    echo "Approved alumni with contact consent: {$contactConsentAlumni}\n";
    
    echo "✅ Alumni model working correctly!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}