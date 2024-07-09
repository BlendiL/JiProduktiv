<?php
// Replace database connection details with your own
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modify"])) {
    // Merrni të dhënat e përdoruesit nga forma
    $userID = $_POST["ID_Perdoruesi"];
    $newFirstName = $_POST["first_name"];
    $newLastName = $_POST["last_name"];
    $newEmail = $_POST["email"];
    $newTelefoni = $_POST["Telefoni"];

    // Përditësoni të dhënat në bazën e të dhënave
    $sql = "UPDATE user SET first_name='$newFirstName', last_name='$newLastName', email='$newEmail', Telefoni='$newTelefoni' WHERE ID_Perdoruesi=$userID";

    if ($conn->query($sql) === TRUE) {
        // Kthehu përsëri të dhënat e përdoruesit pas përditësimit
        $result = $conn->query("SELECT * FROM user WHERE ID_Perdoruesi = $userID");
        $rreshti = $result->fetch_assoc();

        // Kthe një përgjigje JSON me të dhënat e përdoruesit të përditësuara
        echo json_encode($rreshti);
    } else {
        echo json_encode(["error" => "Gabim gjatë përditësimit të të dhënave: " . $conn->error]);
    }
}

// Mbyllni lidhjen me bazën e të dhënave
$conn->close();
?>