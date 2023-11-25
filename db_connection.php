<?php
$host = "localhost";
$username = "root";
$password = "Leo@2567";
$database = "kutunzamawazo";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo $conn->connect_error;
    die("Connection failed: " . $conn->connect_error);
}
?>



