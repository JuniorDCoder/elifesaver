<?php
// Login a donor
include('../classes/patient.class.php');
include('../classes/donor.class.php');
$conn = Database::getInstance()->getConn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set the allowed origins for CORS
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

    $donor = Donor::loginDonor($_POST['email'], $_POST['password']);
    if ($donor) {
        //Start a session
        session_start();

        $donor->last_login = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE donors SET last_login = ? WHERE id = ?");
        $stmt->bind_param("si", $donor->last_login, $donor->id);
        $stmt->execute();

        $_SESSION['donor'] = ['id' => $donor->id, 'type' => "donor"];
        $donor_id = $_SESSION['donor']['id'];
        $response = array('success' => true, 'donor_id' => $donor_id);
    } 
    else if($donor===0){
        $response = array('success' => false, 'error' => "Wrong Password");
    }
    else {
        $response = array('success' => false, 'error' => "Invalid email or password");
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}