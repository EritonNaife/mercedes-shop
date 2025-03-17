<?php
require_once __DIR__ . '/../templates/common.tpl.php';
require_once __DIR__ . '/../templates/authentication.tpl.php';
require_once __DIR__ . '/../utils/session.php';
require_once __DIR__ . '/../database/users.class.php';



$session = new Session();

// Redirect if already logged in
if ($session->isLoggedIn()) {
    header('Location: /index.php');
    exit();
}

// Draw page
echo drawHeader("Create Account | Mercedes Shop");

// Draw account container with registration form
echo drawAccountContainer(
    "Create Account",
    "Join Mercedes Shop for exclusive offers and easy checkout",
    drawRegisterForm($session->get('error'),$session->get('success'))
);
$session->clear('error'); // Clear messages after displaying
$session->clear('success');
echo drawFooter();
?>