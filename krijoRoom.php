<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Div me Border</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        width: 80%;
        margin: 20px auto;
        border: 2px solid #333;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .search-bar {
        margin: 15px 0;
        display: flex;
        justify-content: center;
    }

    input[type="text"] {
        padding: 8px;
        width: 200px;
    }

    input[type="submit"] {
        padding: 8px 15px;
        background-color: #d4def5;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .datetime {
        display: flex;
        justify-content: space-between;
    }

    input[type="datetime-local"] {
        padding: 8px;
        width: 45%;
    }

    .input-container {
        position: relative;
        display: flex;
        width: 100%;
        max-width: 290px;

    }

    .input-container>span,
    .input-container .input {
        white-space: nowrap;
        display: block;
    }

    .input-container>span,
    .input-container .input:first-child {
        border-radius: 6px 0 0 6px;
    }

    .input-container>span,
    .input-container .input {
        border-radius: 0 6px 6px 0;
    }

    .input-container>span,
    .input-container .input {
        margin-left: -1px;
    }

    .input-container .input {
        position: relative;
        z-index: 1;
        flex: 1 1 auto;
        width: 1%;
        margin-top: 0;
        margin-bottom: 0;
    }

    .input-container span {
        text-align: center;
        padding: 8px 12px;
        font-size: 14px;
        line-height: 25px;
        color: #6b7385;
        background: #d4def5;
        border: 1px solid #CDD9ED;
        font-weight: bold;
        transition: background 0.3s ease, border 0.3s ease, color 0.3s ease;
    }

    .input-container:focus-within>span {
        color: #fff;
        background-color: #148cd1;
        border-color: #148cd1;
    }

    .input {
        display: block;
        width: 100%;
        padding: 8px 16px;
        line-height: 25px;
        font-size: 14px;
        font-weight: 500;
        font-family: inherit;
        border-radius: 6px;
        -webkit-appearance: none;
        color: #99A3BA;
        border: 1px solid #CDD9ED;
        background: #fff;
        transition: border 0.3s ease;
    }

    .input::placeholder {
        color: #CBD1DC;
    }

    .input:focus {
        outline: none;
        border-color: #148cd1;
    }

    .bookmarkBtn {
        width: 100px;
        height: 40px;
        border-radius: 40px;
        border: 1px solid rgba(255, 255, 255, 0.349);
        background-color: rgb(12, 12, 12);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition-duration: 0.3s;
        overflow: hidden;
        margin-left: 45%;
    }

    .IconContainer {
        width: 30px;
        height: 30px;
        background: linear-gradient(to bottom, rgb(255, 136, 255), rgb(172, 70, 255));
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        z-index: 2;
        transition-duration: 0.3s;
    }

    .icon {
        border-radius: 1px;
    }

    .text {
        height: 100%;
        width: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        z-index: 1;
        transition-duration: 0.3s;
        font-size: 1.04em;
    }

    .bookmarkBtn:hover .IconContainer {
        width: 90px;
        transition-duration: 0.3s;
    }

    .bookmarkBtn:hover .text {
        transform: translate(10px);
        width: 0;
        font-size: 0;
        transition-duration: 0.3s;
    }

    .bookmarkBtn:active {
        transform: scale(0.95);
        transition-duration: 0.3s;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Krijo Room</h1>
        <form action="save_data.php" method="post">
            <div style="text-align:center">
                <textarea name="title" id="title" cols="100" rows="2"></textarea>
            </div>

            <div class="datetime">
                <input type="datetime-local" name="datetime1" id="datetime1">
                <input type="datetime-local" name="datetime2" id="datetime2">
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

        <form method="POST" action="search.php" id="searchForm">
            <!-- <div class="input-container search-bar">
                <input placeholder="email" type="text" class="input">
                <span>@gmail.com</span>
                <input type="submit" value="Kërko" style="border-radius:5px">
            </div> -->
            <div class="search-bar">
                <input type="text" name="search" id="search" placeholder="Kërko...">
                <input type="submit" value="Kërko">
            </div>

        </form>



        <!-- Elementi për shfaqjen e rezultateve -->
        <div id="results" style="text-align:center"></div>
    </div>

    <script>
    document.getElementById("searchForm").addEventListener("submit", function(e) {
        e.preventDefault();

        var searchInput = document.getElementById("search").value;

        // Krijimi i një kërkesë AJAX për të kërkuar perdoruesit nga baza e të dhënave
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "search.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Shfaq rezultatet e kërkimit në div-in "results"
                document.getElementById("results").innerHTML = xhr.responseText;
            }
        };
        xhr.send("search=" + searchInput);
    });

    // Skenari i mëparshëm për shtimin e perdoruesit mbetet i njëjtë

    // Skripti JavaScript për lidhjen e ngjarjes së shtimit dhe heqjes së perdoruesit
    document.getElementById("results").addEventListener("click", function(e) {
        if (e.target.classList.contains("add-user")) {
            // Merr ID e perdoruesit nga atributi data-id
            var userId = e.target.getAttribute("data-id");

            // Krijimi i një kërkesë AJAX për të shtuar perdoruesin në bazën e të dhënave
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "add_user.php?id=" + userId, true);
            xhr.send();

            // Përditëso faqen pa rifreskim për të rifreskuar rezultatet
            xhr.onload = function() {
                // Shfaq rezultatet e përditësuara në div-in "results"
                document.getElementById("results").innerHTML = xhr.responseText;
            };
        } else if (e.target.classList.contains("remove-user")) {
            // Merr ID e perdoruesit nga atributi data-id
            var userId = e.target.getAttribute("data-id");

            // Krijimi i një kërkesë AJAX për të hequr perdoruesin nga baza e të dhënave
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "remove_user.php?id=" + userId, true);
            xhr.send();

            // Përditëso faqen pa rifreskim për të rifreskuar rezultatet
            xhr.onload = function() {
                // Shfaq rezultatet e përditësuara në div-in "results"
                document.getElementById("results").innerHTML = xhr.responseText;
            };
        }
    });
    </script>
</body>

</html>