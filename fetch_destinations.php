<?php
require_once 'db_connection.php';

// Fetch data from the 'Country' table
$sql = "SELECT * FROM destination";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "<div class='card m-4 border-0'>
        <img class='d-block w-100 rounded' src='" . $row['file_path'] . "' alt='" . $row['destination_name'] . "' style='width: 10px; height: 200px;'>
        <h3>" . $row['destination_name'] . "</h3>
        <p>Officially the capital of Japan</p>
        <div class='d-flex justify-content-between'>
          <div class='d-flex justify-content-between'><p>1000km</p></div>
          <p>$" . $row['average_cost'] . "</p>
      </div></div>";
    }
}

// Close connection
$conn->close();
?>
