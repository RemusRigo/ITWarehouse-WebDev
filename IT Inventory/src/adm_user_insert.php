<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260114
//   add user - insert into DB
-------------------------------------------------------------------------------------------------->

<?php

// Database connection
$conn = new mysqli("localhost", "root", "", "it_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read form data
$username = $_POST['username'];
$password = $_POST['password'];

// Hash password securely
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);

// Execute
if ($stmt->execute()) {
    echo "User added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
