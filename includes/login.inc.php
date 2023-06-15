<?php
// Login a user
include('../classes/user.class.php');
$conn = Database::getInstance()->getConn();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = User::login($_POST['email'], $_POST['password']);
    if ($user) {
        $user->last_login = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE users SET last_login = ? WHERE id = ?");
        $stmt->bind_param("si", $user->last_login, $user->id);
        $stmt->execute();
        echo json_encode(array('success' => true, 'user' => $user));
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(array('success' => false));
    }
    
}