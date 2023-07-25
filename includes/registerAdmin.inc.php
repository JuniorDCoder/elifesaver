<?php
$allowed_origins = array('https://elifesaver.online/','http://localhost:8080', 'https://2721-102-244-155-9.ngrok-free.app');

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

include('../classes/patient.class.php');
include('../classes/admin.class.php');
$conn = Database::getInstance()->getConn();

// Register a new admin
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $admin = new Admin($_POST['name'], $_POST['email'], $_POST['password']);
        $register_result = $admin->registerAdmin();

        // Update the last login time for the admin
        $admin->last_login = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE admins SET last_login = ? WHERE id = ?");
        $stmt->bind_param("si", $admin->last_login, $admin->id);
        $stmt->execute();

        if ($register_result === -1) {
            $response = array('success' => false, 'error' => 'Email already exists');
        } else if(!$register_result) {
            $response = array('success' => false);
        }else if ($register_result) {
            $response = array('success' => true, 'type' => 'admin', 'admin' => $admin);
        } 
    }

    // Encode the response as a JSON string and remove any unwanted characters
    $json_response = json_encode($response);
    $json_response = trim($json_response);

    // Set the content type header and output the JSON response
    header('Content-Type: application/json');
    echo $json_response;