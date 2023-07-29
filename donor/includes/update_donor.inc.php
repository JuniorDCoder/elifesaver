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

$conn = Database::getInstance()->getConn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receive post fields data from the frontend
    $id = $_POST['id'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    // Create a new donor object and update the donor details
    $donor = new Donor('', '', '', '', '', '', '', '', '');
    $result = $donor->updateDonorDetails($id, $name, $password, $phone, $address, $city);

    // Check if the update was successful
    if ($result !== false) {
        // Return a success message and an instance of the updated donor
        $response = array(
            'success' => true,
            'type' => 'donor',
            'user' => [
                'id' => $donor->id,
                'name' => $result->donor_name,
                'password' => $result->password,
                'phone' => $result->phone,
                'address' => $result->address,
                'city' => $result->city
            ]
        );
        echo json_encode($response);
    } else {
        // Return an error message
        $response = array(
            'success' => false,
            'error' => 'Failed to update donor details',
        );
        echo json_encode($response);
    }
}