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
    
    include('../classes/blood_appeal.class.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
       if($_POST['user_type'] == 'patient'){
           $id = $_POST['id'];
           $blood_appeals = BloodAppeal::getAllForPatient($id);
       }
       else if($_POST['user_type'] == 'donor'){
           $blood_group = $_POST['blood_group'];
           $blood_appeals = BloodAppeal::getAllForBloodGroup($blood_group);
       }
       
       if(!empty($blood_appeals)){
           $response = [
              'success' => true,
              'blood_appeals' => $blood_appeals
            ];
       }else{
           $response = [
              'success' => false,
              'error' => 'No blood Requests available Yet'
            ];
       }
       
    // Encode the response as a JSON string and remove any unwanted characters
    $json_response = json_encode($response);
    $json_response = trim($json_response);

    // Set the content type header and output the JSON response
    header('Content-Type: application/json');
    echo $json_response;
    }