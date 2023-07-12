<!-- logout.php file -->
<?php
session_start();
// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Clear the session variables from localStorage
echo '<script>localStorage.clear();</script>';

// Redirect the user to the login page
header('Location: ../');
exit();