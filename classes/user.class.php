<?php
// Include the database connection file
include 'db_connect.class.php';

// Define the User class
class User {
  // Properties
  public $id;
  public $username;
  public $email;
  public $password;
  public $phone;
  public $address;
  public $type;
  public $last_login;
  private $conn;

  // Constructor
    public function __construct($username, $email, $password, $phone, $address, $type) {
      $this->username = $username;
      $this->email = $email;
      $this->password = $password;
      $this->phone = $phone;
      $this->address = $address;
      $this->type = $type;
      $this->conn = Database::getInstance()->getConn();
    }

  // Register a new user
  public function register() {

    // Check if the username already exists
    $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $this->username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      return 0;
    }

    // Check if the email already exists
    $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $this->email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      return -1;
    }

    $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
    // Insert the new user record
    $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, phone, address, type) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $this->username, $this->email, $hashed_password, $this->phone, $this->address, $this->type);
    if ($stmt->execute()) {
      $this->id = $this->conn->insert_id;
      $stmt->close();

      // Check the user type and insert into the respective table
      if ($this->type === 'patient') {
        $stmt = $this->conn->prepare("INSERT INTO patients (user_id) VALUES (?)");
      } else if ($this->type === 'donor') {
        $stmt = $this->conn->prepare("INSERT INTO donors (user_id) VALUES (?)");
      }
      $stmt->bind_param("i", $this->id);
      $stmt->execute();
      $stmt->close();

      $this->conn->close();
      return true;
    } else {
      return false;
    }
  }

  // Login a user
  public static function login($email, $password) {
        $conn = Database::getInstance()->getConn();
        // Get the user record with the given email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user was found with the given email
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Password is correct, create and return a new User object
                $user = new User($row['username'], $row['email'], $row['password'], $row['phone'], $row['address'], $row['type']);
                $user->id = $row['id'];
                $user->last_login = $row['last_login'];
                return $user;
            }
            else{
              return 0;
            }
        }

        // No user found with the given email or password is incorrect, return false
        return false;
  }
    public function updatePassword($new_password) {
      $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
      $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE id = ?");
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
    public function updatePersonalInfo($phone, $address) {
      $stmt = $this->conn->prepare("UPDATE users SET phone = ?, address = ? WHERE id = ?");
      $stmt->bind_param("ssi", $phone, $address, $this->id);
      if ($stmt->execute()) {
        $this->phone = $phone;
        $this->address = $address;
        $stmt->close();
        $this->conn->close();
        return true;
      } else {
        return false;
      }
    }
    
    //Delete a user
    public static function delete($user_id) {
      $conn = Database::getInstance()->getConn();
      $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
      $stmt->bind_param("i", $user_id);
      if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
      } else {
        return false;
      }
    }
}