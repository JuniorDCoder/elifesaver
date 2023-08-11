<?php
// Include the database connection file
include 'db_connect.class.php';

// Define the BloodAppeal class
class BloodAppeal {
  // Properties
  public $appeal_id;
  public $patient_id;
  public $donor_id;
  public $number_of_bags;
  public $blood_group;
  public $health_facility; 
  public $medical_info;
  public $creation_date;
  public $status;
  private $conn;

  // Constructor
  public function __construct($patient_id, $donor_id, $number_of_bags, $blood_group, $health_facility, $medical_info, $status) {
    $this->patient_id = $patient_id;
    $this->donor_id = $donor_id;
    $this->number_of_bags = $number_of_bags;
    $this->blood_group = $blood_group;
    $this->health_facility = $health_facility;
    $this->medical_info = $medical_info;
    $this->status = $status;
    $this->conn = Database::getInstance()->getConn();
  }

  // Create a new blood appeal
  public function createPatientAppeal() {
    // Insert the new blood appeal record for Patient
    $stmt = $this->conn->prepare("INSERT INTO blood_appeals (patient_id, number_of_bags, blood_group, health_facility, medical_info, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $this->patient_id, $this->number_of_bags, $this->blood_group, $this->health_facility, $this->medical_info, $this->status);
    if ($stmt->execute()) {
      $this->appeal_id = $this->conn->insert_id;
      $stmt->close();
      return true;
    } else {
      return false;
    }
  }
  public function createDonorAppeal() {
    // Insert the new blood appeal record for Donor
    $stmt = $this->conn->prepare("INSERT INTO blood_appeals (donor_id, number_of_bags, blood_group, health_facility, medical_info, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $this->donor_id, $this->number_of_bags, $this->blood_group, $this->health_facility, $this->medical_info, $this->status);
    if ($stmt->execute()) {
      $this->appeal_id = $this->conn->insert_id;
      $stmt->close();
      return true;
    } else {
      return false;
    }
  }

  // Get all blood appeals for a given patient
  public static function getAllForPatient($patient_id) {
    $conn = Database::getInstance()->getConn();
    // Retrieve all blood appeals for the given patient
    $stmt = $conn->prepare("SELECT * FROM blood_appeals WHERE patient_id = ? ORDER BY creation_date DESC");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $appeals = $result->fetch_all(MYSQLI_ASSOC);
    return $appeals;
  }
  // Get all blood appeals for a given blood group
  public static function getAllForBloodGroup($blood_group, $city, $address) {
      $conn = Database::getInstance()->getConn();
      // Retrieve all blood appeals for the given blood group and matching city
      $lower_city = strtolower($city);
      $lower_address = strtolower($address);
      $stmt = $conn->prepare("SELECT * FROM blood_appeals WHERE blood_group = ? OR LOWER(health_facility) = ? OR LOWER(health_facility) = ? ORDER BY creation_date DESC");
      $stmt->bind_param("sss", $blood_group, $lower_city, $lower_address);
      $stmt->execute();
      $result = $stmt->get_result();
      $appeals = $result->fetch_all(MYSQLI_ASSOC);
      return $appeals;
  }
  public static function deleteBloodAppeal($id) {
    $conn = Database::getInstance()->getConn();
    // Execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM blood_appeals WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      $stmt->close();
      $conn->close();
      return true;
    } else {
      return false;
    }
  }
}