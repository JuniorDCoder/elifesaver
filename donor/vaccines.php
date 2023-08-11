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

?>
    

<?php
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
  
  // Use the $responseData to display the data in the frontend

include_once('./general/menu.general.php');
//include('../classes/db_connect.class.php');
include('../classes/donor.class.php');
  ?>
  

<section>
    <div class="flex-row">
        <h3 class="name">Blood Donors Test Results</h3>
        <?php
        // Display the date of the last donation
        if (isset($status_responses) && !empty($status_responses)) {
            $lastDonationDate = end($status_responses)['dose_date'];
            echo "<h4>Date of Donation: $lastDonationDate</h4>";
        } else {
            echo "<h4>No Donation</h4>";
        }
        ?>
    </div>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th scope="col">1<sup>st</sup> Dose</th>
                <th scope="col">2<sup>nd</sup> Dose</th>
                <th scope="col">3<sup>rd</sup> Dose</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                // Display the dates of the last three doses
                if (isset($status_responses) && !empty($status_responses)) {
                    $lastThreeDoses = array_slice($status_responses, -3);
                    foreach ($lastThreeDoses as $dose) {
                        echo "<td>$dose[dose_date]</td>";
                    }
                } else {
                    echo "<td>No Dose</td>";
                    echo "<td>No Dose</td>";
                    echo "<td>No Dose</td>";
                }
                ?>
            </tr>
        </tbody>
    </table>
    <div class="download-button">
        <button class="download-btn" id="downloadButton">Download</button>
    </div>
</section>

<section>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Vaccine Name</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display the vaccine names and their statuses
            if (isset($vaccine_responses) && !empty($vaccine_responses)) {
                foreach ($vaccine_responses as $vaccine) {
                    echo "<tr>";
                    echo "<td>$vaccine[vaccine_name]</td>";
                    echo "<td>$vaccine[status]</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td colspan='2'>No Vaccines Taken</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</section>
        </main>
    </div>
    <script>
        function downloadPDF() {
            window.location.href = 'generate_pdf.php';
        }
        // Get the button element
        var downloadButton = document.getElementById('downloadButton');

        // Add event listener to the button
        downloadButton.addEventListener('click', downloadPDF);
    </script>

    <!-- add bootstrap 5 js file -->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<!--//add bundel js -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src=".js/script.js"></script>
  </body>
</html>
