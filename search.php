<?php
include('config.php');
// ... (si më parë)
var_dump($_POST);
var_dump($_REQUEST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];
    $ID_Room = 4;//$_POST["ID_Room"];
    echo "ID_Room: " . $ID_Room;

    // Kërkesa SQL për të gjetur perdoruesit nga baza e të dhënave
    $sql = "SELECT * FROM user WHERE email or first_name LIKE '%$search%'";

    $result = $conn->query($sql);

    // Shfaq rezultatet në faqe
    if ($result->num_rows > 0) {
        echo "<ul>";

        while ($row = $result->fetch_assoc()) {
            echo "<ul><button class='add-user' style='align-items: left' data-id='" . $row["ID_Perdoruesi"] . '&ID_Room=' . $ID_Room .  "'>+</button> &nbsp;&nbsp;&nbsp;<b>Emri dhe Mbiemri: </b>" . $row["first_name"] . " " . $row["last_name"] . "  " . "<b>Email:</b>" . $row["email"] . "</ul>";
        }

        echo "</ul>";
    } else {
        echo "<p>Nuk u gjetën rezultate.</p>";
    }
}

// ... (si më parë)
?>