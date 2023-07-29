<?php
$host = "localhost";
$username = "u944161398_e_life_saver";
$password = "nu7DRg7MTMfyfNN";
$database = "u944161398_e_life_saver";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the total number of blood requests
$query = "SELECT COUNT(*) AS total_blood_requests FROM blood_appeals";
$result = $conn->query($query);
$total_blood_requests = $result->fetch_assoc()["total_blood_requests"];

// Get the total number of registered donors
$query = "SELECT COUNT(*) AS total_registered_donors FROM donors";
$result = $conn->query($query);
$total_registered_donors = $result->fetch_assoc()["total_registered_donors"];

// Get the total number of blood bags
$query = "SELECT COUNT(*) AS total_blood_bags FROM blood_bank";
$result = $conn->query($query);
$total_blood_bags = $result->fetch_assoc()["total_blood_bags"];

// Get the total number of registered patients
$query = "SELECT COUNT(*) AS total_registered_patients FROM patients";
$result = $conn->query($query);
$total_registered_patients = $result->fetch_assoc()["total_registered_patients"];

// Get the number of pending blood requests
$query = "SELECT COUNT(*) AS total_pending_blood_requests FROM blood_appeals WHERE status = 'pending'";
$result = $conn->query($query);
$total_pending_blood_requests = $result->fetch_assoc()["total_pending_blood_requests"];

// Get the total number of blood bags of each blood group
$blood_group_counts = array();
$blood_group_ids = array(1, 2, 3, 4, 5, 6, 7, 8);
foreach ($blood_group_ids as $blood_group_id) {
  $query = "SELECT COUNT(*) AS total_blood_bags FROM blood_bank WHERE blood_bank_id = $blood_group_id";
  $result = $conn->query($query);
  $blood_group_counts[$blood_group_id] = $result->fetch_assoc()["total_blood_bags"];
}

// Close the database connection
$conn->close();

// Display the information on the front end
echo "Total number of blood requests: $total_blood_requests";
echo "<br>";
echo "Total number of registered donors: $total_registered_donors";
echo "<br>";
echo "Total number of blood bags: $total_blood_bags";
echo "<br>";
echo "Total number of registered patients: $total_registered_patients";
echo "<br>";
echo "Number of pending blood requests: $total_pending_blood_requests";
echo "<br>";
echo "Total number of blood bags of blood group A+: $blood_group_counts[1]";
echo "<br>";
echo "Total number of blood bags of blood group A-: $blood_group_counts[2]";
echo "<br>";
echo "Total number of blood bags of blood group B+: $blood_group_counts[3]";
echo "<br>";
echo "Total number of blood bags of blood group B-: $blood_group_counts[4]";
echo "<br>";
echo "Total number of blood bags of blood group AB+: $blood_group_counts[5]";
echo "<br>";
echo "Total number of blood bags of blood group AB-: $blood_group_counts[6]";
echo "<br>";
echo "Total number of blood bags of blood group O+: $blood_group_counts[7]";
echo "<br>";
echo "Total number of blood bags of blood group O-: $blood_group_counts[8]";
?>