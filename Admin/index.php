<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../login.php");
    exit;
}
include('../components/navbar/index.php');

// Check if user is logged in
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = "User";
}
?>
<br>
<h1>Admin Dashboard</h1>
</body>
</html>
