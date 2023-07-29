<?php
session_start();
include_once('general/menu.general.php');
?>

<?php
    // include the BloodAppeal class file
    require_once ('../classes/blood_appeal.class.php');
    require_once ('../classes/donor.class.php'); 
    
    
    $donor = Donor::getDonorById($_SESSION['id']);
    
    $blood_appeals = BloodAppeal::getAllForBloodGroup($donor->blood_group);
?>
        <section>
            <?php
                if(empty($blood_appeals)){
                echo'<div>
                    <div class="flex-row no-notification notification">
                      <div><span>No new Notification</span></div>
                      <div class="name"><i class="fa-solid fa-xmark"></i></div>
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
                        </div>';
                }
            }
        ?>
          
        </section>
      </main>
    </div>

    // add bootstrap 5 js file
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    //add bundel js
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./script.js"></script>
  </body>
</html>
