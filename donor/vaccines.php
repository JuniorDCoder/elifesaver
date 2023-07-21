<?php
session_start();
  include_once('./general/menu.general.php');
?>
              <section>
                <div class="flex-row">
                    <h3 class="name">Blood Donors Test Results</h3>
                    <h4>Date of Donation 23/07/2023</h4>
                </div>
                <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">1 <sup>st</sup> Dose</th>
                        <th scope="col">2 <sup>nd</sup> Dose</th>
                        <th scope="col">3 <sup>rd</sup> Dose</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>06/05/2023</td>
                        <td>Not taken</td>
                        <td>Not taken</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="download-button">
                    <button class="download-btn">Download</button>
                  </div>
              </section>
            <section>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Vaccine Name</th>
                        <th scope="col">Status</th>
                      </tr>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Yellow Fever</td>
                        <td> Taken</td>
                      </tr>
                      <tr>
                        <td>Covid-19</td>
                        <td>Not Taken</td>
                      </tr>
                      <tr>
                        <td>HIV</td>
                        <td>Not Taken</td>
                      </tr>
                      <tr>
                        <td>STD's</td>
                        <td>Not Taken</td>
                      </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    // add bootstrap 5 js file
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

//add bundel js
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src=".js/script.js"></script>
  </body>
</html>
