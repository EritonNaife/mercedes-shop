<?php
// Processes login form submission and authenticates user credentials
require_once __DIR__ . '/../utils/session.php';
require_once __DIR__ . '/../database/users.class.php';

$session = new Session();
$userDB = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieves email and password from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verifies user credentials against database
    $user = $userDB->login($email, $password);
    if ($user) {
        $session->login($user['id']);
        header('Location: /pages/index.php');
        exit();
    } else {
        // Failure: Redirects back with error message
        $session->set('error', 'Invalid email or password.');
        header('Location: /pages/login.php');
        exit();
    }
}


?>