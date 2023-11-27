<?php

// Connect to Database
require_once 'db_connection.php';

// Check if image is modified
if (!empty($_FILES['image']['name'])) {
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

    // Update file path in the database
    $filePath = './resources/' . $targetFileName;
} else {
    // If image is not modified, keep the existing file path
    $filePath = $_POST['existing_file_path'];
}

// Sanitize user input
$name = mysqli_real_escape_string($conn, $_POST['name']);
$country = mysqli_real_escape_string($conn, $_POST['country']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$averageCost = $_POST['average_cost'];
$destinationId =  $_POST['destination_id'];

// Update data in the database
$updateQuery = "UPDATE destination SET 
`country_id`='$country', 
`destination_name`='$name', 
`city`='$city', 
`average_cost`=$averageCost, 
`file_path`='$filePath', 
`description`='$description' 
WHERE id = '$destinationId'";
    
if ($conn->query($updateQuery) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    // Handle error
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();

?>
