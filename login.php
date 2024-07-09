<?php
session_start();
include("config.php");

$error = "";

if (isset($_POST["submit"])) {
    if (empty($_POST["Email"]) || empty($_POST["Fjalekalimi"])) {
        $error = "Both fields are required.";
    } else {
        $username = $_POST['Email'];
        $password = $_POST['Fjalekalimi'];

        $sql = "SELECT ID_Perdoruesi, Fjalekalimi FROM perdoruesit WHERE Email='$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row && password_verify($password, $row['Fjalekalimi'])) {
            $_SESSION['ID_Perdoruesi'] = $row['ID_Perdoruesi'];
            $_SESSION['Email'] = $username;
            header("location: home.php");
        } else {
            $error = "Incorrect username or password.";
        }
    }
}
?>