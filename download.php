<?php
// Për të shkarkuar skedarë nga kolona "File" në bazën e të dhënave
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include("config.php");

    // Përgatitni query për të marrë vlerën e kolonës "File" nga detyra me ID e dhënë
    $query = "SELECT File, Emri_i_Files FROM detyrat WHERE ID_Detyrat = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($file, $filename);

    // Kontrollo nëse ka rezultate
    if ($stmt->fetch()) {
        // Ndrysho kokën e HTTP për shkarkimin
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($file));

        // Shfaqeni skedarin
        echo $file;
    } else {
        echo 'Skedari nuk ekziston.';
    }

    // Mbyllja e deklaratës së përgatitur
    $stmt->close();
    // Mbyllja e lidhjes me bazën e të dhënave
    $conn->close();

    exit;
} else {
    echo 'ID e detyrës nuk është e dhënë.';
}
?>