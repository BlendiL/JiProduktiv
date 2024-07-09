<?php
include("config.php");

// Merrni ID_Room nga URL ose një burim tjetër
$idroom = 6;//$_GET['ID_Room'];

$sql = "SELECT anetaret.ID_Perdoruesi, perdoruesit.Email
        FROM anetaret
        INNER JOIN room ON anetaret.ID_Room = room.ID_Room
        INNER JOIN perdoruesit ON anetaret.ID_Perdoruesi = perdoruesit.ID_Perdoruesi
        WHERE anetaret.ID_Room = $idroom
        UNION
        SELECT room.ID_Perdoruesi AS ID_Perdoruesi, perdoruesit.Email
        FROM room
        INNER JOIN perdoruesit ON room.ID_Perdoruesi = perdoruesit.ID_Perdoruesi
        WHERE room.ID_Room = $idroom";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID_Perdoruesi: " . $row["ID_Perdoruesi"] . ", Email: " . $row["Email"] . "<br>";
    }
} else {
    echo "Nuk u gjetën rezultate.";
}

$conn->close();
?>