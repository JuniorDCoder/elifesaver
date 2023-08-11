<?php
  session_start();
  include_once('general/menu.general.php');
?>
        <div class="grid-row">
          <section>
            <div><img src="./images/Blood test-amico 2.png" alt="" /></div>
          </section>
          <section class="form-container become-a-donor">
            <div>
              <form action="./includes/become_a_donor.inc.php" method="POST">
                <div class="flex-row">
                  <div>Gender:</div>
                  <div class="flex-row">
                    <input name="gender" type="radio" value="female" />
                    <label for="huey">Female</label>
                  </div>
                  <div class="flex-row">
                    <input name="gender" type="radio" value="male"/>
                    <label for="dewey">Male</label>
                  </div>
                </div>
               
                <div class="flex-row">
                  <select name="blood_group" type="text" id="" required>
                    <option value="">Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="AB-">AB-</option>
                    <option value="AB+">AB+</option>
                    <option value="">Don't Know</option>
                  </select>
                </div>

                <div>
                  <input type="text" name="city" placeholder="City" required/>
                </div>
                <div>
                  <input type="text" name="address" placeholder="Address" required/>
                </div>
                <div>
                  <input type="password" name="password" placeholder="Password"/>
                </div>
                
                <div>
                  <button class="btn" type="submit">Finish</button>
                </div>
              </form>
            </div>
          </section>
        </div>
      </main>
    </div>

    <!-- <script src="./script.js"></script> -->
    
  <?php

  ?>
  </body>
</html>
