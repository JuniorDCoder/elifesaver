<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_POST['gender']) && isset($_POST['blood_group']) && isset($_POST['password'])) {
        
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
        include('../../classes/donor.class.php');
        

        include_once('../../config/bts_number.config.php');
        $registration_token = bin2hex(random_bytes(32));

        $donor = new Donor($_SESSION['name'], $_POST['gender'], $_POST['password'], $_SESSION['email'], $_SESSION['phone'], $_POST['address'], $_POST['city'], $_POST['blood_group'], $registration_token, $bts_number);
        $register_result = $donor->registerDonor();
        
        if ($register_result) {
            $conn = Database::getInstance()->getConn();
            // Update the last login time for the donor
            $donor->last_login = date('Y-m-d H:i:s');
            $stmt = $conn->prepare("UPDATE donors SET last_login = ? WHERE id = ?");
            $stmt->bind_param("si", $donor->last_login, $donor->id);
            $stmt->execute();
            
            $stmt->close();
            $conn->close();

            // Unset all the session variables
            session_unset();

            // Destroy the session
            session_destroy();

            // Unset all the cookies by setting their expiration to the past
            setcookie('type', '', time() - 3600, '/');
            setcookie('name', '', time() - 3600, '/');
            setcookie('email', '', time() - 3600, '/');

            setcookie('id', $donor->id, time() + (86400 * 30), '/'); // Example expiration time: 30 days
            setcookie('type', 'donor', time() + (86400 * 30), '/');
            setcookie('email', $donor->email, time() + (86400 * 30), '/');
            setcookie('name', $donor->donor_name, time() + (86400 * 30), '/');

            header('Location: ../../donor/dashboard.php');
            exit();

        }   else if ($register_result === -1) {
            echo('<script>alert("This Email already exist!");</script>');
        }   elseif (!$register_result) {
            echo('<script>alert("Error Occured. Please try Again!");</script>');
        }
   }    else{
    echo('<script>alert("Fill All Fields!");</script>');
   }
}