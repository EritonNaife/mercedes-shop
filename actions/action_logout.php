<?php
// Logs out the current user and clears session data

require_once __DIR__ . '/../utils/session.php';
require_once __DIR__ . '/../database/users.class.php';

$session = new Session();

// Terminates session and redirects to homepage
$session->logout();

header('Location: /pages/index.php');
exit();
?>