<?php
include("config.php");
// session_start();

// // Kontrolloni sesionin dhe merrni ID_Perdoruesi
// if (!isset($_SESSION['ID_Perdoruesi'])) {
//     // Redirekto në faqen e identifikimit ose ndonjë veprim tjetër
//     header("Location: login.php"); // P.sh., ndryshoni "login.php" me faqen e identifikimit
//     exit();
// }
$title = isset($_POST['title']) ? $_POST['title'] : '';
$datetime1 = isset($_POST['datetime1']) ? $_POST['datetime1'] : '';
$datetime2 = isset($_POST['datetime2']) ? $_POST['datetime2'] : '';
$idPerdoruesi=2;
// Krijoni një kërkesë SQL për të shtuar të dhënat në tabelën "room"
$sql = "INSERT INTO room ( Titulli, Prej, Deri, ID_Perdoruesi) VALUES ('$title', '$datetime1', '$datetime2','$idPerdoruesi')";

// Ekzekutoni kërkesën dhe kontrolloni për gabime
if ($conn->query($sql) === TRUE) {
    echo "Të dhënat u ruajtën me sukses";
} else {
    echo "Gabim: " . $sql . "<br>" . $conn->error;
}

// Mbyllni lidhjen me bazën e të dhënave
$conn->close();
header("Location: home.php"); 
exit();
?>