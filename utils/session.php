<?php
class Session {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Check if user is logged in
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Log in a user
    public function login($userId) {
        $_SESSION['user_id'] = $userId;
    }

    // Log out a user
    public function logout() {
        session_unset();
        session_destroy();
    }

    // Get current user ID
    public function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }

    // Set session data (e.g., for messages)
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    // Get session data
    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    // Clear session data
    public function clear($key) {
        unset($_SESSION[$key]);
    }
}
?>