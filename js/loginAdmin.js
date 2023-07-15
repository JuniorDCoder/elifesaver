const loginForm = document.querySelector('#formAuthentication');
loginForm.addEventListener('submit', event => {
    event.preventDefault(); // prevent the default form submission behavior

    // Get the user's entered credentials
    const formData = new FormData(loginForm);
    const email = formData.get('email');
    const password = formData.get('password');

    // Send a POST request to the login API endpoint with the user's credentials
    fetch('https://2721-102-244-155-9.ngrok-free.app/E%20Life%20Saver/includes/login.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // If authentication is successful, set the session variables and redirect the user to their dashboard
            const userType = data.type;
            const userName = data.user[userType + '_name'];
            const userEmail = data.user['email'];
        
            // Set the session variables as cookies
            document.cookie = `type=${userType}; path=/`;
            document.cookie = `name=${userName}; path=/`;
            document.cookie = `email=${userEmail}; path=/`;
            
            // Redirect the user to the dashboard
            window.location.href = 'dashboard.php';
        } else {
            // If authentication fails, display an error message
            alert(data.error);
        }
    })
    .catch(error => {
        alert('Error:',error);
    });
});