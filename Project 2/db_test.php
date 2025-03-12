<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "your_database"; // Change to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully!";
}

$conn->close();
?>
