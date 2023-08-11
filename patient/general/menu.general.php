<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - <?php echo ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?></title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/main.css" />
    <script src="./js/script.js" defer></script>

  </head>
  <body>
    <div>
      <div class="sidebar full-sidebar" id="sidebar">
        <div class="logo">
          <img src="./images/20230706_202613.png" alt="" />
          <div class="flex-row">
            <div>Menu</div>
            <div id="sidebar-close" class="none-icon">
              <i class="fa-solid fa-xmark"></i>
            </div>
          </div>
        </div>
        <div>
          <ul>
            <li class="list-item">
              <a href="./dashboard.php"
                ><i class="fa-solid fa-gauge"></i> Dashboard</a
              >
            </li>
            <li class="list-item">
              <a href="./bloodAppeal.php"
                ><i class="fa-solid fa-location-dot"></i>Blood Appeal</a
              >
            </li>
            <li class="list-item">
              <a href="./notification.php"
                ><i class="fa-solid fa-bell"></i> Notification</a
              >
            </li>
            <li class="list-item">
              <a href="./becomeADonor.php"
                ><i class="fa-solid fa-user"></i> Become a Donor</a
              >
            </li>
          </ul>
        </div>
        <div class="logout"><a href="../includes/logout.php">
            <i class="fa-sharp fa-solid fa-right-from-bracket"></i>&nbspLogout</a>
        </div>
      </div>
      <main class="full main">
        <header>
          <nav class="flex-row">
            <div id="sidebar-open"><i class="fa-solid fa-bars"></i></div>
            <div>
              <p><?php echo ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?></p>
            </div>
            <div>
              <ul>
                <li class="name">
                <a href="./bloodAppeal.php"><i class="fa-sharp fa-solid fa-droplet"></i></a>
                </li>
                <li class="name"><a href="./notification.php"><i class="fa-solid fa-bell"></i></a></li>
                  
              </ul>
            </div>
          </nav>
        </header>