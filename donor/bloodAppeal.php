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
include_once('./general/menu.general.php');
?>
              <div class="grid-row">
                  <section>
                    <center>
                    <h3>
                        Make a new blood appeal</h3>
                        <p>Fill the form below to send a blood appeal request</p>
                    </center> 
                    <div><img src="./images/Blood donation-pana 1.png" alt="" />
                    </div>
                    </section>
                  <section class="form-container">
                    <div>
                      <form id="blood_appeal" action="../includes/create_blood_appeal.inc.php" method="POST">
                        <!-- <div>
                          <input type="number of Bags" placeholder="Email" />
                        </div> -->
                        <input name="patient_id" type="hidden" value="<?php echo null; ?>" />
                        <input name="user_type" type="hidden" value="<?php echo $_SESSION['type']; ?>" />
                        <input name="donor_id" type="hidden" value="<?php echo $_SESSION['id']; ?>" />
                        <div class="flex-row">
                            <div class="flex-row">
                              <div>Number of Bags:</div>
                            </div>
                            <input name="number_of_bags" type="number" id="" required>
                          </div>
                        

                        <div class="flex-row">
                        <select name="blood_group" id="">
                          <option value="">Select Blood Group</option>
                          <option value="A+">A+</option>
                          <option value="A-">A-</option>
                           <option value="B+">B+</option>
                          <option value="B-">B-</option>
                           <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                          <option value="O+">O+</option>
                          <option value="O-">O-</option>
                           <option value="dontknow">Dont know</option>
                        </select>
                          
                        </div>
                       
                        
                        <div> 
                        <?php
// Initialize variables
$host = "localhost";
$username = "root";
$password = "";
$database = "u944161398_e_life_saver";
//nu7DRg7MTMfyfNN

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Select the health facilities from the database
$query = "SELECT name FROM health_facilities";
$result = $conn->query($query);

// Create an array of options
$options = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $options[] = $row["name"];
  }
}

// Close the database connection
$conn->close();

// Display the options in an HTML select form
echo "<select name='health_facility'>";
foreach ($options as $option) {
  echo "<option value='$option'>$option</option>";
}
echo "</select>";
?>

                        </div>

                        <div>
                          <textarea name="medical_info" id="" rows="10" placeholder="Enter medical information"></textarea>
                        </div>
                        <div>
                          <button class="btn" type="submit">Finish</button>
                        </div>
                      </form>
                    </div>
                  </section>
              </div>
        </main>
    </div>

    <script src="./js/create_blood_appeal.js"></script>
  </body>
</html>
