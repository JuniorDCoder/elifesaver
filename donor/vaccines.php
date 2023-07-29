<?php
session_start();
  include_once('./general/menu.general.php');
 
 ?> <?php
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

// Get the status of yellow fever
$query ="SELECT status From vaccine_status WHERE vaccine_id = 1";
$result = $conn->query($query);
$yellow_fever_status="";
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $yellow_fever_status = $row["status"];
}
// Get the status of covid19
$query ="SELECT status From vaccine_status WHERE vaccine_id = 2";
$result = $conn->query($query);
$covid_19_status="";
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $covid_19_status = $row["status"];
}
// Close the database connection
$conn->close();

    ?>
              <section>
                <div class="flex-row">
                    <h3 class="name">Blood Donors Test Results</h3>
                    <h4>Date of Donation 23/07/2023</h4>
                </div>
                <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">1 <sup>st</sup> Dose</th>
                        <th scope="col">2 <sup>nd</sup> Dose</th>
                        <th scope="col">3 <sup>rd</sup> Dose</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                       <td><?php echo $first_dose_date; ?></td>
                       <td><?php echo $second_dose_date; ?></td>
                       <td><?php echo $third_dose_date; ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="download-button">
                    <button class="download-btn">Download</button>
                  </div>
              </section>
            <section>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Vaccine Name</th>
                        <th scope="col">Status</th>
                      </tr>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Yellow Fever</td>
                         <td><?php echo $yellow_fever_status; ?></td>
                      </tr>
                      <tr>
                        <td>Covid-19</td>
                        <td><?php echo $covid_19_status; ?></td>
                      </tr>
                      <!--<tr>
                        <td>HIV</td>
                        <td>Not Taken</td>
                      </tr>
                      <tr>
                        <td>STD's</td>
                        <td>Not Taken</td>
                      </tr>-->
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    // add bootstrap 5 js file
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

//add bundel js
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src=".js/script.js"></script>
  </body>
</html>
