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

include('../classes/db_connect.class.php');

include('../classes/donor.class.php');
include('../classes/credit.class.php');
                          


$bts_number = Donor::getDonorById($_SESSION['id'])->bts_number;
$_SESSION['bts_number'] = $bts_number;
$credit= Credit::getCredit($_SESSION['bts_number']);

include('./general/menu.general.php');
?>
        <section>
              
                <div >
                    <p>Hello <span id="welcome-message" class="name"><?php echo $userName; ?></span>
                    <p>BTS Number: <span id="welcome-message" class="name"><?php echo $_SESSION['bts_number']; ?></span>
                    </p>
                </div>
                <div class="donation-cards">
                    <div class="donation-card">
                        <span class="name">Last Donation</span>
                        <p>05/06/2023</p>
                        <p>Location: Bamenda Regional Hospital</p>
                        <div class="card-btn">
                            <button class="btn model-open">Learn More</button>
                        </div>
                    </div>
                    <div class="donation-card">
                        <span class="name">Next Donation</span>
                        <p>05/06/2023</p>
                        <p>Location: Bamenda Regional Hospital</p>
                        <div class="card-btn">
                            <button class="btn model-open2">Learn More</button>
                        </div>
                    </div>
                </div>
                <div class="results-btn"><a href="results.php"> <button class="btn">Results</button></a></div>
            </section>
        </main>
    </div>
    <section class="model show-model">
  <div class="model-container">
    <div class="model-header flex-row">
      <div class="model-title"></div>
      <div class="model-close"><i class="fa-solid fa-xmark"></i></div>
    </div>
    <div class="alert-icon"><i class="fa-regular fa-bell"></i></div>
    <p>
      05/06/2023
    <br>
    <b>Location: </b>Bamenda Regional Hospital
    <br>
    <b>Reaction: </b>Donation successful
    <br>
    <i>Thank you for donating</i>
    <br>
    <b>Type: </b>voluntary, replacement or appeal
  </p>
  </div>
</section>
<section class="model2 show-model2">
  <div class="model-container">
    <div class="model-header flex-row">
      <div class="model-title"></div>
      <div class="model-close2"><i class="fa-solid fa-xmark"></i></div>
    </div>
    <div class="alert-icon"><i class="fa-regular fa-bell"></i></div>
    <p>

      After donating you need to wait for up to 4 months before you can donate again.
      See you soon.
      <br>
      <i>Life saver😊✌🏽</i>
      
    </p>
  </div>
</section>
  </body>
</html>
