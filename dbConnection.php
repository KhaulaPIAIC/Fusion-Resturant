<?php
// Database credentials
$servername = "localhost";  // or your server IP
$username = "root";
$password = "root123";
$dbname = "Foodie";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";


?>
