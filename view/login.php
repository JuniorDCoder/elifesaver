<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../css/main.css" />
  </head>
  <body>
    <nav>
      <div>
        <img src="../images/elife_saver-removebg-preview 1.png" alt="" />
      </div>
    </nav>
    <main class="grid-row container">
      <section>
        <div><img src="../images/Blood test-pana 1.png" alt="" /></div>
      </section>
      <section class="form-container">
        <div>
          <h3>Login</h3>
          <p>Welcome back login to continue</p>
        </div>
        <div>
          <form id="login-form" action="../includes/login.inc.php" method="POST">
            <div>
              <input name="email" type="email" placeholder="Email" />
            </div>
            <div>
              <input name="password" type="password" placeholder="Password" />
            </div>
            <div>
              <button class="btn" type="submit">Login</button>
            </div>
          </form>
        </div>
        <div class="forgot">Forgot your password?</div>
        <div>Don’t have an account? <a href="./register.php">Register</a></div>
      </section>
    </main>
    <script src="../js/login.js"></script>
  </body>
</html>