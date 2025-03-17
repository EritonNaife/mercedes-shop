<?php
declare(strict_types = 1);

function getDatabaseConnection() {
    static $db = null;
    
    if ($db === null) {
        try {
            // Use Render's persistent disk path
            $dbPath = '/opt/render/project/src/database.db';
            $db = new SQLite3($dbPath);
            $db->enableExceptions(true);
            // Ensure foreign keys are enabled (if your schema uses them)
            $db->exec("PRAGMA foreign_keys = ON;");
        } catch (Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    return $db;
}
?>