<?php
session_start();
include('../classes/blood_appeal.class.php');
$conn = Database::getInstance()->getConn();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if((isset($_SESSION['type']))){
        $status = "pending";
        if(isset($_SESSION['patient'])){
            $blood_appeal = new BloodAppeal($_POST['patient_id'], $_POST['donor_id'], $_POST['health_facility_id'], $status);
        }
        else if(isset($_SESSION['donor'])){
            $donor_id = $_SESSION['donor']['id'];
            $blood_appeal = new BloodAppeal($_POST['donor_id'], $_POST['donor_id'], $_POST['health_facility_id'], $status);
        }
        
        $blood_appeal_created = $blood_appeal->create();
        if ($blood_appeal_created) {
            echo json_encode(array('success' => true, 'blood_appeal' => $blood_appeal));
        }
        else{
            echo json_encode(array('success' => false));
        }
    }
        
    else{
        echo json_encode(array('success' => "Not Logged in as Patient or Donor"));
    }
    
}