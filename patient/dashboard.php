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
      $_SESSION['phone'] = $_COOKIE['phone'];
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
          </div>
          <?php
            if (empty($blood_appeals)) {
      echo '<div>
              <div class="flex-row notification">
                <div><h5>No Blood Appeal Created</h5></div>
                <div class="data-time">
                  <p>None</p>
                </div>
              </div>
            </div>';
    } else {
      // Define the maximum number of notifications to display
      $maxNotifications = 4;
      $notificationCount = 0;

      foreach ($blood_appeals as $blood_appeal) {
        if ($notificationCount >= $maxNotifications) {
          break; // Break the loop if the maximum number of notifications is reached
        }
        
        echo '
          <div>
            <div class="flex-row notification">
              <div><h5>'.$blood_appeal['number_of_bags'].' bag(s) of Blood Group '.$blood_appeal["blood_group"].' requested... at '.$blood_appeal['health_facility'].'</h5></div>
              <div class="data-time">
                <p>'.date("h:i A", strtotime($blood_appeal["creation_date"])).'</p>
                <p>'.date("Y-m-d", strtotime($blood_appeal["creation_date"])).'</p>
                <p>Status: '.$blood_appeal["status"].'</p>
              </div>
            </div>
          </div>
        ';

        $notificationCount++; // Increment the notification count
      }

      // Check if there are additional notifications beyond the displayed ones
      $remainingNotifications = count($blood_appeals) - $notificationCount;
      if ($remainingNotifications > 0) {
        echo '
          <div class="show-more-btn">
            <button class="btn" id="showMoreBtn">Show '.$remainingNotifications.' More</button>
          </div>
          <div id="hiddenNotifications" style="display: none;">
        ';

        // Display the remaining notifications initially hidden
        for ($i = $notificationCount; $i < count($blood_appeals); $i++) {
          $blood_appeal = $blood_appeals[$i];
          echo '
            <div>
              <div class="flex-row notification">
                <div><h5>'.$blood_appeal['number_of_bags'].' bag(s) of Blood Group '.$blood_appeal["blood_group"].' requested... at '.$blood_appeal['health_facility'].'</h5></div>
                <div class="data-time">
                  <p>'.date("h:i A", strtotime($blood_appeal["creation_date"])).'</p>
                  <p>'.date("Y-m-d", strtotime($blood_appeal["creation_date"])).'</p>
                  <p>Status: '.$blood_appeal["status"].'</p>
                </div>
              </div>
            </div>
          ';
        }

        echo '</div><br>';
      }
    }
    
          ?>
          
          
          <div class="results-btn"><a href="bloodAppeal.php"> <button class="btn">New Appeal</button></a></div>
        </section>
      </main>
    </div>

    <!-- <script src="./script.js"></script> -->
    <script>
  // JavaScript code to handle the "Show More" functionality
  const showMoreBtn = document.getElementById('showMoreBtn');
  const hiddenNotifications = document.getElementById('hiddenNotifications');

  showMoreBtn.addEventListener('click', function () {
    hiddenNotifications.style.display = 'block';
    showMoreBtn.style.display= 'none';
  });
</script>
  </body>
</html>