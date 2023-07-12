<?php
session_start();  
// Get the user type and name from the URL parameters
$userEmail = $_GET['email'];
$userName = $_GET['name'];
                
$_SESSION['name'] = $userName;
$_SESSION['email'] = $userEmail;


  include_once('./general/menu.general.php');
?>
            <section>
              
                <div >
                    <p>Hello <span id="welcome-message" class="name"><?php echo $_SESSION['name']; ?></span>
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
