// Get the login form and add an event listener for when it's submitted
const loginForm = document.querySelector('#login-form');
loginForm.addEventListener('submit', event => {
    event.preventDefault(); // prevent the default form submission behavior

    // Get the user's entered credentials
    const formData = new FormData(loginForm);
    const email = formData.get('email');
    const password = formData.get('password');

    // Send a POST request to the login API endpoint with the user's credentials
    fetch('https://5ac6-102-244-155-96.ngrok-free.app/E%20Life%20Saver/includes/login.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // If authentication is successful, redirect the user to their dashboard
            window.location.href = 'dashboard.php';
        } else {
            // If authentication fails, display an error message
            alert('Invalid email or password');
        }
    })
    .catch(error => {
        alert('Error:', error);
    });
});