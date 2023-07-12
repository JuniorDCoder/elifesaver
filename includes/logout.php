<?php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy session data on the server
session_destroy();

// Remove session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to the index page
header('Location: ../index.php');
exit();
?>