<?php
include("config.php");

// Kërkesa SQL për të ruajtur detyrat për përdoruesin e zgjedhur
if (isset($_POST['ruaj_detyrat'])) {
    $id_perdoruesi_temp = $_POST['id_perdoruesi_temp'];

    // Përpunimi i detyrave dhe ruajtja në tabelën e detyrave
    if (!empty($id_perdoruesi_temp)) {
        foreach ($id_perdoruesi_temp as $id_perdoruesi) {
            // Për secilin ID_Perdoruesi të zgjedhur, përpuno dhe ruaj detyrat në tabelën e detyrave
            $detyra = "Detyra për perdoruesin me ID_Perdoruesi $id_perdoruesi";
            $sql_insert_detyra = "INSERT INTO detyrat (Detyra, Niveli_Prioritetit,ID_TeamLead,ID_Perdoruesi, ID_Room ) VALUES ('aa', 'aa', '2','$id_perdoruesi', '1')";
            
            if ($conn->query($sql_insert_detyra) === TRUE) {
                echo "Detyra u ruajt me sukses për perdoruesin me ID_Perdoruesi $id_perdoruesi.<br>";
            } else {
                echo "Gabim gjatë ruajtjes së detyrave: " . $conn->error . "<br>";
            }
        }
    }
}

// Kërkesa SQL për të marrë të dhënat nga tabela e përdoruesve duke filtruar sipas ID_Perdoruesi në anetaret dhe room
$sql_all_members = "SELECT * FROM perdoruesit WHERE ID_Perdoruesi IN (SELECT ID_Perdoruesi FROM anetaret UNION SELECT ID_Perdoruesi FROM room)";
$result_all_members = $conn->query($sql_all_members);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kërko dhe Ruaj Detyrat</title>
</head>

<body>
    <h2>Kërko dhe Ruaj Detyrat</h2>

    <?php
    // Shfaq të gjithë anëtarët
    if ($result_all_members->num_rows > 0) {
        while ($row = $result_all_members->fetch_assoc()) {
            echo "<p>" . $row['Perdoruesi'] . " - Email: " . $row['Email'] . " <button type='button' onclick='zgjidhOseHiqPërdoruesin(" . $row['ID_Perdoruesi'] . ")' id='btn_" . $row['ID_Perdoruesi'] . "'>+</button></p>";
        }
    } else {
        echo "Nuk ka asnjë anëtar.";
    }
    ?>

    <hr>

    <h3>Detyrat e zgjedhura:</h3>
    <form method="post" action="">
        <!-- Kjo është një div e fshehur për të ruajtur ID_Perdoruesi të përdoruesve të zgjedhur -->
        <div id="perdoruesit_e_zgjedhur" style="display: none;"></div>

        <button type="submit" name="ruaj_detyrat">Ruaj Detyrat</button>
    </form>

    <script>
    function zgjidhOseHiqPërdoruesin(id) {
        var perdoruesit_e_zgjedhur = document.getElementById('perdoruesit_e_zgjedhur');
        var btn_id = 'btn_' + id;
        var btn = document.getElementById(btn_id);

        if (btn.innerText === '+') {
            // Shto perdoruesin në fund të div-it të fshehur
            var input_hidden = document.createElement('input');
            input_hidden.type = 'hidden';
            input_hidden.name = 'id_perdoruesi_temp[]';
            input_hidden.value = id;
            perdoruesit_e_zgjedhur.appendChild(input_hidden);

            // Ndrysho tekstin e butonit nga + ne -
            btn.innerText = '-';
        } else {
            // Heq perdoruesin nga div-i i fshehur
            var input_hidden_to_remove = perdoruesit_e_zgjedhur.querySelector('input[value="' + id + '"]');
            if (input_hidden_to_remove !== null) {
                perdoruesit_e_zgjedhur.removeChild(input_hidden_to_remove);
            }

            // Ndrysho tekstin e butonit nga - ne +
            btn.innerText = '+';
        }
    }
    </script>
</body>

</html>