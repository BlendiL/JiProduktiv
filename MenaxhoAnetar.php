<?php include("config.php"); ?>
<div class="content-wrapper kanban">
    <section class="">

        <div class="modal-content">
            <div style="background-color: #ffcccb; /* Light red background color */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ff6666; /* Dark red border */
            border-radius: 5px;">
                <strong>Udhezim!</strong> <br>Per te shtuar anetare ne kete Room kerkoni ata sipas Email-it ose Emrit te
                tyre, pastaj klikoni + tek anetari qe deshironi te shtoni!
            </div>
            <?php
// Merr ID_Room nga URL
$ID_Room = $_GET['ID_Room'] ?? '';
echo "ID_Room: " . $ID_Room;
?>
            <form method="POST" action="search.php" id="searchForm">
                <input type="hidden" name="ID_Room" id="ID_Room" value="<?php echo $ID_Room; ?>">
                <div class="search-bar" style="margin: 15px 0; display: flex; justify-content: center;">
                    <input type="text" name="search" id="search" placeholder="Kërko...">
                    <input type="submit" value="Kërko">
                </div>
            </form>

            <div id="results" style="margin-left: 15%"></div>
        </div>
        <!-- <div class="separator"></div> -->
        <div class="modal-content">
            <div style="background-color: #ffcccb; /* Light red background color */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ff6666; /* Dark red border */
            border-radius: 5px;">
                <strong>Udhezim!</strong>Per te larguar perdorues nga Room mjafton te klikon tek emaili i atij
                perdoruesi ketu!
            </div>

            <?php
$sql = "SELECT anetaret.*, user.* 
FROM anetaret 
LEFT JOIN user ON anetaret.ID_Perdoruesi = user.ID_Perdoruesi
WHERE anetaret.ID_Room = $ID_Room 
ORDER BY anetaret.ID_Anetari DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="room-grid">';
    
    while ($row = $result->fetch_assoc()) {
        echo '<div class="room-container" style="text-align:center; display: inline-block; margin-right: 10px; width: 23%;">';
        echo '<a href="remove_user.php?ID_Anetari=' . $row['ID_Anetari'] . '&ID_Room=' . $row['ID_Room'] . '" class="room-link">';
        echo '<img src="images/1.jpg" alt="" data-title="' . $row['ID_Perdoruesi'] . '" style="width: 50%; height: auto; margin-bottom: 1%;" />';
        
        echo '<p class="room-title">' . $row['email'] . '</p>';
        echo '</a>';
        echo '</div>';
    }
    
    echo '</div>';
} else {
    echo "No thirrje data found.";
}
?>

        </div>
    </section>
</div>