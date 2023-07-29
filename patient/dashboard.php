<?php
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

include_once('general/menu.general.php');
?>

        <!-- <section>
          <div>
            <p>Hello <span class="name">Emmanuel!</span></p>
          </div>
          <div class="donation-cards">
            <div class="donation-card">
              <span class="name">Last Donation</span>
              <p>05/06/2023</p>
              <p>Location: Bamenda Regional Hospital</p>
              <div class="card-btn">
                <button class="btn">Learn More</button>
              </div>
            </div>
            <div class="donation-card">
              <span class="name">Next Donation</span>
              <p>05/06/2023</p>
              <p>Location: Bamenda Regional Hospital</p>
              <div class="card-btn">
                <button class="btn">Learn More</button>
              </div>
            </div>
          </div>
          <div class="results-btn"><button class="btn">Results</button></div>
        </section> -->
        
            <?php
                $patient_id = $_SESSION['id']; // get patient ID from session
                
                // include the BloodAppeal class file
                require_once ('../classes/blood_appeal.class.php');
                
                // call the getAllForPatient method to get all blood appeal records for the patient
                $blood_appeals = BloodAppeal::getAllForPatient($patient_id);
            ?>
        <section>
          <div class="info">
            <p>Name: <?php echo $userName;?></p>
            <p>Location: Bamenda</p>
            <p>Blood Group: AB+</p>
          </div>
          <?php
            if(empty($blood_appeals)){
                echo'<div>
                <div class="flex-row notification">
                  <div><h5>No Blood Appeal Created</h5></div>
                  <div class="data-time">
                    <p>None</p>
                  </div>
                </div>
              </div>';
            }
            else{
                foreach ($blood_appeals as $blood_appeal) {
                    echo '
                        <div>
                            <div class="flex-row notification">
                              <div><h5>'.$blood_appeal['number_of_bags'].' bag(s) of Blood Group '.$blood_appeal["blood_group"].' requested... at '.$blood_appeal['health_facility'].'</h5></div>
                              <div class="data-time">
                                <p>'.date("h:i A",strtotime($blood_appeal["creation_date"])).'</p>
                                <p>'.date("Y-m-d",strtotime($blood_appeal["creation_date"])).'</p>
                                <p>Status: '.$blood_appeal["status"].'</p>
                              </div>
                            </div>
                          </div>
                    ';
                }    
            }
          ?>
          
          <div class="results-btn"><button class="btn">New Appeal</button></div>
        </section>
      </main>
    </div>

    <!-- <script src="./script.js"></script> -->
  </body>
</html>