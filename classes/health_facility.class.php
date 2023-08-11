<?php
// Include the database connection file
include 'db_connect.class.php';

// Define the BloodAppeal class
class HealthFacility {
  // Properties
  public $facility_id;
  public $health_facility_id;
  public $name;
  public $city; 
  public $address;

  private $conn;

  // Constructor
  public function __construct( $health_facility_id, $name, $city, $address) {
    $this->health_facility_id = $health_facility_id;
    $this->name = $name;
    $this->city = $city;
    $this->address = $address;
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
  public static function getAllHealthFacilities() {
    $conn = Database::getInstance()->getConn();
    $stmt = $conn->prepare("SELECT * FROM health_facilities");
    $stmt->execute();
    $result = $stmt->get_result();

    $healthFacilities = array();
    while ($row = $result->fetch_assoc()) {
      $healthFacility = new HealthFacility($row['health_facility_id'], $row['name'], $row['city'], $row['address']);
      $healthFacility->facility_id = $row['health_facility_id'];
      $healthFacilities[] = $healthFacility;
    }

    return $healthFacilities;
  }
}