<?php
// Connect to Database
include 'db_connection.php';

// Get user input
$email = $_POST['email'];
$userPassword = $_POST['password'];

// Fetch the hashed password from the database based on the user's email
$query = "SELECT id, email, password FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($userId, $userEmail, $hashedPassword);

if ($stmt->fetch()) {
  // Verify the entered password against the hashed password
  if (password_verify($userPassword, $hashedPassword)) {
    // Login successful
    echo json_encode(['success' => true, 'userId' => $userId, 'userEmail' => $userEmail]);
  } else {
    // Login failed
    echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
  }
} else {
  // User not found
  echo json_encode(['success' => false, 'error' => 'User not found']);
}

$stmt->close();
$conn->close();
?>
