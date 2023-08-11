<?php
$allowed_origins = array('https://elifesaver.online','http://localhost:80', 'https://b4e1-102-244-155-206.ngrok.io');

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
include('../classes/donor.class.php');

$conn = Database::getInstance()->getConn();

// Register a new donor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $response = array('success' => false, 'error' => 'Password and confirm password do not match');
    } else {
        
        include_once('../config/bts_number.config.php');
        $registration_token = bin2hex(random_bytes(32));
        $donor = new Donor($_POST['name'], $_POST['gender'], $_POST['email'], $_POST['password'], $_POST['phone'], $_POST['address'], $_POST['city'], $_POST['blood_group'], $registration_token, $bts_number);
        $register_result = $donor->registerDonor();
        
        
        if ($register_result) {
            
            // Update the last login time for the donor
            $donor->last_login = date('Y-m-d H:i:s');
            $stmt = $conn->prepare("UPDATE donors SET last_login = ? WHERE id = ?");
            $stmt->bind_param("si", $donor->last_login, $donor->id);
            $stmt->execute();
            
            $stmt->close();
            $conn->close();
        
            $response = array('success' => true, 'type' => 'donor', 'user' => $donor);
        } else if ($register_result === -1) {
            $response = array('success' => false, 'error' => 'Email already exists');
        } else if(!$register_result) {
            $response = array('success' => false, 'error' => 'Some error occured. Try again!!');
        }
    }

    // Encode the response as a JSON string and remove any unwanted characters
    $json_response = json_encode($response);
    $json_response = trim($json_response);

    // Set the content type header and output the JSON response
    header('Content-Type: application/json');
    echo $json_response;
}