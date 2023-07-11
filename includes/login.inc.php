<?php
// Login a patient or donor
include('../classes/patient.class.php');
include('../classes/donor.class.php');
$conn = Database::getInstance()->getConn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set the allowed origins for CORS
    $allowed_origins = array('http://localhost:8080', 'https://b112-102-244-155-36.ngrok-free.app');

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

    if ($user) {
        // Start a session
        session_start();

        $user->last_login = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE " . $type . "s SET last_login = ? WHERE id = ?");
        $stmt->bind_param("si", $user->last_login, $user->id);
        $stmt->execute();

        // Set the session variable based on the user type
        $_SESSION[$type] = [
            'id' => $user->id,
            'type' => $type,
            'email' => $user->email
        ];
        $user_id = $_SESSION[$type]['id'];
        $response = array('success' => true, 'user_id' => $user_id);
    } else if ($user === 0) {
        $response = array('success' => false, 'error' => "Wrong Password");
    } else {
        $response = array('success' => false, 'error' => "Invalid email or password");
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}