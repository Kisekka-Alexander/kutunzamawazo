<?php
// Connect to Database
require_once 'db_connection.php';

// Fetch data from the Destination table
$sql = "SELECT * FROM destination where deleted=0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      echo "<div class='card m-4 border-0' data-bs-toggle='modal' data-bs-target='#updateModal' data-city='" . $row['city'] . "' data-name='" . $row['destination_name'] . "' 
      data-cost='" . $row['average_cost'] . "' data-desc='" . $row['description'] . "' data-country='" . $row['country_id'] . "' data-id='" . $row['id'] . "' data-image='" . $row['file_path'] . "'>
        <img class='d-block w-100 rounded' src='" . $row['file_path'] . "' alt='" . $row['destination_name'] . "' style='width: 40px; height: 200px;'>
        <h3>" . $row['destination_name'] . "</h3>
        <p>" . $row['description'] .  "</p>
        <div class='d-flex justify-content-between'>
          <div class='d-flex justify-content-between'><p>1000km</p></div>
          <p>$" . $row['average_cost'] . "</p>
        </div>
      </div>";

      echo "<div class='modal fade' id='confirmDeleteModal" . $row['id'] . "' tabindex='1' aria-labelledby='confirmDeleteModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='confirmDeleteModalLabel'>Confirm Delete</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
              <p>Are you sure you want to delete this destination?</p>
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
              <a href='delete_destination.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
            </div>
          </div>
        </div>
      </div>";
    }
}

// Close connection
$conn->close();
?>
