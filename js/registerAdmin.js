const registerForm = document.querySelector('#register-form');
registerForm.addEventListener('submit', event => {
    event.preventDefault(); // prevent the default form submission behavior

    // Get the admin's entered registration data
    const formData = new FormData(registerForm);
    const name = formData.get('name');
    const email = formData.get('email');    
    const password = formData.get('password');
        

    // Send a POST request to the register API endpoint with the admin's registration data
    fetch('https://2721-102-244-155-9.ngrok-free.app/E%20Life%20Saver/includes/registerAdmin.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const userType = data.type;
            const userName = data.admin[userType + '_name'];
            const userEmail = data.admin['email'];
        
            // Set the session variables using localStorage
            localStorage.setItem('type', userType);
            localStorage.setItem('name', userName);
            localStorage.setItem('email', userEmail);
            
            // If registration is successful, redirect the admin to the dashboard page
            window.location.href = `index.php?type=${userType}&email=${userEmail}&name=${userName}`;
        } else {
            // If authentication fails, display an error message
            alert(data.error);
        }
    })
    .catch(error => {
        alert('Error:', error);
    });
});