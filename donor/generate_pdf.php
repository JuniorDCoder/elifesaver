<?php
// Start the session
session_start();

// Check if the required session variables are set
if (!isset($_SESSION['type']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    // If the session variables are not set, check if the localStorage variables are set
    if (!isset($_COOKIE['type']) || !isset($_COOKIE['name']) || !isset($_COOKIE['email'])) {
        // If the localStorage variables are not set, redirect the user to the login page
        header('Location: ../index.php');
        exit();
    } else {
        // If the localStorage variables are set, set the session variables from the localStorage variables
        $_SESSION['id'] = $_COOKIE['id'];
        $_SESSION['type'] = $_COOKIE['type'];
        $_SESSION['name'] = $_COOKIE['name'];
        $_SESSION['email'] = $_COOKIE['email'];
    }
}

// Get the session variables
$userId = $_SESSION['id'];
$userType = $_SESSION['type'];
$userName = $_SESSION['name'];
$userEmail = $_SESSION['email'];


  // Create a new cURL resource
  $curl = curl_init();
  
  // Set the POST URL
  $url = 'http://localhost:80/elifesaver/donor/includes/fetch_vaccines.inc.php';
  
  // Set the POST data
  $data = array(
      'id' => $userId 
  );
  
  // Convert the data to query string format
  $dataString = http_build_query($data);
  
  // Set the cURL options
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  
  // Execute the cURL request
  $response = curl_exec($curl);
  
  // Check for errors
  if ($response === false) {
      $error = curl_error($curl);
      // Handle the error
  } else {
      // Process the response
      $responseData = json_decode($response, true);

      // Assign the vaccine responses to a variable
      $vaccine_responses = $responseData['vaccine_response'];
      // Handle the response data

      $status_responses = $responseData['date'];
  }
  
  // Close the cURL resource
  curl_close($curl);
// Include the necessary dependencies
require_once '../tcpdf/tcpdf.php';

// Create a new TCPDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Set the document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Vaccine Information');
$pdf->SetSubject('Vaccine Information');
$pdf->SetKeywords('Vaccine, Information');

// ... Rest of the PDF generation code ...

// Set the header and footer
$pdf->setHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
$pdf->setFooterData(array(0, 0, 0), array(255, 255, 255));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(15, 15, 15);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

// Set auto page breaks
$pdf->SetAutoPageBreak(true, 10);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', 'B', 14);

// Output the donor information
$pdf->Cell(0, 10, $userName. ' Test Results', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 12);
$pdf->Ln(5);

// Display the date of the last donation
if (isset($status_responses) && !empty($status_responses)) {
    $lastDonationDate = end($status_responses)['dose_date'];
    $pdf->Cell(0, 10, 'Date of Donation Date: ' . $lastDonationDate, 0, 1);
} else {
    $pdf->Cell(0, 10, 'No Donation', 0, 1);
}

$pdf->Ln(5);

// Display the doses table
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Doses', 0, 1);
$pdf->SetFont('helvetica', '', 12);

$pdf->Ln(5);

// Display the dates of the last three doses
if (isset($status_responses) && !empty($status_responses)) {
    $lastThreeDoses = array_slice($status_responses, -3);
    $pdf->Cell(0, 10, '1st Dose: ' . $lastThreeDoses[0]['dose_date'], 0, 1);
    $pdf->Cell(0, 10, '2nd Dose: ' . $lastThreeDoses[1]['dose_date'], 0, 1);
    $pdf->Cell(0, 10, '3rd Dose: ' . $lastThreeDoses[2]['dose_date'], 0, 1);
} else {
    $pdf->Cell(0, 10, 'No Dose', 0, 1);
    $pdf->Cell(0, 10, 'No Dose', 0, 1);
    $pdf->Cell(0, 10, 'No Dose', 0, 1);
}

$pdf->Ln(10);

// Display the vaccine information
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Vaccines', 0, 1);
$pdf->SetFont('helvetica', '', 12);

$pdf->Ln(5);

// Display the vaccine names and their statuses
if (isset($vaccine_responses) && !empty($vaccine_responses)) {
    foreach ($vaccine_responses as $vaccine) {
        $pdf->Cell(0, 10, 'Vaccine Name: ' . $vaccine['vaccine_name'], 0, 1);
        $pdf->Cell(0, 10, 'Status: ' . $vaccine['status'], 0, 1);
        $pdf->Ln(5);
    }
} else {
    $pdf->Cell(0, 10, 'No Vaccines Taken', 0, 1);
}

// Set the footer
$pdf->SetY(10);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->SetTextColor(0);
$pdf->Cell(0, 5, 'Downloaded from: https://elifesaver.online', 0, 0, 'C');


// Close and output the PDF
$pdf->Output('vaccine_information.pdf', 'D');
?>