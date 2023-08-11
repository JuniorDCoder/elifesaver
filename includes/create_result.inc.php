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
    
    include('../classes/result.class.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $result = new Result($_POST['bts'], $_POST['hcv'], $_POST['hbag'], $_POST['hiv'], $_POST['syphilis'], $_POST['weight'], $_POST['bp_up'], $_POST['bp_down'], $_POST['hb'], $_POST['hcv_elisa'], $_POST['hbsAg_elisa'], $_POST['hiv_elisa'], $_POST['observation']);

        $result_is_created = $result->createNewResult();

        if ($result_is_created) {
            $conn = Database::getInstance()->getConn();

            $result->date = date('Y-m-d H:i:s');
            $stmt = $conn->prepare("UPDATE results_serology SET date = ? WHERE results_id = ?");
            $stmt->bind_param("si", $result->date, $result->results_id);
            $stmt->execute();

            $stmt->close();
            $conn->close();

            $response = [
                'success' => true,
                'results' => $result
            ];
        }
        else{
            $response = [
                'success' => false,
                'error' => "Please try again"
            ];
        }
        // Encode the response as a JSON string and remove any unwanted characters
        $json_response = json_encode($response);
        $json_response = trim($json_response);

        // Set the content type header and output the JSON response
        header('Content-Type: application/json');
        echo $json_response;
    }