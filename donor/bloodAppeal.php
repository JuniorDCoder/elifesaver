<?php
  session_start();
  include_once('./general/menu.general.php');
?>
              <div class="grid-row">
                  <section>
                    <center>
                    <h3>
                        Make a new blood appeal</h3>
                        <p>Fill the form below to send a blood appeal request</p>
                    </center> 
                    <div><img src="./images/Blood donation-pana 1.png" alt="" />
                    </div>
                    </section>
                  <section class="form-container">
                    <div>
                      <form action="">
                        <!-- <div>
                          <input type="number of Bags" placeholder="Email" />
                        </div> -->
                        <div class="flex-row">
                            <div class="flex-row">
                              <div>Number of Bags:</div>
                            </div>
                            <input type="number" name="" id="">
                          </div>
                        

                        <div class="flex-row">
                        <select name="blood_group" id="">
                          <option value="">Select Blood Group</option>
                          <option value="A+">A+</option>
                          <option value="A-">A-</option>
                          <option value="O-">O-</option>
                          <option value="O+">O+</option>
                          <option value="AB">AB</option>
                        </select>
                          
                        </div>
                        
                        <div>
                          <input type="text" placeholder="Hospital Location" />
                        </div>

                        <div>
                          <textarea name="" id="" rows="10" placeholder="Enter medical information"></textarea>
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
  </body>
</html>
