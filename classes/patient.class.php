<?php
include('db_connect.class.php');
class Patient{
    private $id;
    private $patient_name;
    private $gender;
    private $email;
    private $password;
    private $phone;
    private $address;
    private $city;
    private $last_login;
    private static $is_logged_in = false;
    private $conn;
    private function __construct($patient_name, $gender, $email, $password, $phone, $address, $city) {
        $this->patient_name = $patient_name;
        $this->gender = $gender;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->address = $address;
        $this->city = $city;
        $this->conn = Database::getInstance()->getConn();
    }
    private function registerPatient(){
        // Check if the email already exists
        $stmt = $this->conn->prepare("SELECT id FROM patients WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return -1;
        }   
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        // Insert the new patient record
        $stmt = $this->conn->prepare("INSERT INTO patients (patient_name, gender, email, password, phone, address, city) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $this->patient_name, $this->gender, $this->email, $hashed_password, $this->phone, $this->address, $this->city);
        if ($stmt->execute()) {
            $this->id = $this->conn->insert_id;
            $stmt->close();
            $this->conn->close();
            self::$is_logged_in = true;
            return true;
        }
        else{
            return false;
        }
    }
    private static function loginPatient($email, $password) {
        $conn = Database::getInstance()->getConn();
        // Get the patient record with the given email
        $stmt = $conn->prepare("SELECT * FROM patients WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a patient was found with the given email
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Password is correct, create and return a new patient object
                $patient = new Patient($row['patient_name'], $row['gender'], $row['email'], $row['password'], $row['phone'], $row['address'], $row['city']);
                $patient->id = $row['id'];
                $patient->last_login = $row['last_login'];
                self::$is_logged_in = true;
                return $patient;
            }
            else{
              return 0;
            }
        }
        // No patient found with the given email or password is incorrect, return false
        return false;
    }
    private function updatePatientPassword($new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE patients SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $this->id);
        if ($stmt->execute()) {
          $this->password = $hashed_password;
          $stmt->close();
          $this->conn->close();
          return true;
        } else {
          return false;
        }
    }
      
      // Update the user's personal information
    private function updatePatientPersonalInfo($phone, $address, $city) {
            $stmt = $this->conn->prepare("UPDATE patients SET phone = ?, address = ?, city = ? WHERE id = ?");
            $stmt->bind_param("sssi", $phone, $address, $city, $this->id);
            if ($stmt->execute()) {
            $this->phone = $phone;
            $this->address = $address;
            $this->city = $city;
            $stmt->close();
            $this->conn->close();
                return true;
            } else {
                return false;
            }
    }
    
    public static function isPatient($email) {
        // Check if the email belongs to a patient
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM patients WHERE email = ?");
        $stmt->bind_param("s", $email);
        $count = null;
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;
    }
    public static function logout() {
        self::$is_logged_in = false;
        return true;
    }
}