<?php
// Include the database connection file
include 'db_connect.class.php';

// Define the BloodAppeal class
class BloodAppeal {
  // Properties
  public $id;
  public $patient_id;
  public $health_facility_id;
  public $donor_id;
  public $status;
  private $conn;

  // Constructor
  public function __construct($patient_id, $donor_id, $health_facility_id, $status) {
    $this->patient_id = $patient_id;
    $this->health_facility_id = $health_facility_id;
    $this->donor_id = $donor_id;
    $this->status = $status;
    $this->conn = Database::getInstance()->getConn();
  }

  // Create a new blood appeal
  public function create() {
    // Insert the new blood appeal record
    $stmt = $this->conn->prepare("INSERT INTO blood_appeals (patient_id, donor_id, health_facility_id, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $this->patient_id, $this->donor_id, $this->health_facility_id, $this->status);
    if ($stmt->execute()) {
      $this->id = $this->conn->insert_id;
      $stmt->close();
      $this->conn->close();
      return true;
    } else {
      return false;
    }
  }

  // Get all blood appeals for a given patient
  public static function getAllForPatient($patient_id) {
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
  }
}