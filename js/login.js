const loginForm = document.querySelector('#login-form');
loginForm.addEventListener('submit', event => {
    event.preventDefault(); // prevent the default form submission behavior

    // Get the user's entered credentials
    const formData = new FormData(loginForm);
    const email = formData.get('email');
    const password = formData.get('password');

    // Send a POST request to the login API endpoint with the user's credentials
    fetch('https://af25-41-202-207-144.ngrok-free.app/E%20Life%20Saver/includes/login.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // If authentication is successful, set the session variables and redirect the user to their dashboard
            
            const userType = data.type;
            const id = data.user.id;
            const userName = data.user[userType + '_name'];
            const userEmail = data.user['email'];
            
            if (userType == "admin") {
                //window.location.href = '../administrator/index.php'; 
                alert(`You are trying to login as a ${userType} via users portal. Proceed to elifesaver.online/administrator to login`);
                return;
            }
        
            // Set the session variables as cookies
            document.cookie = `id=${id}; path=/`;
            document.cookie = `type=${userType}; path=/`;
            document.cookie = `name=${userName}; path=/`;
            document.cookie = `email=${userEmail}; path=/`;
            
            // Redirect the user to the donor dashboard
            if (userType == 'donor') {
                window.location.href = '../donor/dashboard.php';
            }
            else {
                window.location.href = '../patient/dashboard.php';
            }
            
        } else {
            // If authentication fails, display an error message
            alert(data.error);
        }
    })
    .catch(error => {
        alert('Error:',error);
    });
});