<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Regjistrimi</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: rgba(62, 92, 116);
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .i {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 400px;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
    </style>

</head>

<body>

    <?php
    include('config.php');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $registrationMessage = ''; // initialize the variable for the registration message

    // If the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rawPassword = $_POST["Password"]; // Store the raw password for hashing
        $email = $_POST["Email"];
        $firstName = $_POST["FirstName"];
        $lastName = $_POST["LastName"];
    
        // Hash the password using md5
        $hashedPassword = md5($rawPassword);
    
        // Insert data into the 'user' table
        $sql = "INSERT INTO user (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";
    
        if ($conn->query($sql) === TRUE) {
            $registrationMessage = "Registration successful!";
        } else {
            $registrationMessage = "Error during registration: " . $conn->error;
        }
    }
    ?>

    <div class="i">
        <h2 style="text-align: center;">Forma per regjistrim te perdoruesve</h2>

        <!-- Added link to go back to index.php -->
        <p style="text-align: center;"><a href="index.php">Kthehu tek faqja login</a></p>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="firstName">Emri:</label>
            <input type="text" name="FirstName" required><br>

            <label for="lastName">Mbiemri:</label>
            <input type="text" name="LastName" required><br>

            <label for="email">Emaili:</label>
            <input type="email" name="Email" required><br>

            <label for="password">Fjalekalimi:</label>
            <input type="password" name="Password" required><br>



            <input type="submit" value="Regjistrohu">
        </form>

        <!-- Added section to display registration message -->
        <?php
        if (!empty($registrationMessage)) {
            echo "<p>$registrationMessage</p>";
        }
        ?>
    </div>
</body>

</html>