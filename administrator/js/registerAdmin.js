const registerForm = document.querySelector('#register-form');
registerForm.addEventListener('submit', event => {
    event.preventDefault(); // prevent the default form submission behavior

    // Get the admin's entered registration data
    const formData = new FormData(registerForm);
    const name = formData.get('name');
    const email = formData.get('email');    
    const password = formData.get('password');
        

    // Send a POST request to the register API endpoint with the admin's registration data
    fetch('https://5208-102-244-155-27.ngrok-free.app/E%20Life%20Saver/includes/registerAdmin.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {

            const id = data.user.id;
            const userType = data.type;
            const userName = data.user[userType + '_name'];
            const userEmail = data.user['email'];

            // Set the session variables as cookies
            document.cookie = `id=${id}; path=/`;
            document.cookie = `type=${userType}; path=/`;
            document.cookie = `name=${userName}; path=/`;
            document.cookie = `email=${userEmail}; path=/`;

            //If Registration is successful, redirect to the admin dashboard
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