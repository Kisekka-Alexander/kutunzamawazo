<?php
include 'config.php';

// Use $db_config variables as needed
$host = $db_config['host'];
$username = $db_config['username'];
$password = $db_config['password'];
$database = $db_config['database'];

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo $conn->connect_error;
    die("Connection failed: " . $conn->connect_error);
}
?>



