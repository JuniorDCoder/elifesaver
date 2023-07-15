<?php
class Donor extends Patient{
    public $id;
    public $donor_name;
    public $gender;
    public $email;
    public $password;
    public $phone;
    public $address;
    public $city;
    public $last_login;
    public $blood_group;
    public $last_donation_date;
    public $bts_number;
    private $conn;
    public function __construct($donor_name, $gender, $email, $password, $phone, $address, $city, $blood_group, $bts_number) {
        $this->donor_name = $donor_name;
        $this->gender = $gender;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->address = $address;
        $this->city = $city;
        $this->blood_group = $blood_group;
        $this->bts_number = $bts_number;
        $this->conn = Database::getInstance()->getConn();
    }
    public function getId() {
        return $this->id;
    }
    
    public function getBloodGroup() {
        return $this->blood_group;
    }
    public function registerDonor(){
        // Check if the email already exists
        $stmt = $this->conn->prepare("SELECT id FROM donors WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return -1;
        }   
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        // Insert the new donor record
        $stmt = $this->conn->prepare("INSERT INTO donors (donor_name, gender, email, password, phone, address, city, blood_group, bts_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $this->donor_name, $this->gender, $this->email, $hashed_password, $this->phone, $this->address, $this->city, $this->blood_group, $this->bts_number);
        if ($stmt->execute()) {
            $this->id = $this->conn->insert_id;
            $stmt->close();
            $this->conn->close();
            
            return true;
        }
        else{
            return false;
        }
    }
    public static function loginDonor($email, $password) {
        $conn = Database::getInstance()->getConn();
        // Get the donor record with the given email
        $stmt = $conn->prepare("SELECT * FROM donors WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a donor was found with the given email
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Password is correct, create and return a new donor object
                $donor = new Donor($row['donor_name'], $row['gender'], $row['email'], $row['password'], $row['phone'], $row['address'], $row['city'], $row['blood_group'], $row['bts_number']);
                $donor->id = $row['id'];
                return $donor;
            }
            else{
              return 0;
            }
        }
        // No donor found with the given email or password is incorrect, return false
        return false;
    }
    public function updateDonorPassword($new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE donors SET password = ? WHERE id = ?");
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
        public function updateDonorPersonalInfo($phone, $address, $city) {
            $stmt = $this->conn->prepare("UPDATE donors SET phone = ?, address = ?, city = ? WHERE id = ?");
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
        public static function isDonor($email) {
            // Check if the email belongs to a donor
            $conn = Database::getInstance()->getConn();
            $stmt = $conn->prepare("SELECT COUNT(*) FROM donors WHERE email = ?");
            $stmt->bind_param("s", $email);
            $count = null;
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
        
            return $count > 0;
        }
      //Delete a user
    public static function deleteDonor($donor_id) {
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("DELETE FROM donors WHERE id = ?");
        $stmt->bind_param("i", $donor_id);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            return false;
        }
    }
}