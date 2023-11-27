<?php

// Connect to Database
require_once 'db_connection.php';

// Check if image is modified
if (isset($_FILES['file'])) {

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
$description = mysqli_real_escape_string($conn, $_POST['description']);
$averageCost = $_POST['average_cost'];
$filePath = './resources/' . $targetFileName;
$destinationId =  $_POST['destination_id'];

// Update data in the database
$updateQuery = "UPDATE destination SET country_id=?, destination_name=?, city=?, average_cost=?, file_path=?, description=? WHERE id = ?";
    
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("i",$country, $country, $name, $city, $averageCost, $filePath, $description, $destinationId);

if ($stmt->execute()) {
    // Redirect to destinations list page
    echo json_encode(['success' => true]);

    exit();
} else {
    // Handle error
    echo json_encode(['success' => false, 'error' => $stmt->error]);

}

$stmt->close();
$conn->close();

}

?>
