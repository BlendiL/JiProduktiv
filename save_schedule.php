<?php
session_start(); // Start the session for user authentication

require_once('config.php'); // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Handle unauthorized access (e.g., redirect to login page)
    header('Location: login.php');
    exit();
}

// Get user ID from the session
$user_id = $_SESSION['user_id'];

// Retrieve schedules for the logged-in user
$stmt = $conn->prepare("SELECT * FROM `schedule_list` WHERE `user_id` = ?");
$stmt->bind_param('i', $user_id);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Loop through the result set and display schedules
while ($row = $result->fetch_assoc()) {
    // Output schedule details (e.g., title, description, start_datetime, end_datetime)
    // Replace with your own output logic
    echo "Title: " . $row['title'] . "<br>";
    echo "Description: " . $row['description'] . "<br>";
    echo "Start Date: " . $row['start_datetime'] . "<br>";
    echo "End Date: " . $row['end_datetime'] . "<br>";
    echo "<hr>";
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>