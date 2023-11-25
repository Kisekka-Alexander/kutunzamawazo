<?php
require_once 'db_connection.php';

// Fetch data from the 'Country' table
$sql = "SELECT * FROM Country";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close connection
$conn->close();

// Set the response header to indicate JSON content
header('Content-Type: application/json');

// Return data as JSON
echo json_encode($data, JSON_THROW_ON_ERROR);
?>
