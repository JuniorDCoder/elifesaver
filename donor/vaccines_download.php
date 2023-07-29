<?php
// Initialize variables
$host = "localhost";
$username = "u944161398_e_life_saver";
$password = "nu7DRg7MTMfyfNN";
$database = "u944161398_e_life_saver";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the list of vaccines
$query = "SELECT vaccine_name FROM vaccine";
$result = $conn->query($query);

// Create an array of vaccines
$vaccines = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $vaccines[] = $row["vaccine_name"];
  }
}

// Get the list of vaccine statuses
$query = "SELECT status, vaccine_id FROM vaccine_status";
$result = $conn->query($query);

// Create an array of vaccine statuses
$vaccine_statuses = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $vaccine_statuses[$row["vaccine_id"]] = $row["status"];
  }
}

// Get the first dose date
$query = "SELECT date FROM vaccine_status WHERE vaccine_id = 3";
$result = $conn->query($query);
$first_dose_date = "";
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $first_dose_date = $row["date"];
}

// Get the second dose date
$query = "SELECT date FROM vaccine_status WHERE vaccine_id = 4";
$result = $conn->query($query);
$second_dose_date = "";
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $second_dose_date = $row["date"];
}

// Get the third dose date
$query = "SELECT date FROM vaccine_status WHERE vaccine_id = 5";
$result = $conn->query($query);
$third_dose_date = "";
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $third_dose_date = $row["date"];
}

// Get the Yellow Fever status
$yellow_fever_status = $vaccine_statuses[1];

// Get the Covid 19 status
$covid_19_status = $vaccine_statuses[2];

// Create a PDF document
$pdf = new PDF();

// Add the header and footer
$pdf->AddHeader('Blood Donors Test Results');
$pdf->AddFooter('Page {PAGENO}');

// Add the content
$pdf->AddPage();
$pdf->Write(5, 'This is the content of the PDF file.');

// Close the PDF document
$pdf->Output('blood_donors_test_results.pdf', 'F');

// Close the database connection
$conn->close();
?>

