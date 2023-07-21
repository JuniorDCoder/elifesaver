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
        <section>
          <div class="info">
            <p>Name: <?php echo $userName;?></p>
            <p>Location: Bamenda</p>
            <p>Blood Group: AB+</p>
          </div>
          <div>
            <div class="flex-row notification">
              <div><h5>Blood Group B+ needed...</h5></div>
              <div class="data-time">
                <p>7:35am</p>
                <p>02/06/2023</p>
              </div>
            </div>
          </div>

          <div>
            <div class="flex-row notification">
              <div><h5>Blood Group B+ needed...</h5></div>
              <div class="data-time">
                <p>7:35am</p>
                <p>02/06/2023</p>
              </div>
            </div>
          </div>

          <div>
            <div class="flex-row notification">
              <div><h5>Blood Group B+ needed...</h5></div>
              <div class="data-time">
                <p>7:35am</p>
                <p>02/06/2023</p>
              </div>
            </div>
          </div>
          <div class="results-btn"><button class="btn">New Appeal</button></div>
        </section>
      </main>
    </div>

    <!-- <script src="./script.js"></script> -->
  </body>
</html>
