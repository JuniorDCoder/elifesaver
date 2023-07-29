<?php
// Include the database connection file
include 'db_connect.class.php';

// Define the BloodAppeal class
class HealthFacility {
  // Properties
  public $facility_id;
 // public $patient_id;
  //public $donor_id;
  public $health_facility_id;
  public $name;
  public $city; 
  public $address;
  public $creation_date;
  public $status;
  private $conn;

  // Constructor
  public function __construct( $health_facility_id, $name, $city, $address, $status) {
    //$this->patient_id = $patient_id;
   // $this->donor_id = $donor_id;
    $this->health_facility_id = $health_facility_id;
    $this->name = $name;
    $this->city = $city;
    $this->address = $address;
   // $this->status = $status;
    $this->conn = Database::getInstance()->getConn();
  }

  // Create a new health facility
  public function createHealthFacililty() {
    // Insert the new health facilty 
    $stmt = $this->conn->prepare("INSERT INTO health_facilities (health_facility_id, name, city, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iissss", $this->health_facility_id, $this->name, $this->city, $this->address);
    if ($stmt->execute()) {
      $this->facility_id = $this->conn->insert_id;
      $stmt->close();
      return true;
    } else {
      return false;
    }
  }
 /* public function createDonorAppeal() {
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
  }*/

  // Get all blood appeals for a given patient
  /*public static function getAllForPatient($patient_id) {
    $conn = Database::getInstance()->getConn();
    // Retrieve all blood appeals for the given patient
    $stmt = $conn->prepare("SELECT * FROM blood_appeals WHERE patient_id = ?");
    $stmt->bind_param("i", $patient_id);
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
  } */
}