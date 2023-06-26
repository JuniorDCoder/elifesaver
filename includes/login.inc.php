<?php
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
        echo json_encode(array('success' => true, 'user' => $user));
        $stmt->close();
        $conn->close();
    } 
    else if($user===0){
        echo json_encode(array('success' => "wrong pwd"));
    }
    else {
        echo json_encode(array('success' => false));
    }
    
}