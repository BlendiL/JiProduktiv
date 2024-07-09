<?php
// Initialize session to store temporarily saved users
session_start();

// Check if there's an existing array to store saved users in the session
if (!isset($_SESSION['saved_users'])) {
    $_SESSION['saved_users'] = array();
}

if(isset($_POST['searchBtn'])) {
    // Search functionality
    $searchTerm = $_POST['search'];
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm); // Sanitize input

    $query = "SELECT * FROM perdoruesit WHERE Email LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $query);

    // Process the search results as needed
    // For example, you can loop through $result and display the matching users
    // ...

} elseif(isset($_POST['saveUserBtn'])) {
    // Save User functionality
    $email = $_POST['email'];
    $email = mysqli_real_escape_string($conn, $email); // Sanitize input

    // Check if the email is not empty
    if (!empty($email)) {
        // Add the email to the session array
        $_SESSION['saved_users'][] = $email;
        echo "User added temporarily!";
    } else {
        echo "Email field is required!";
    }
}

// Close the database connection if needed
mysqli_close($conn);
?>