<?php

$allowed_origins = array('https://elifesaver.online','http://localhost:8080', 'https://b4e1-102-244-155-206.ngrok.io');

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

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $health_facilities = HealthFacility::getAllHealthFacilities();
    
    if(!empty($health_facilities)){
        $response = [
            'success' => true,
            'health_facilities' => $health_facilities
        ];
    }
    else{
        $response = [
            'success' => false,
            'error' => 'No health Facilities Available!'
        ];
    }
    
    // Encode the response as a JSON string and remove any unwanted characters
    $json_response = json_encode($response);
    $json_response = trim($json_response);

    // Set the content type header and output the JSON response
    header('Content-Type: application/json');
    echo $json_response;
}