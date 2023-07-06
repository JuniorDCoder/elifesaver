<?php
class Admin extends User
{
    public function addUser($username, $email, $password, $phone, $address, $type) {
        $user = new User($username, $email, $password, $phone, $address, $type);
        return $user->register();
    }
    public function deleteUser($user_id) {
        return User::delete($user_id);
    }
    public function updateUserPersonalInfo($user_id, $phone, $address) {
        $user = new User($this->username, $this->email, $this->password, $phone, $address, '');
        $user->id = $user_id;
        return $user->updatePersonalInfo($phone, $address);
    
    }
    // Get all users
    public static function getUsers() {
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        $users = array();
        while ($row = $result->fetch_assoc()) {
        $user = new User($row['username'], $row['email'], $row['password'], $row['phone'], $row['address'], $row['type']);
        $user->id = $row['id'];
        $user->last_login = $row['last_login'];
        array_push($users, $user);
        }
        $stmt->close();
        $conn->close();
        return $users;
    }
    public static function getUserById($user_id) {
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          $user = new User($row['username'], $row['email'], $row['password'], $row['phone'], $row['address'], $row['type']);
          $user->id = $row['id'];
          $user->last_login = $row['last_login'];
          $stmt->close();
          $conn->close();
          return $user;
        } else {
          $stmt->close();
          $conn->close();
          return false;
        }
    }
    public static function updateUserType($user_id, $new_type) {
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("UPDATE users SET type = ? WHERE id = ?");
        $stmt->bind_param("si", $new_type, $user_id);
        if ($stmt->execute()) {
          $stmt->close();
          $conn->close();
          return true;
        } else {
          return false;
        }
    }
    public function updatePassword($user_id, $new_password) {
        $user = new User($this->username, $this->email, $this->password, $this->phone, $this->address, $this->type);
        $user->id = $user_id;
        return $user->updatePassword($new_password);
    }
    // Get all laboratory results for a donor
    public static function getDonorLabResults($donor_id) {
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("SELECT * FROM lab_results WHERE donor_id = ?");
        $stmt->bind_param("i", $donor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $lab_results = array();
        while ($row = $result->fetch_assoc()) {
        $lab_result = new LabResult($row['donor_id'], $row['test_type'], $row['result_value'], $row['date']);
        $lab_result->id = $row['id'];
        array_push($lab_results, $lab_result);
        }
        $stmt->close();
        $conn->close();
        return $lab_results;
    }
    // Add a laboratory result for a donor
    public static function addDonorLabResult($donor_id, $test_type, $result_value, $date) {
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("INSERT INTO lab_results (donor_id, test_type, result_value, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $donor_id, $test_type, $result_value, $date);
        if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
        } else {
        return false;
        }
    }
    // Delete a laboratory result for a donor
    public static function deleteDonorLabResult($lab_result_id) {
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("DELETE FROM lab_results WHERE id = ?");
        $stmt->bind_param("i", $lab_result_id);
        if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
        } else {
        return false;
        }
    }
}
