<?php
$servername = "localhost";
$username = "root";
<<<<<<< Updated upstream
$password = "preetha";
$database = "course_registration";
=======
$password = "Rmin!03007";
$database = "course_reg";
>>>>>>> Stashed changes

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

