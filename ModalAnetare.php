<div id="modal">

    <div class="modal-container">

        <!-- <div class="modal-content" style="border-right: 1px solid #333; "> -->
        <span class="close" onclick="closeModal()">&times;</span>

        <form method="POST" action="search.php" id="searchForm">
            <!-- <div class="input-container search-bar">
                <input placeholder="email" type="text" class="input">
                <span>@gmail.com</span>
                <input type="submit" value="Kërko" style="border-radius:5px">
            </div> -->
            <div class="search-bar" style="
        margin: 15px 0;
        display: flex;
        justify-content: center;
    ">
                <input type="text" name="search" id="search" placeholder="Kërko...">
                <input type="submit" value="Kërko">
            </div>

        </form>
        <div id="results" style="text-align:center"></div>

        <!-- <div class="separator"></div> -->
        <div class="modal-content">


            <?php
$sql = "SELECT * FROM anetaret ORDER BY ID_Anetari DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="room-grid">';
    
    while ($row = $result->fetch_assoc()) {
        echo '<div class="room-container" style="text-align:center; display: inline-block; margin-right: 10px; width: 23%;">';
        echo '<a href="remove_user.php?ID_Anetari=' . $row['ID_Anetari'] . '" class="room-link">';
        echo '<img src="images/1.jpg" alt="" data-title="' . $row['ID_Perdoruesi'] . '" style="width: 100%; height: auto; margin-bottom: 1%;" />';
        echo '<br>';
        echo '<p class="room-title">' . $row['ID_Perdoruesi'] . '</p>';
        echo '</a>';
        echo '</div>';
    }
    
    echo '</div>';
} else {
    echo "No thirrje data found.";
}
?>

        </div>
    </div>

</div>