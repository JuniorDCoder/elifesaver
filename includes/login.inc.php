<?php
// Start a session
session_start();

// Login a patient or donor
include('../classes/patient.class.php');
include('../classes/donor.class.php');
$conn = Database::getInstance()->getConn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set the allowed origins for CORS
    $allowed_origins = array('http://localhost:8080', 'https://9a71-41-202-207-145.ngrok-free.app');

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
        $_SESSION[$type] = [
            'id' => $user->id,
            'type' => $type,
            'email' => $user->email,
            'name' => $user->patient_name // Set the donor name in the session variable
        ];
    } else if (Donor::isDonor($_POST['email'])) {
        $user = Donor::loginDonor($_POST['email'], $_POST['password']);
        $type = "donor";

        $_SESSION[$type] = [
            'id' => $user->id,
            'type' => $type,
            'email' => $user->email,
            'name' => $user->donor_name // Set the donor name in the session variable
        ];
    }

    if ($user) {
        
    
        // Update the last login time for the user
        $user->last_login = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE " . $type . "s SET last_login = ? WHERE id = ?");
        $stmt->bind_param("si", $user->last_login, $user->id);
        $stmt->execute();
    
        // Retrieve the name of the user from the database
        $stmt = $conn->prepare("SELECT " . $type . "_name FROM " . $type . "s WHERE id = ?");
        $stmt->bind_param("i", $user->id);
        $stmt->execute();
        $stmt->bind_result($name);
        $stmt->fetch();
    
        // Store the name in a session variable
        $_SESSION[$type]['name'] = $name;
    
        $response = array('success' => true, 'type' => $type, 'user' => $user);
    } else if ($user === 0) {
        $response = array('success' => false, 'error' => "Wrong Password");
    } else {
        $response = array('success' => false, 'error' => "Invalid email or password");
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}