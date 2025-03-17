<?php

require_once __DIR__ . '/connection.php';

class User {
    private $db;

    public function __construct() {
        $this->db = getDatabaseConnection();
    }

    // Create a new user
    public function createUser($email, $password) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();
        if ($result->fetchArray()) {
            return 'Email already exists.';
        }
        $stmt = $this->db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);
        $stmt->execute();
        return true;
    }

    // Authenticate a user
    public function login($email, $password) {
        $stmt = $this->db->prepare("
            SELECT * FROM users 
            WHERE email = :email
        ");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data on success
        }
        return false; // Return false on failure
    }
    
    // Get user by ID
    public function getUserById($userId) {
        $stmt = $this->db->prepare("
            SELECT * FROM users 
            WHERE id = :id
        ");
        $stmt->bindValue(':id', $userId, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }
}
?>