<?php
session_start();
  include_once('./general/menu.general.php');
?>

<?php
// include the BloodAppeal class file
    require_once ('../classes/result.class.php');
    require_once ('../classes/donor.class.php'); 
    
    
    $donor = Donor::getDonorById($_SESSION['id']);
    $btsNumber = $donor->bts_number;
    
$endpoint = 'https://elifesaver.online/includes/get_all_donor_results.inc.php';


$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "$endpoint?bts_number=$btsNumber",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
    ]
]);

$response = curl_exec($curl);

if ($response === false) {
    $error = curl_error($curl);
    echo "cURL Error: $error";
} else {
    $data = json_decode($response, true);
}

curl_close($curl);

?>
              <section>
                
                <?php
                    
                    if(!$data['success']){
                        echo '
                            <div class="flex-row">
                                <h3 class="name">'.$data['error'].'</h3>
                                <h4>Do tests to get your results</h4>
                            </div>
                        ';
                    }
                    else{
                        echo '
                            <div class="flex-row">
                                <h3 class="name">Blood Donors Test Results</h3>
                                <h4>Last Date of Test '.date('d/m/Y H:i', strtotime(end($data['results'])['date'])).'</h4>
                            </div>
                            <!--<table class="table table-borderless">
                            <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                      </tr>
                                    </tbody>
                            </table>-->
                          </section>
                          <section>
                        <h3 class="name">Serology: Predonation: RDT</h3>
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">HCV</th>
                                <th scope="col">HBAg</th>
                                <th scope="col">HIV</th>
                                <th scope="col">syphilis</th>
                                <th scope="col">Weight</th>
                                <th scope="col">bp_up</th>
                                <th scope="col">bp_down</th>
                                <th scope="col">hb</th>
                                <th scope="col">HCV_elisa</th>
                                <th scope="col">HBsAg_elisa</th>
                                <th scope="col">HIV_elisa</th>
                                <th scope="col">observation</th>
                                <th scope="col">date</th>
                              </tr>
                        </thead>
                            <tbody>
                              
                            
                        ';
                        
                        foreach($data['results'] as $result){
                            echo '
                            <tr>
                                <td>'.$result['HCV'].'</td>
                                <td>'.$result['HBAg'].'</td>
                                <td>'.$result['HIV'].'</td>
                                <td>'.$result['syphilis'].'</td>
                                <td>'.$result['weight'].'</td>
                                <td>'.$result['bp_up'].'</td>
                                <td>'.$result['bp_down'].'</td>
                                <td>'.$result['hb'].'</td>
                                <td>'.$result['HCV_elisa'].'</td>
                                <td>'.$result['HBsAg_elisa'].'</td>
                                <td>'.$result['HIV_elisa'].'</td>
                                <td>'.$result['observation'].'</td>
                                <td>'.date("h:i A", strtotime($result['date'])).'</td>
                              </tr>
                            ';
                        }
                        echo '</tbody>
                        </table>
                        <div class="download-button">
        <button class="download-btn" id="downloadButton">Download</button>
    </div>
                    </section>';
                    }
                
                ?>
                
            
                    
        </main>
    </div>

    <script>
        function downloadPDF() {
            window.location.href = 'result_pdf.php';
        }
        // Get the button element
        var downloadButton = document.getElementById('downloadButton');

        // Add event listener to the button
        downloadButton.addEventListener('click', downloadPDF);
    </script>

 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
