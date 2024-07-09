<?php
session_start();
include("config.php");

$error = "";

if (isset($_POST["submit"])) {
    $username = $_POST['Email'];
    $password = $_POST['Fjalekalimi'];

    $sql = "SELECT ID_Perdoruesi, Fjalekalimi FROM perdoruesit WHERE Email='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row && password_verify($password, $row['Fjalekalimi'])) {
            $_SESSION['ID_Perdoruesi'] = $row['ID_Perdoruesi'];
            $_SESSION['Email'] = $username;
            echo '<script>window.location.href = "home.php";</script>';
            exit();
        } else {
            $error = "Incorrect username or password.";
        }
    } else {
        die("Database query error: " . mysqli_error($conn));
    }
}
?>

<?php
    // include('login.php'); 
    if ((isset($_SESSION['Email']) != '')) 
    {
        header('Location: home.php');
    }   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <header>Forma e Kyçjes</header>
        <form method="post" action="#">
            <div class="field email">
                <div class="input-area">
                    <input type="text" name="Email" id="Email" placeholder="Email">
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Emaili s'mund te jete i zbrazet</div>
            </div>
            <div class="field password">
                <div class="input-area">
                    <input type="password" name="Fjalekalimi" id="Fjalekalimi" placeholder="Fjalkalimi">
                    <i class="icon fas fa-lock"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Passwordi s'mund te jete i zbrazet</div>
            </div>
            <div class="pass-txt"><a href="#">Keni harruarr fjalkalimin?</a></div>
            <input type="submit" name="submit" value="Login">
        </form>
        <div class="sign-txt">Nuk jeni ende te regjistruar? <a href="regjistrohu.php">Regjistrohuni</a></div>
    </div>

    <script src="js/login.js"></script>
    <!-- Update the script to manipulate the style directly -->
    <script>
    function togglePassword() {
        var passwordField = document.getElementById('Fjalekalimi');
        var eyeIcon = document.getElementById('togglePassword');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.innerHTML = 'Mbulo Fjalekalimin <i class="far fa-eye-slash"></i>';
            passwordField.style.backgroundColor = '#EAEEED'; // Adjust background color as needed
            passwordField.style.borderRadius = '50px'; // Adjust border radius as needed
            // Add any other styles you want for the visible password
        } else {
            passwordField.type = 'password';
            eyeIcon.innerHTML = 'Shfaq Fjalekalimin <i class="far fa-eye"></i>';
            passwordField.style.backgroundColor = ''; // Reset background color
            passwordField.style.borderRadius = ''; // Reset border radius
            // Reset any other styles you want for the hidden password
        }
    }
    </script>




</body>

</html>