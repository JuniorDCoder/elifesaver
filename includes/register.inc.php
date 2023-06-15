<?php
include('../classes/user.class.php');
// Register a new user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($_POST['username'], $_POST['email'], $_POST['password'], $_POST['phone'], $_POST['address'], $_POST['type']);
    if ($user->register()) {
      echo json_encode(array('success' => true));
    } 
    else if($user->register() === 0){
      echo json_encode(array('success' => 'username exist'));
    }
    else if($user->register() === -1){
      echo json_encode(array('success' => 'email exist'));
    }
    else {
      echo json_encode(array('success' => false));
    }
  }