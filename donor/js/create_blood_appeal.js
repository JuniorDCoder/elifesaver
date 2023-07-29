const bloodAppealForm = document.querySelector('#blood_appeal');
bloodAppealForm.addEventListener('submit', event =>{
    event.preventDefault(); //prevent default submission of the form
    
    //Get the form data
    
    const formData = new FormData(bloodAppealForm);
    
    const patient_id = formData.get('patient_id');
    const donor_id = formData.get('donor_id');
    const user_type = formData.get('user_type');
    const number_of_bags = formData.get('number_of_bags');
    const blood_group = formData.get('blood_group');
    const health_facility = formData.get('health_facility');
    const medical_info = formData.get('medical_info');
    
    
    // Define the data to be sent in the POST request
    
      
      fetch("https://elifesaver.online/includes/create_blood_appeal.inc.php",{
         method: 'POST',
         body: formData
      })
      .then(response => response.json())
      .then(data => {
          
          if (data.success) {
            alert("Blood appeal created successfully:");
            window.location.href = './bloodAppeal.php';
          } else {
            alert("Error creating blood appeal:", data.error);
          }
      })
      .catch(error => {
          alert("Error creating blood appeal:", error);
        });
      
      
});