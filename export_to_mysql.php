<?php
/**
 * Export SQLite to MySQL
 * Run: php export_to_mysql.php
 */

$sqliteFile = __DIR__ . '/database/database.sqlite';
$mysqlHost = 'localhost';
$mysqlDb = 'ilawnum_numilaw';
$mysqlUser = 'ilawnum_numilaw';
$mysqlPass = 'YOUR_PASSWORD_HERE';

try {
    // Connect to SQLite
    $sqlite = new PDO("sqlite:$sqliteFile");
    $sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Connect to MySQL
    $mysql = new PDO("mysql:host=$mysqlHost;dbname=$mysqlDb", $mysqlUser, $mysqlPass);
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Disable foreign keys
    $mysql->exec("SET FOREIGN_KEY_CHECKS=0");
    
    // Get all tables
    $tables = $sqlite->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name")->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Found " . count($tables) . " tables\n\n";
    
    foreach ($tables as $table) {
        echo "Processing: $table ... ";
        
        try {
            // Drop table if exists
            $mysql->exec("DROP TABLE IF EXISTS `$table`");
            
            // Get CREATE TABLE statement
            $createStmt = $sqlite->query("SELECT sql FROM sqlite_master WHERE type='table' AND name='$table'")->fetchColumn();
            
            // Convert SQLite to MySQL
            $createStmt = preg_replace('/"([^"]+)"/', '`$1`', $createStmt);
            $createStmt = preg_replace('/\bINTEGER\b/i', 'BIGINT', $createStmt);
            $createStmt = preg_replace('/\bINT\b/i', 'BIGINT', $createStmt);
            $createStmt = preg_replace('/\bAUTOINCREMENT\b/i', 'AUTO_INCREMENT', $createStmt);
            $createStmt = preg_replace('/\bTEXT\b/i', 'TEXT', $createStmt);
            $createStmt = preg_replace('/\bVARCHAR\b(?!\s*\()/', 'VARCHAR(255)', $createStmt);
            $createStmt = preg_replace('/\bREAL\b/i', 'DOUBLE', $createStmt);
            $createStmt = preg_replace('/\bBLOB\b/i', 'LONGBLOB', $createStmt);
            $createStmt = preg_replace('/CHECK\s*\([^)]+\)/i', '', $createStmt);
            $createStmt = preg_replace('/,\s*\)/', ')', $createStmt);
            
            if (strpos($createStmt, 'ENGINE') === false) {
                $createStmt = rtrim($createStmt, ';');
                $createStmt .= ' ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;';
            }
            
            $mysql->exec($createStmt);
            
            // Insert data
            $rows = $sqlite->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);
            
            if (!empty($rows)) {
                $columns = array_keys($rows[0]);
                $cols = '`' . implode('`, `', $columns) . '`';
                
                foreach ($rows as $row) {
                    $values = [];
                    foreach ($row as $value) {
                        if ($value === null) {
                            $values[] = 'NULL';
                        } elseif (is_numeric($value) && $value !== '') {
                            $values[] = $value;
                        } else {
                            $values[] = "'" . addslashes($value) . "'";
                        }
                    }
                    $mysql->exec("INSERT INTO `$table` ($cols) VALUES (" . implode(', ', $values) . ")");
                }
                echo count($rows) . " rows\n";
            } else {
                echo "OK (0 rows)\n";
            }
            
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
        }
    }
    
    $mysql->exec("SET FOREIGN_KEY_CHECKS=1");
    
    echo "\n✅ Export complete!\n";
    echo "Now test your site at: https://ilaw.num.edu.kh/laravel/public/\n";
    
} catch (PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}
