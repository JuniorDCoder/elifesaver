const registerForm = document.querySelector('#register-form');
registerForm.addEventListener('submit', event => {
    event.preventDefault(); // prevent the default form submission behavior

    // Get the user's entered registration data
    const formData = new FormData(registerForm);
    const name = formData.get('name');
    const gender = formData.get('gender');
    const password = formData.get('password');
    const confirm_password = formData.get('confirm_password');
    const email = formData.get('email');    
    const phone_number = formData.get('phone');

    

    // Send a POST request to the register API endpoint with the user's registration data
    fetch('https://c7cf-102-244-155-63.ngrok-free.app/E%20Life%20Saver/includes/registerPatient.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // If registration is successful, redirect the user to the dashboard page

            const userType = data.type;
            const userName = data.user[userType + '_name'];
            const userEmail = data.user['email'];

            // Set the session variables as cookies
            document.cookie = `type=${userType}; path=/`;
            document.cookie = `name=${userName}; path=/`;
            document.cookie = `email=${userEmail}; path=/`;

            window.location.href = 'dashboard.php';
        } else {
            // If authentication fails, display an error message
            alert(data.error);
        }
    })
    .catch(error => {
        alert('Error:', error);
    });
});