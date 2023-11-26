<?php

// Connect to Database
require_once 'db_connection.php';


 // Check the file size
 $maxFileSize = 5 * 1024 * 1024; // 5 MB in bytes

 if ($_FILES['image']['size'] > $maxFileSize) {
     echo json_encode(['success' => false, 'error' => 'File size exceeds the allowed limit.']);
     exit;
 }

// File upload handling
$targetDirectory = dirname(__FILE__) . '/resources/';
$targetFileName = uniqid() . '_' . basename($_FILES['image']['name']);
$targetPath = $targetDirectory . $targetFileName;
move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);

// Sanitize user input
$name = mysqli_real_escape_string($conn, $_POST['name']);
$country = mysqli_real_escape_string($conn, $_POST['country']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$averageCost = $_POST['average_cost'];
$filePath = './resources/' . $targetFileName;
$description = mysqli_real_escape_string($conn, $_POST['description']);

// Insert data into the database
$sql = "INSERT INTO destination (`country_id`, `destination_name`, `city`, `average_cost`, `file_path`, `description`, `deleted`) VALUES ('$country', '$name', '$city', $averageCost, '$filePath', '$description', 0)";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} 
else {
    error_log("SQL Query: " . $sql);
    error_log("MySQL Error: " . $conn->error);

    echo json_encode(['success' => false, 'error' => $conn->error]);
}
$conn->close();

?>
