<?php

// Login a User
include('../classes/patient.class.php');
include('../classes/donor.class.php');
include('../classes/admin.class.php');
$conn = Database::getInstance()->getConn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set the allowed origins for CORS
    $allowed_origins = array('https://elifesaver.online', 'http://localhost:8080', 'https://af25-41-202-207-144.ngrok-free.app');

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

    $user = null;
    $type = null;

    // Check if the login is for a patient or a donor
    if (Patient::isPatient($_POST['email'])) {
        $user = Patient::loginPatient($_POST['email'], $_POST['password']);
        $type = "patient";
    } else if (Donor::isDonor($_POST['email'])) {
        $user = Donor::loginDonor($_POST['email'], $_POST['password']);
        $type = "donor";
    }
    else if (Admin::isAdmin($_POST['email'])) {
        $user = Admin::loginAdmin($_POST['email'], $_POST['password']);
        $type = "admin";
    }
    

    if ($user) {
        
    
        // Update the last login time for the user
        $user->last_login = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE " . $type . "s SET last_login = ? WHERE id = ?");
        $stmt->bind_param("si", $user->last_login, $user->id);
        $stmt->execute();
        
        
        $response = array('success' => true, 'type' => $type, 'user' => $user);
    } else if ($user === 0) {
        $response = array('success' => false, 'error' => "Wrong Password");
    } else if(!$user){
        $response = array('success' => false, 'error' => "Invalid email or password");
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}