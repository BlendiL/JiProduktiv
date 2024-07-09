<div class="content-wrapper kanban">
    <section class="">
        <?php
include("config.php");

if (isset($_POST['ruaj_detyrat'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['textbox']);
    $priority = mysqli_real_escape_string($conn, $_POST['priority']);
    $deadline = mysqli_real_escape_string($conn, $_POST['datetime2']);

    // Handle file upload
    $file = null;
    if (!empty($_FILES['file-input']['name'])) {
        $file_name = basename($_FILES['file-input']['name']);
        $file_path = '' . $file_name; // Change this to your actual upload directory
        move_uploaded_file($_FILES['file-input']['tmp_name'], $file_path);
        $file = mysqli_real_escape_string($conn, $file_path);
    }

    $selected_users = isset($_POST['selected_id']) ? $_POST['selected_id'] : [];
    $team_lead_id = 1; // Change this to the actual Team Lead ID
    $room_id = 1; // Change this to the actual Room ID

    foreach ($selected_users as $id_perdoruesi) {
        $sql_insert_detyra = "INSERT INTO detyrat (Detyra, ShpjegimiDetyres, Emri_i_Files, File, Afati_Deri, Niveli_Prioritetit, ID_TeamLead, ID_Perdoruesi, ID_Room)
                              VALUES ('$title', '$description', '$file', '$file', '$deadline', '$priority', '$team_lead_id', '$id_perdoruesi', '$room_id')";

        // Execute the query using prepared statements for security
        $stmt = $conn->prepare($sql_insert_detyra);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Detyra u ruajt me sukses për perdoruesin me ID_Perdoruesi $id_perdoruesi.<br>";
        } else {
            echo "Gabim gjatë ruajtjes së detyrave: " . $stmt->error . "<br>";
        }

        $stmt->close();
    }

    // If no user is selected, save the task with NULL ID_Perdoruesi
    if (empty($selected_users)) {
        $sql_insert_detyra_no_user = "INSERT INTO detyrat (Detyra, ShpjegimiDetyres, Emri_i_Files, File, Afati_Deri, Niveli_Prioritetit, ID_TeamLead, ID_Perdoruesi, ID_Room)
                                      VALUES ('$title', '$description', '$file', '$file', '$deadline', '$priority', '$team_lead_id', NULL, '$room_id')";

        // Execute the query using prepared statements for security
        $stmt_no_user = $conn->prepare($sql_insert_detyra_no_user);
        $stmt_no_user->execute();

        if ($stmt_no_user->affected_rows > 0) {
            echo "Detyra u ruajt me sukses si e Hapur!.<br>";
        } else {
            echo "Gabim gjatë ruajtjes së detyrës se Hapur: " . $stmt_no_user->error . "<br>";
        }

        $stmt_no_user->close();
    }
}

?>

        <div class="modal-content">
            <div
                style="background-color: #ffcccb; padding: 10px; margin-bottom: 10px; border: 1px solid #ff6666; border-radius: 5px;">
                <strong>Udhezim!</strong> Zgjedhni anetaret te cileve po ju caktoni detyra duke klikuar checkbox-in.
                Nese nuk
                zgjedhni asnje detyra mbetet e hapur!
            </div>

            <form id="ruaj_detyrat" method="POST" enctype="multipart/form-data">
                <?php
        $idroom = $_GET['ID_Room'];

        $sql = "SELECT anetaret.ID_Perdoruesi, user.Email, user.first_name, user.last_name
                FROM anetaret
                INNER JOIN room ON anetaret.ID_Room = room.ID_Room
                INNER JOIN user ON anetaret.ID_Perdoruesi = user.ID_Perdoruesi
                WHERE anetaret.ID_Room = $idroom
                UNION
                SELECT room.ID_Perdoruesi AS ID_Perdoruesi, user.Email, user.first_name, user.last_name
                FROM room
                INNER JOIN user ON room.ID_Perdoruesi = user.ID_Perdoruesi
                WHERE room.ID_Room = $idroom";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ID_Perdoruesi = $row["ID_Perdoruesi"];
                echo "<ul><input type='checkbox' id='' name='selected_id[]' value='$ID_Perdoruesi'><b>Emri dhe Mbiemri: </b>" . $row["first_name"] . " " . $row["last_name"] . ", <b>Email: </b>" . $row["Email"] . "</ul>";
            }
        } else {
            echo "Nuk u gjetën rezultate.";
        }
        ?>
                <hr style="border-top: 1px solid #ccc; margin: 20px 0;">
                <h2 style="text-align:center">Cakto detyre</h2>

                <div style="text-align:center">
                    <label for="title">Titulli:</label>
                    <textarea name="title" id="title" cols="60" rows="1"></textarea>
                </div>

                <div class="form" style="float: right; width: 47%; margin-right: 5%">
                    <span class="form-title">Upload your file</span>
                    <label for="file-input" class="drop-container">
                        <span class="drop-title">Drop files here</span> or
                        <input type="file" accept=".pdf, .doc, .docx" id="file-input" name="file-input" />
                    </label>
                </div>

                <div style="float: left; width: 47%; margin-left: 7%">
                    <label for="textbox">Pershkruaj Detyren:</label><br>
                    <textarea name="textbox" id="textbox" cols="40" rows="5"></textarea>
                    <br>
                    <label for="priority">Prioriteti i Detyres:</label>
                    <select id="priority" name="priority">
                        <option value="3">I Larte</option>
                        <option value="2">Mesatar</option>
                        <option value="1">I Ulet</option>
                    </select><br>
                    <label for="datetime2">Deri:</label>
                    <input type="datetime-local" name="datetime2" id="datetime2">

                </div>

                <br style="clear:both;">
                <button type="submit" name="ruaj_detyrat" class="bookmarkBtn">
                    <span class="IconContainer">
                        <svg viewBox="0 0 384 512" height="0.9em" class="icon">
                            <path
                                d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z">
                            </path>
                        </svg>
                    </span>
                    <p class="text">Save</p>
                </button>
            </form>
        </div>
    </section>
</div>