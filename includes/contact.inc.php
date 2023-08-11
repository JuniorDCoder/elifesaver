<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Validate form data (perform necessary validations)
    $errors = array();

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Add more validations if needed

    if (empty($errors)) {
        // All form data is valid, proceed with further processing

        // Example: Send email with the form data
        $to = "contact@elifesaver.online";
        $subject = "New Contact Form Submission";
        $messageBody = "Name: $name\n";
        $messageBody .= "Email: $email\n";
        $messageBody .= "Phone: $phone\n";
        $messageBody .= "Message: $message\n";

        // Send the email
        if (mail($to, $subject, $messageBody)) {
            // Email sent successfully
            echo "<script>alert('Thank you for your message. We will get in touch with you soon');</script>";
            echo "<script>window.location.href = '../index.php#contact';</script>";
            exit; // Stop further execution
        } else {
            // Error in sending email
            echo "<script>alert('Oops! An error occurred while sending your message. Please try again later.');</script>";
            echo "<script>window.location.href = '../index.php#contact';</script>";
            exit; // Stop further execution
        }
    } else {
        // Validation errors occurred, display them to the user
        $errorMessage = implode("\\n", $errors);
        echo '<script>alert("'.$errorMessage.'");</script>';
        echo "<script>window.location.href = '../index.php#contact';</script>";
        exit; // Stop further execution
    }
} else {
    // Redirect or display an error message if accessed directly without submitting the form
    echo "Access denied.";
}
?>