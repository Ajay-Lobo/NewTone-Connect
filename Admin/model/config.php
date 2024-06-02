<?php

define('DB_HOST', 'localhost'); // Database server hostname
define('DB_USER', 'root'); // Database username
define('DB_PASS', ''); // Database password
define('DB_NAME', 'newtone'); // Database name


$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4 for proper Unicode support
if (!$conn->set_charset("utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", $conn->error);
    exit();

$update_query = "UPDATE events SET iscompleted = 1 WHERE event_date < CURDATE()";
if ($conn->query($update_query) === TRUE) {
    echo "iscomplete column updated successfully";
} else {
    echo "Error updating iscomplete column: " . $conn->error;
}
}
?>
