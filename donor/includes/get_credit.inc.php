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

$allowed_origins = array('https://elifesaver.online/','http://localhost:80', 'https://4ddf-102-244-155-126.ngrok.io');

// Get the origin header from the request
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

// Check if the origin is allowed
if (in_array($origin, $allowed_origins)) {
    // Set the CORS headers
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Cache-Control: no-cache, no-store, must-revalidate');
}

$conn = Database::getInstance()->getConn();

include('../../classes/credit.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $bts_number = $_GET['bts_number'];

    if (isset($_GET['bts_number'])) {
        $credit = Credit::getCredit($bts_number);

        if (!is_null($credit)){
            $response = [
                'success' => true,
                'credit' => $credit
            ];
        } else {
            $response = [
                'success' => true,
                'credit' => 0
            ];
        }
    } else {
        $response = [
            'success' => false,
            'error' => 'Missing bts_number parameter'
        ];
    }

    // Encode the response as a JSON string and remove any unwanted characters
    $json_response = json_encode($response);
    $json_response = trim($json_response);

    // Set the content type header and output the JSON response
    header('Content-Type: application/json');
    echo $json_response;
}