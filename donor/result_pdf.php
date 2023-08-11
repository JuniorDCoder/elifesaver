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
// include the BloodAppeal class file
require_once ('../classes/result.class.php');
require_once ('../classes/donor.class.php'); 


$donor = Donor::getDonorById($_SESSION['id']);
$btsNumber = $donor->bts_number;

$endpoint = 'https://elifesaver.online/includes/get_all_donor_results.inc.php';


$curl = curl_init();

curl_setopt_array($curl, [
CURLOPT_URL => "$endpoint?bts_number=$btsNumber",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTPHEADER => [
    'Content-Type: application/json'
]
]);

$response = curl_exec($curl);

if ($response === false) {
$error = curl_error($curl);
echo "cURL Error: $error";
} else {
$data = json_decode($response, true);
}

curl_close($curl);

// Include the necessary dependencies
require_once '../tcpdf/tcpdf.php';

// Create a new TCPDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Set the document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Result Information');
$pdf->SetSubject('Result Information');
$pdf->SetKeywords('Result, Information');

// Add a new page
$pdf->AddPage();

// Set the font
$pdf->SetFont('helvetica', 'B', 16);

// Set the main cell heading with the donor's name and test results
$pdf->Cell(0, 0, 'Test Results for ' . $userName, 0, 1, 'C');
$pdf->SetCellPadding(10);


// Set the font size for the table
$pdf->SetFont('helvetica', '', 12);

// Set the table header
$pdf->SetFillColor(220, 220, 220);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);

$headers = array(
    array('HCV', 'HBAg', 'HIV', 'syphilis'),
    array('Weight', 'bp_up', 'bp_down', 'hb'),
    array('HCV_elisa', 'HBsAg_elisa', 'HIV_elisa', 'observation'),
    array('date')
);

$columnWidth = 45;
$rowHeight = 10;

// Set the footer
$pdf->SetY(10);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->SetTextColor(0);
$pdf->Cell(0, 5, 'Downloaded from: https://elifesaver.online', 0, 0, 'C');

// Move to the next line
$pdf->Ln();

// Print the table rows
foreach ($data['results'] as $index => $result) {
    foreach ($headers as $header) {
        // Display the heading row
        $pdf->SetFont('helvetica', 'B', 12);
        foreach ($header as $col) {
            $pdf->Cell($columnWidth, $rowHeight, $col, 1, 0, 'C', true);
        }
        $pdf->Ln();

        // Display the data row
        $pdf->SetFont('helvetica', '', 10);
        foreach ($header as $col) {
            if ($col === 'Weight') {
                $value = isset($result['weight']) ? $result['weight'] : '';
            } else {
                $value = isset($result[$col]) ? $result[$col] : '';
            }
            $pdf->Cell($columnWidth, $rowHeight, $value, 1, 0, 'C');
        }
        $pdf->Ln();
    }
}

// Output the PDF to the browser
$pdf->Output('result.pdf', 'D');