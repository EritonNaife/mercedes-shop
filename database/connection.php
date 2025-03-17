<?php
  declare(strict_types = 1);
  
function getDatabaseConnection() {
    static $db = null;
    
    if ($db === null) {
        try {
            $db = new SQLite3(__DIR__ . '/database.db');
            $db->enableExceptions(true);
        } catch (Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    return $db;
}
?>