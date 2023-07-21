<?php
// Start the session
session_start();
if (!isset($_SESSION['type']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])){
  header('Location: index.php');
  exit();
}

?>

<!DOCTYPE html>
<html>

<head>
  <title> Sneat - Free Bootstrap 5 HTML Admin Template </title>
  <meta http-equiv="refresh" content="0; URL='https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/'" />
</head>

<body>
  <p>If you do not redirect please visit :
    https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/</p>
</body>

</html>