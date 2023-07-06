<?php
$allowed_origins = array('http://localhost:8080', 'https://eed3-41-202-207-144.ngrok-free.app');

// Get the origin header from the request
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

// Check if the origin is allowed
if (in_array($origin, $allowed_origins)) {
    // Set the CORS headers
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Cache-Control: no-cache, no-store, must-revalidate');
} 

include('../classes/user.class.php');

// Register a new user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($_POST['name'], $_POST['email'], $_POST['password'], $_POST['phone_number'], $_POST['address'], $_POST['user_type']);
    $register_result = $user->register();
    if ($register_result) {
        $response = array('success' => true, 'user' => $user);
    } else if ($register_result === 0) {
        $response = array('success' => 'username exist');
    } else if ($register_result === -1) {
        $response = array('success' => 'email exist');
    } else {
        $response = array('success' => false);
    }

    // Encode the response as a JSON string and return it
    $json_response = json_encode($response);
    header('Content-Type: application/json');
    echo $json_response;
}