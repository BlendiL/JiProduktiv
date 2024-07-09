<?php
include("config.php");

// Merrni ID e perdoruesit nga kërkesa GET
$userId = $_GET["id"];
$ID_Room = $_GET['ID_Room'];
$niveli = 0; // Vlera fillestare e nivelit

// Krijoni një kërkesë SQL për shtimin e perdoruesit
$sql = "INSERT INTO Anetaret (ID_Perdoruesi, ID_Room, Niveli) VALUES ('$userId', '$ID_Room', '$niveli')";

// Ekzekutoni kërkesën dhe kontrolloni për gabime
if ($conn->query($sql) === TRUE) {
    echo "Perdoruesi u shtua me sukses";
} else {
    echo "Gabim: " . $sql . "<br>" . $conn->error;
}

// Mbyllni lidhjen me bazën e të dhënave
$conn->close();
?>

<script>
// Rifresko faqen pas 2 sekondave (ndryshoni vlerën sipas nevojës)
setTimeout(function() {
    location.reload();
}, 2000);
</script>