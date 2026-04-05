<?php
/**
 * Generate SQL for tables 11-20
 */

$sqliteFile = __DIR__ . '/database/database.sqlite';
$outputFile = __DIR__ . '/database/part2.sql';

$sqlite = new PDO("sqlite:$sqliteFile");
$sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$tables = $sqlite->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name")->fetchAll(PDO::FETCH_COLUMN);
$tables = array_slice($tables, 10, 10);

$sql = "SET FOREIGN_KEY_CHECKS=0;\n\n";

foreach ($tables as $table) {
    echo "Processing: $table\n";
    
    $info = $sqlite->query("PRAGMA table_info($table)")->fetchAll(PDO::FETCH_ASSOC);
    
    $cols = [];
    $useAutoIncrement = !in_array($table, ['cache', 'sessions', 'password_reset_tokens']);
    
    foreach ($info as $col) {
        $name = $col['name'];
        $type = strtoupper($col['type']);
        $colName = "`$name`";
        
        if (strpos($type, 'INT') !== false) $mysqlType = 'BIGINT';
        elseif (strpos($type, 'TEXT') !== false) $mysqlType = 'TEXT';
        elseif (strpos($type, 'REAL') !== false) $mysqlType = 'DOUBLE';
        elseif (strpos($type, 'BLOB') !== false) $mysqlType = 'LONGBLOB';
        else $mysqlType = 'VARCHAR(255)';
        
        $notNull = $col['notnull'] ? 'NOT NULL' : 'NULL';
        
        if ($col['pk'] && $useAutoIncrement) {
            $cols[] = "$colName $mysqlType NOT NULL AUTO_INCREMENT PRIMARY KEY";
        } elseif ($col['pk']) {
            $cols[] = "$colName $mysqlType NOT NULL PRIMARY KEY";
        } else {
            $cols[] = "$colName $mysqlType $notNull";
        }
    }
    
    $sql .= "DROP TABLE IF EXISTS `$table`;\n";
    $sql .= "CREATE TABLE `$table` (" . implode(', ', $cols) . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;\n\n";
    
    $rows = $sqlite->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($rows)) {
        $colNames = array_keys($rows[0]);
        $colStr = '`' . implode('`, `', $colNames) . '`';
        
        foreach ($rows as $row) {
            $vals = [];
            foreach ($row as $v) {
                if ($v === null) $vals[] = 'NULL';
                elseif (is_numeric($v)) $vals[] = $v;
                else $vals[] = "'" . addslashes($v) . "'";
            }
            $sql .= "INSERT INTO `$table` ($colStr) VALUES (" . implode(', ', $vals) . ");\n";
        }
        $sql .= "\n";
    }
}

$sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

file_put_contents($outputFile, $sql);
echo "\n✅ Done! File: $outputFile\n";
