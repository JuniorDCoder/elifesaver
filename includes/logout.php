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

// Get the current URL
$current_url = $_SERVER['HTTP_REFERER'];

// Check if the logout is pressed from the administrator folder
if (strpos($current_url, '/administrator/') !== false) {
    // Redirect to the index.php in the same folder
    header('Location: ../administrator/index.php');
} else {
    // Redirect to the index.php one directory out of the view folder
    header('Location: ../index.php');
}

exit();
?>