<?php
$allowed_origins = array('http://localhost:8080', 'https://5dac-102-244-155-116.ngrok-free.app');

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
/* 
include('../classes/donor.class.php');
include('../classes/patient.class.php');
*/
include('../config/autoload.config.php');
// Register a new donor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $response = array('success' => false, 'error' => 'Password and confirm password do not match');
    } else {
        include_once('../config/bts_number.config.php');
        $donor = new Donor($_POST['name'], $_POST['gender'], $_POST['email'], $_POST['password'], $_POST['phone'], $_POST['address'], $_POST['city'], $_POST['blood_group'], $bts_number);
        $register_result = $donor->registerDonor();
        if ($register_result === -1) {
            $response = array('success' => false, 'error' => 'Email already exists');
        } else if(!$register_result) {
            $response = array('success' => false);
        }else if ($register_result) {
            session_start();
            $_SESSION['donor'] = ['id' => $donor->id, 'name' => $donor->donor_name , 'email' => $donor->email];
            $response = array('success' => true, 'donor' => $donor);
        } 
    }

    // Encode the response as a JSON string and remove any unwanted characters
    $json_response = json_encode($response);
    $json_response = trim($json_response);

    // Set the content type header and output the JSON response
    header('Content-Type: application/json');
    echo $json_response;
}