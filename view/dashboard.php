<?php
// Start the session
session_start();

// Check if the required session variables are set
if (!isset($_SESSION['type']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    // If the session variables are not set, check if the localStorage variables are set
    if (!isset($_COOKIE['type']) || !isset($_COOKIE['name']) || !isset($_COOKIE['email'])) {
        // If the localStorage variables are not set, redirect the user to the login page
        header('Location: login.php');
        exit();
    } else {
        // If the localStorage variables are set, set the session variables from the localStorage variables
        $_SESSION['type'] = $_COOKIE['type'];
        $_SESSION['name'] = $_COOKIE['name'];
        $_SESSION['email'] = $_COOKIE['email'];
    }
}

// Get the session variables
$userType = $_SESSION['type'];
$userName = $_SESSION['name'];
$userEmail = $_SESSION['email'];
include_once('./general/menu.general.php');
?>
        <section>
              
                <div >
                    <p>Hello <span id="welcome-message" class="name"><?php echo $userName; ?></span>
                    </p>
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
            </section>
        </main>
    </div>
  </body>
</html>
