const registerForm = document.querySelector('#register-form');
registerForm.addEventListener('submit', event => {
    event.preventDefault(); // prevent the default form submission behavior

    // Get the user's entered registration data
    const formData = new FormData(registerForm);
    const name = formData.get('name');
    const gender = formData.get('gender');
    const email = formData.get('email');    
    const password = formData.get('password');
    const confirm_password = formData.get('confirm_password');
    const phone_number = formData.get('phone_number');
    const address = formData.get('address');
    const city = formData.get('city');
    const blood_group = formData.get('blood_group');

    

    // Send a POST request to the register API endpoint with the user's registration data
    fetch('http://localhost:80/elifesaver/includes/registerDonor.inc.php', {
        method: 'POST',
        body: formData
    })
    
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // If registration is successful, redirect the user to the dashboard page

            const id = data.user.id;
            const userType = data.type;
            const userName = data.user[userType + '_name'];
            const userEmail = data.user['email'];

            // Set the session variables as cookies
            document.cookie = `id=${id}; path=/`;
            document.cookie = `type=${userType}; path=/`;
            document.cookie = `name=${userName}; path=/`;
            document.cookie = `email=${userEmail}; path=/`;

            window.location.href = './dashboard.php';
        } else {
            // If authentication fails, display an error message
            alert(data.error);
        }
    })
    .catch(error => {
        alert('Error:', error);
    });
});