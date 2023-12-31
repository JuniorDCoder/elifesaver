<?php
session_start();
include_once('general/menu.general.php');
?>
<?php
                $patient_id = $_SESSION['id']; // get patient ID from session
                
                // include the BloodAppeal class file
                require_once ('../classes/blood_appeal.class.php');
                
                // call the getAllForPatient method to get all blood appeal records for the patient
                $blood_appeals = BloodAppeal::getAllForPatient($patient_id);
            ?>
        <section>
          <?php
            if(empty($blood_appeals)){
                echo'<div>
                <div class="flex-row notification">
                  <div><h5>No Blood Appeal Created</h5></div>
                  <div class="data-time">
                    <p>None</p>
                  </div>
                </div>
              </div>';
            }
            else{
                foreach ($blood_appeals as $blood_appeal) {
                    echo '
                        <div>
                            <div class="flex-row notification">
                              <div><h5>'.$blood_appeal['number_of_bags'].' bag(s) of Blood Group '.$blood_appeal["blood_group"].' requested... at '.$blood_appeal['health_facility'].'</h5></div>
                              <div class="data-time">
                                <p>'.date("h:i A",strtotime($blood_appeal["creation_date"])).'</p>
                                <p>'.date("Y-m-d",strtotime($blood_appeal["creation_date"])).'</p>
                                <p>Status: '.$blood_appeal["status"].'</p>
                              </div>
                            </div>
                          </div>
                    ';
                }    
            }
          ?>
        </section>
      </main>
    </div>

   <!-- // add bootstrap 5 js file-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <!--//add bundel js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./script.js"></script>
  </body>
</html>
