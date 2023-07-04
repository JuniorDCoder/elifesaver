<?php
// Set the allowed origins for CORS
$allowed_origins = array('http://localhost:8080', 'https://5ac6-102-244-155-96.ngrok-free.app');

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
// Login a user
include('../classes/user.class.php');
$conn = Database::getInstance()->getConn();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = User::login($_POST['email'], $_POST['password']);
    if ($user) {
        //Start a session
        session_start();

        $user->last_login = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE users SET last_login = ? WHERE id = ?");
        $stmt->bind_param("si", $user->last_login, $user->id);
        $stmt->execute();
        if ($user->type == 'patient') {
            $_SESSION['patient'] = ['id' => $user->id, 'type' => "patient"];
            $user_id = $_SESSION['patient']['id'];
            $user_type = "patient";
        }
        else if ($user->type == 'donor') {
            $_SESSION['donor'] = ['id' => $user->id, 'type' => "donor"];
            $user_id = $_SESSION['donor']['id'];
            $user_type = "donor";
        }
        
        $response = array('success' => true, 'user' => $user);
        $stmt->close();
        $conn->close();
    } 
    else if($user===0){
        $response = array('success' => "wrong pwd");
    }
    else {
        $response = array('success' => false);
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    
}