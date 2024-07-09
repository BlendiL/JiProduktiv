<div id="modal2">

    <div class="modal-container">

        <!-- <div class="modal-content" style="border-right: 1px solid #333; "> -->
        <span class="close" onclick="closeModal2()">&times;</span>
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
?>
        <form method="post" action="">
            <label for="search_email">Kërko sipas Email-it:</label>
            <input type="text" id="search_email" name="search_email" required>
            <button type="submit" name="kerko">Kërko</button>
        </form>

        <?php
    // Shfaq rezultatet e kërkimit nëse është bërë një kërkim
    if (isset($_POST['kerko'])) {
        $search_email = $_POST['search_email'];

        // Kërkesa SQL për të marrë të dhënat nga tabela e përdoruesve duke filtruar sipas email-it
        $sql_search = "SELECT * FROM perdoruesit WHERE Email = '$search_email'";
        $result_search = $conn->query($sql_search);

        // Shfaq rezultatet me një plus (+) në secilin rresht
        if ($result_search->num_rows > 0) {
            while ($row = $result_search->fetch_assoc()) {
                echo "<p>" . $row['Perdoruesi'] . " - Email: " . $row['Email'] . " <button type='button' onclick='zgjidhOseHiqPërdoruesin(" . $row['ID_Perdoruesi'] . ")' id='btn_" . $row['ID_Perdoruesi'] . "'>+</button></p>";
            }
        } else {
            echo "Nuk u gjet asnjë rezultat.";
        }
    }
    ?>


        <!-- <div class="separator"></div> -->
        <div class="modal-content">
            <h2 style="text-align:center">Cakto detyre</h2>

            <form>
                <div style="text-align:center">
                    <label for="title">Titulli:</label>
                    <textarea name="title" id="title" cols="60" rows="1"></textarea>
                </div>

                <div class="form" style="float: right; width: 50%;">
                    <span class="form-title">Upload your file</span>
                    <!-- <p class="form-paragraph">File should be a pdf</p> -->
                    <label for="file-input" class="drop-container">
                        <span class="drop-title">Drop files here</span> or
                        <input type="file" accept=".pdf, .doc, .docx" required="" id="file-input" />
                    </label>
                </div>

                <div style="float: left; width: 50%;">
                    <label for="textbox">Pershkruaj Detyren:</label><br>
                    <textarea name="textbox" id="textbox" cols="35" rows="5"></textarea>
                    <br>
                    <label for="priority">Prioriteti:</label>
                    <select id="priority" name="priority">
                        <option value="high">Lart</option>
                        <option value="medium">Mesatar</option>
                        <option value="low">Ulet</option>
                    </select><br>
                    <label for="datetime2">Deri:</label>
                    <input type="datetime-local" name="datetime2" id="datetime2">

                </div>

                <br style="clear:both;">
                <button type="submit" class="bookmarkBtn">
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
    </div>
</div>