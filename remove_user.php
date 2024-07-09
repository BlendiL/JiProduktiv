<?php
include("config.php");
// Merrni ID e perdoruesit nga kërkesa GET
$userId = $_GET["ID_Anetari"];
$ID_Room = $_GET['ID_Room'];

// Krijoni një kërkesë SQL për shtimin e perdoruesit
$sql = "DELETE FROM Anetaret WHERE ID_Anetari = $userId";

// Ekzekutoni kërkesën dhe kontrolloni për gabime
if ($conn->query($sql) === TRUE) {
    echo "Perdoruesi u hoq me sukses";

    // Bëni redirect pas një periudhe të caktuar (këtu 2 sekonda)
    header("refresh:2;url=Room.php?ID_Room=$ID_Room");
} else {
    echo "Gabim: " . $sql . "<br>" . $conn->error;
}

// Mbyllni lidhjen me bazën e të dhënave
$conn->close();
?>