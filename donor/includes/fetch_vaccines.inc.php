<?php

require('../../config/config.php');
class Database
{
    private static $instance = null;
    private $host = db_host;
    private $username = db_user;
    private $password = db_password;
    private $database_name = db_name;
    private static $conn;

    public function __construct(){
        self::$conn = new mysqli($this->host, $this->username, $this->password, $this->database_name);
        if (self::$conn->connect_error) {
            die("Connection Failed: ".self::$conn->connect_error);
        }
    }
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public static function getConn() {
        return self::$conn;
    }
    public function insertId() {
        return self::$conn->insert_id;
    }

}

$allowed_origins = array('https://elifesaver.online/','http://localhost:8080', 'https://2721-102-244-155-9.ngrok-free.app');

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

include('../../classes/donor.class.php');
include('../../classes/vaccine.class.php');
include('../../classes/vaccine_status.class.php');


$conn = Database::getInstance()->getConn();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $donor_id = $_POST['id'];
    
    $donor = Donor::getDonorById($donor_id);
    $bts_number = $donor->bts_number;
    
    $vaccines = Vaccine::getAllVaccines();
    
    $vaccine_statuses = VaccineStatus::getAllVaccineStatusesByBtsNumber($bts_number);
    
    $status_responses = array();
    foreach($vaccine_statuses as $vaccine_status){
        $status_responses[] = [
            'dose_date' => $vaccine_status->date
        ];
    }

    $vaccine_responses = array();
    foreach($vaccine_statuses as $vaccine_status){
        $vaccine_responses[] = [
            'vaccine_name' => Vaccine::getVaccineNameById($vaccine_status->vaccine_id),
            'status' => $vaccine_status->status
            
        ];
    }

    if(!empty($status_responses) && !empty($vaccine_responses)){
        $response = [
            'success' => true, 
            'date' => $status_responses,
            'vaccine_response' => $vaccine_responses
        ];
    }
    else{
        $response = [
          'success' => false,
          'error' => "No vaccines exist for this Donor"
        ];
    }
    
    echo json_encode($response);
}