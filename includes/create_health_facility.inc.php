<?php

    $allowed_origins = array('https://elifesaver.online','http://localhost:8080', 'https://b112-102-244-155-36.ngrok-free.app');

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
    
    include('../classes/health_facility.class.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       // $status = "pending";
        //if($_POST['user_type'] == 'patient'){
           // $blood_appeal = new BloodAppeal($_POST['patient_id'], $_POST['donor_id'], $_POST['number_of_bags'], $_POST['blood_group'], $_POST['health_facility'], $_POST['medical_info'], $status);
           $health_facility = new HealthFacility($_POST['health_facility_id'], $_POST['name'], $_POST['city'], $_POST['address']);
           
           // $blood_appeal_created = $blood_appeal->createPatientAppeal();
            $health_facility_created = $health_facility->HealthFacility();
            
        }
       /* else if($_POST['user_type'] == 'donor'){
            $blood_appeal = new BloodAppeal($_POST['patient_id'], intval($_POST['donor_id']), $_POST['number_of_bags'], $_POST['blood_group'], $_POST['health_facility'], $_POST['medical_info'], $status);
            $blood_appeal_created = $blood_appeal->createDonorAppeal();
        }
        */
       

        if ($health_facility_created) {
            
            $response = array('success' => true, 'health_facility' => $health_facility);
        }
        else{
            $response = array('success' => false, 'error' => "Error occured. Try agian!", 'health_facility' => $health_facility);
        }

    // Encode the response as a JSON string and remove any unwanted characters
    $json_response = json_encode($response);
    $json_response = trim($json_response);

    // Set the content type header and output the JSON response
    header('Content-Type: application/json');
    echo $json_response;
    }