<?php
// Handles user registration form submission, creates a new user in the database
require_once __DIR__ . '/../utils/session.php';
require_once __DIR__ . '/../database/users.class.php';

$session = new Session();
$userDB = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extracts form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $session->set('error', 'Invalid email format.');
        header('Location: /pages/register.php');
        exit();
    }
    
    if (strlen($password) < 8) {
        $session->set('error', 'Password must be at least 8 characters.');
        header('Location: /pages/register.php');
        exit();
    }
    
    // Validates that passwords match
    if ($password !== $confirmPassword) {
        $session->set('error', 'Passwords do not match.');
        header('Location: /pages/register.php');
        exit();
    }
    
    // Attempts to create a new user with hashed password
    if ($userDB->createUser($email, $password)) {
        
        $session->set('success', 'Registration successful! Please log in.');
        header('Location: /pages/login.php');
        exit();
    } else {
        $session->set('error', 'Registration failed. Please try again.');
        header('Location: /pages/register.php');
        exit();
    }
}
?>