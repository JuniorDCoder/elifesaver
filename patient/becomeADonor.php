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
              <form action="">
                <div class="flex-row">
                  <div>Gender:</div>
                  <div class="flex-row">
                    <input type="radio" />
                    <label for="huey">Female</label>
                  </div>
                  <div class="flex-row">
                    <input type="radio" />
                    <label for="dewey">Male</label>
                  </div>
                </div>
                <div>
                  <input type="date" placeholder="Date of Birth" />
                </div>
                <div class="flex-row">
                  <select name="Select " id="">
                    <option value="">Select Blood Group</option>
                  </select>
                  <select name="Select " id="">
                    <option value="">Select Blood Group</option>
                  </select>
                </div>

                <div>
                  <input type="text" placeholder="City" />
                </div>
                <div>
                  <input type="text" placeholder="Address" />
                </div>
                <div>
                  <button class="btn">Finish</button>
                </div>
              </form>
            </div>
          </section>
        </div>
      </main>
    </div>

    <!-- <script src="./script.js"></script> -->
  </body>
</html>
