<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Become a Donor</title>
    <link rel="stylesheet" href="css/main.css" />
  </head>
  <body>
    <nav>
      <div>
        <img src="images/elife_saver-removebg-preview 1.png" alt="" />
      </div>
    </nav>
    <main class="grid-row container">
      <section>
        <div><img src="images/Blood test-amico 2.png" alt="" /></div>
      </section>
      <section class="form-container">
        <div>
          <h3>Register</h3>
          <!-- <p>Welcome back login to continue</p> -->
        </div>
        <div>
          <form id="register-form" action="../includes/registerDonor.inc.php" method="POST">
            <div>
              <input type="text" name="name" placeholder="Name" />
            </div>
            <div>
              <input type="email" name="email" placeholder="Email" />
            </div>
            <div>
              <input type="text" name="phone" placeholder="Phone Number" />
            </div>
            <div class="flex-row">
              <div class="flex-row">
                <div>Gender:</div>
                <div class="flex-row">
                  <input type="radio" name="gender" value="female" />
                  <label for="huey">Female</label>
                </div>
                <div class="flex-row">
                  <input type="radio" name="gender" value="male" />
                  <label for="dewey">Male</label>
                </div>
              </div>
              
            </div>
            <div class="flex-row">
              <select name="blood_group" id="">
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="AB">B+</option>
                <option value="O-">B-</option>
                <option value="O+">AB+</option>
                <option value="AB">AB-</option> 
                <option value="O-">O-</option>
                <option value="O+">O+</option>
              </select>
            </div>
            <div class="flex-row">
              <input type="text" name="city" placeholder="City" />
              <input type="text" name="address" placeholder="Address" />
            </div>
            <div>
              <input type="password" name="password" placeholder="Password" />
            </div>
            <div>
              <input type="password" name="confirm_password" placeholder="Confirm Password" />
            </div>
            <div>
              <button class="btn" type="submit">Continue</button>
            </div>
          </form>
        </div>
        <div class="forgot">Forgot your password?</div>
        <div>Already have an account? <a href="../view/login.php">Login</a></div>
      </section>
    </main>
    <script src="./js/register.js"></script>
  </body>
</html>