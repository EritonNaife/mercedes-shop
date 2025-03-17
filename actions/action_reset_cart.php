<?php
session_start();

// Clear all session data
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect back to the previous page
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>