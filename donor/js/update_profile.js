// Get the form element
const form = document.getElementById('donor-form');

// Listen for the form submit event
form.addEventListener('submit', event => {
  // Prevent the default form submission behavior
  event.preventDefault();

  // Get the form data
  const formData = new FormData(form);

  // Check if the password field is empty
  const password = formData.get('password').trim();
  if (!password) {
    formData.set('password', ''); // Set the password parameter to an empty string
  }

  // Send an AJAX request to the API
  fetch('http://localhost:80/elifesaver/donor/includes/update_donor.inc.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Display a success message
      alert('Your update was successful!');
      
      
      // Refresh the dashboard page
      location.reload();
    } else {
      // Display an error message
      alert(data.error);
    }
  })
  .catch(error => {
    // Display an error message
    alert(error.error);
  });
});