<?php
include('../classes/blood_appeal.class.php');
include('../classes/patient.class.php');
// Check if the user is logged in and is a patient
session_start();
if (!isset($_SESSION['patient']) || $_SESSION['patient']['type'] !== 'patient') {
  echo json_encode(array('error' => 'User not logged in or not a patient'));
  exit();
}

// Get the patient ID from the request parameters
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $user_id = $_SESSION['patient']['id'];
    $patient = Patient::getPatientIdFromUserId($user_id);
    $patient_id = mysqli_fetch_assoc($patient);
    // Retrieve all blood appeals for the given patient
    $appeals = BloodAppeal::getAllForPatient($patient_id);

    // Check if any appeals were found
    if (empty($appeals)) {
        echo json_encode(array('error' => 'No blood appeals found for the given patient'));
        exit();
    }

    // Output the appeals in JSON format
    echo json_encode(array('success' => true, 'appeals' => $appeals));
} else {
  echo json_encode(array('error' => 'Missing patient ID parameter'));
}

