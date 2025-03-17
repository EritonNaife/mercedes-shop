<?php
require_once __DIR__ . '/../templates/common.tpl.php';
require_once __DIR__ . '/../templates/authentication.tpl.php';
require_once __DIR__ . '/../utils/session.php';
require_once __DIR__ . '/../database/users.class.php';

$session = new Session();

// Redirect if already logged in
if ($session->isLoggedIn()) {
    header('Location: /pages/index.php');
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $userDB->login($email, $password);
    if ($user) {
        $session->login($user['id']);
        header('Location: /index.php');
        exit();
    } else {
        $session->set('error', 'Invalid email or password.');
    }
}


// Draw page
echo drawHeader("Login | Mercedes Shop");

// Draw account container with login form
echo drawAccountContainer(
    "Sign In",
    "Welcome back! Sign in to access your account",
    drawLoginForm($session->get('error'))
);

$session->clear('error'); // Clear error message after displaying
echo drawFooter();
?>