<?php
// Include your helper.php file and any necessary database connection code
include 'config/helper.php';
// Example data for a test user
$conn = new mysqli('localhost', 'root', '', 'jiproduktiv');
$test_user_data = array(
    'first_name' => 'joni',
    'last_name' => 'ism',
    'email' => 'joniism@gmail.com',
    'password' => password_hash('lirjon', PASSWORD_BCRYPT)
);

// Call the insert function to add the test user
insert('user', $test_user_data, $conn);

echo 'Test user added successfully.';
?>