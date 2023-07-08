<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <div>
        <div class="sidebar full-sidebar">
          <div class="logo"><img src="../images/elife_saver-removebg-preview 1.png" alt="">
            <div class="flex-row">
                <div>Menu</div>
                <div><i class="fa-solid fa-xmark "></i></div>
            </div>
        </div>
          <div>
            <ul>
              <li class="list-item">
                <a href="#"><i class="fa-solid fa-gauge"></i> Dashboard</a>
              </li>
              <li class="list-item">
                <a href="#"><i class="fa-solid fa-clipboard"></i>Results </a>
              </li>
              <li class="list-item">
                <a href="#"><i class="fa-sharp fa-solid fa-droplet"></i> Blood Requests</a>
              </li>
              <li class="list-item">
                <a href="#"><i class="fa-solid fa-location-dot"></i>Blood Appeal</a>
              </li>
              <li class="list-item">
                <a href="#"><i class="fa-solid fa-bell"></i> Notification</a>
              </li>
              <li class="list-item">
                <a href="#"><i class="fa-solid fa-syringe"></i></i> Vaccines</a>
              </li>
              <li class="list-item">
                <a href="#"><i class="fa-solid fa-user"></i> My Account</a>
              </li>
            </ul>
          </div>
          <div class="logout"><i class="fa-sharp fa-solid fa-right-from-bracket"></i> Logout</div>
        </div>
        <main class="full">
            <header>
                <nav class="flex-row">
                    <div><i class="fa-solid fa-bars"></i></div>
                    <div>
                        <p>Dashboard</p>
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
            <section>
                <div >
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
            </section>
        </main>
    </div>
  </body>
</html>
