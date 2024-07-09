<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faqja Kryesore</title>
    <link rel="stylesheet" href="css/index.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" /> -->
    <!-- <link rel="stylesheet" href="css/slider2.css" /> -->
</head>

<body>

    <div id="sse1">
        <div id="sses1">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="#" onclick="openModal()">Room</a></li>
                <li><a href="#">Rreth Nesh</a></li>

            </ul>

        </div>
        <div style="margin-left: 600px">
            <a href="#">
                <div>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11 21H4C4 17.4735 6.60771 14.5561 10 14.0709M19.8726 15.2038C19.8044 15.2079 19.7357 15.21 19.6667 15.21C18.6422 15.21 17.7077 14.7524 17 14C16.2923 14.7524 15.3578 15.2099 14.3333 15.2099C14.2643 15.2099 14.1956 15.2078 14.1274 15.2037C14.0442 15.5853 14 15.9855 14 16.3979C14 18.6121 15.2748 20.4725 17 21C18.7252 20.4725 20 18.6121 20 16.3979C20 15.9855 19.9558 15.5853 19.8726 15.2038ZM15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z"
                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

            </a>
        </div>
    </div>
    <?php include("slider.php"); ?>
    <?php //include("index.html"); ?>

    <div id="modal">
        <div class="modal-container">
            <div class="modal-content" style="border-right: 1px solid #333; ">
                <h2 style="text-align:center">Krijo Room</h2>
                <form action="save_data.php" method="post">
                    <div style="text-align:center">
                        Titulli:
                        <textarea name="title" id="title" cols="33" rows="1"></textarea>
                    </div>

                    <div class="datetime">
                        Prej: <input type="datetime-local" name="datetime1" id="datetime1"><br>
                        Deri: <input type="datetime-local" name="datetime2" id="datetime2">
                    </div>
                    <br>
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
            <!-- <div class="separator"></div> -->
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2 style="text-align:center">Hyr ne Room</h2>
                <?php
                $ID_Perdoruesi = 2;
                
$sql = "SELECT room.*, anetaret.ID_Perdoruesi AS AnetarID
        FROM room
        LEFT JOIN anetaret ON room.ID_Room = anetaret.ID_Room
        WHERE room.ID_Perdoruesi = $ID_Perdoruesi OR anetaret.ID_Perdoruesi = $ID_Perdoruesi
        ORDER BY room.ID_Room DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="room-grid">';
    
    while ($row = $result->fetch_assoc()) {
        echo '<div class="room-container" style="text-align:center; display: inline-block; margin-right: 10px; width: 23%;">';
        echo '<a href="Room.php?ID_Room=' . $row['ID_Room'] . '" class="room-link">';
        echo '<img src="images/1.jpg" alt="" data-title="' . $row['Titulli'] . '" style="width: 100%; height: auto; margin-bottom: 1%;" />';
        echo '<br>';
        echo '<p class="room-title">' . $row['Titulli'] . '</p>';
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

    <script src="js/home.js"></script>
</body>

</html>