<?php
// Connect to Database
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $destinationId = $_GET['id'];

    $updateQuery = "UPDATE destination SET deleted = 1 WHERE id = ?";
    
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $destinationId);

    if ($stmt->execute()) {
        // Redirect to destinations list page
        header("Location: view_destinations.html");
        exit();
    } else {
        // Handle error
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    exit();
}
?>
