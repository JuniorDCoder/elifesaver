<?php
// Start the session
session_start();

// Unset all the session variables
session_unset();

// Destroy the session
session_destroy();

// Unset all the cookies by setting their expiration to the past
setcookie('type', '', time() - 3600, '/');
setcookie('name', '', time() - 3600, '/');
setcookie('email', '', time() - 3600, '/');

// Redirect the user to the login page
header('Location: ../');
exit();
?>