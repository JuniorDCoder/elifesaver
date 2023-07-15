
<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/main.css">
  </head>
  <body>
    <div>
        <div class="sidebar full-sidebar" id="sidebar">
          <div class="logo"><img src="../images/20230706_202613.png" alt="">
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
              <li class="list-item">
                <a href="./bloodRequest.php"><i class="fa-sharp fa-solid fa-droplet"></i> Blood Requests</a>
              </li>
              <li class="list-item">
                <a href="./bloodAppeal.php"><i class="fa-solid fa-location-dot"></i>Blood Appeal</a>
              </li>
              <li class="list-item">
                <a href="#"><i class="fa-solid fa-bell"></i> Notification</a>
              </li>
              <li class="list-item">
                <a href="./vaccines.php"><i class="fa-solid fa-syringe"></i></i> Vaccines</a>
              </li>
              <li class="list-item">
                <a href="#"><i class="fa-solid fa-user"></i> My Account</a>
              </li>
            </ul>
          </div>
          <div class="logout"><a href="../includes/logout.php"><i class="fa-sharp fa-solid fa-right-from-bracket"></i>&nbsp&nbsp Logout</a></div>
        </div>
        <main class="menu-content full">
            <header>
                <nav class="flex-row">
                    <div id="sidebar-open"><i class="fa-solid fa-bars"></i></div>
                    <div>
                        <p>Profile</p>
                    </div>
                    <div>
                        <ul>
                            <li class="name"><i class="fa-sharp fa-solid fa-droplet"></i></li>
                            <li class="name"><i class="fa-solid fa-bell"></i></li>
                            <li><img src="../images/Ellipse 2.png" alt=""><span> 1500 <br> Credits</span></li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="-row">
              
              <section class="form-container">
                  <div>
                    <form action="">
                      <div>
                          <label for="">Name</label>
                        <input type="text" placeholder="Nsom Emmanuel" />
                      </div>
                      <div>
                          <label for="">Email</label>
          
                        <input type="email" placeholder="nsomemmunuel@gmail.com" />
                      </div>
                      <div>
                          <label for="">Phone Number</label>
          
                        <input type="number" placeholder="+237 672 76 78 93" />
                      </div>
                      <div>
                          <label for=""> City</label>
                          <input type="text" placeholder="Bamenda" />
                      </div>
                      <div>
                          <label for="">Address</label>
                          <input type="text" placeholder="Up-Station" />
                      </div>
                      
                      <div>
                          <label for="">Password</label>
                        <input type="password" placeholder="num@2023#" />
                      </div>
                      <div>
                        <button class="btn">Update</button>
                      </div>
                    </form>
                  </div>
              </section>
            </div>
        </main>
    </div>

    <script src="./script.js"></script>
  </body>
</html>
