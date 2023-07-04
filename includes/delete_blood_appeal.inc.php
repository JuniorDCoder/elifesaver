<?php

include('../classes/blood_appeal.class.php');
if (!isset($_SESSION['patient']) || !isset($_SESSION['donor'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'error' => 'Not authorized'));
    exit();
}
  
  // Handle the DELETE request
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Read the request body as JSON
    $data = json_decode(file_get_contents('php://input'), true);
  
    // Delete the blood appeal
    $appeal_id = $data['id'];
    $result = BloodAppeal::deleteBloodAppeal($appeal_id);
  
    // Return a JSON response indicating success or failure
    header('Content-Type: application/json');
    if ($result) {
      echo json_encode(array('success' => true));
    } else {
      echo json_encode(array('success' => false, 'error' => 'Unable to delete blood appeal'));
    }
}