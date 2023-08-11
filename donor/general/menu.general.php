<?php
// Start the session
//session_start();

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
//$bts_number = $_SESSION['bts_number'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - <?php echo ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/main.css">
      <script src="./js/script.js" defer></script>
  </head>
  <body>
      <div>
        <div class="sidebar full-sidebar" id="sidebar">
            <div class="logo"><img src="images/20230706_202613.png" alt="">
              <div class="flex-row">
                  <div>Menu</div>
                  <div id="sidebar-close" class="none-icon"><i class="fa-solid fa-xmark "></i></div>
              </div>
          </div>
            <div>
              <ul>
                
                <li class="list-item">
                    
                    <a href="./dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                </li>
                <li class="list-item">
                  <a href="./results.php"><i class="fa-solid fa-clipboard"></i>Results </a>
                </li>
               <!-- <li class="list-item">
                  <a href="./bloodReqest.php"><i class="fa-sharp fa-solid fa-droplet"></i> Blood Requests</a>
                </li> -->
                <li class="list-item">
                  <a href="./bloodAppeal.php"><i class="fa-solid fa-location-dot"></i>Blood Appeal</a>
                </li>
                <li class="list-item">
                  <a href="./notification.php"><i class="fa-solid fa-bell"></i> Notification</a>
                </li>
                <li class="list-item">
                  <a href="./vaccines.php"><i class="fa-solid fa-syringe"></i></i> Vaccines</a>
                </li>
                <li class="list-item">
                  <a href="./profile.php"><i class="fa-solid fa-user"></i> My Account</a>
                </li>
              </ul>
            </div>
            <div class="logout"><a href="../includes/logout.php"><i class="fa-sharp fa-solid fa-right-from-bracket"></i>&nbsp&nbsp Logout</a></div>
        </div>
        <main class="main full">
              <header>
                  <nav class="flex-row">
                      <div id="sidebar-open"><i class="fa-solid fa-bars"></i></div>
                      <div>
                          <p><?php echo ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?></p>
                      </div>
                      <div>
                        <?php
                        global $credit;
                       
                        ?>
                          <ul>
                              <li class="name"><a href="bloodAppeal.php">  <i class="fa-sharp fa-solid fa-droplet" style="color:red"></a></i></li>
                              <li class="name"> <a href="notification.php" ><i class="fa-solid fa-bell" style="color:red"></i></a></li>
                              <li><img src="../images/Ellipse 2.png" alt=""><span> <?php if (is_null($credit)) {
                                echo 0;
                              }else {
                                echo $GLOBALS['credit'];
                              } ?> <br> Credits</span></li>
                          </ul>
                      </div>
                  </nav>
              </header>