<?php
// Connect to Database
require_once 'db_connection.php';

// Fetch countries from the database
$sql = "SELECT id, country_name FROM country";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . $row['country_name'] . "</option>";
    }
} else {
    echo "<option value=''>No countries found</option>";
}
// Close the database connection
$conn->close();
?>
